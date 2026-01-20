<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TimeplanController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();
        $daysInMonth = $now->daysInMonth;

        // ===================== AMBIL LIST MITRA =====================
        $mitras = DB::table('projects')
            ->select('id', 'mitra')
            ->orderBy('mitra')
            ->get();

        // ===================== AMBIL DATA TIMELINE =====================
        $query = DB::table('project_sites as ps')
            ->leftJoin('project_timeline as pt', 'pt.project_site_id', '=', 'ps.id')
            ->leftJoin('timeplans as tp', 'tp.project_site_id', '=', 'ps.id')
            ->select(
                'ps.id as site_id',
                'ps.project_id',
                'ps.kabupaten',
                'ps.site_name',
                'pt.tanggal_mulai as start_date',
                'pt.tanggal_selesai as end_date',
                'pt.status',
                'pt.note_manual',
                'tp.teknisi'
            )
            ->orderBy('ps.kabupaten')
            ->orderBy('ps.site_name');

        // ===================== FILTER MITRA JIKA DIPILIH =====================
        $mitraId = $request->input('mitra');
        if ($mitraId) {
            $query->where('ps.project_id', $mitraId);
        }

        $data = $query->get();

        // ===================== GENERATE HARI & STATUS =====================
        foreach ($data as $row) {
            $row->note_final = $row->note_manual;
            $row->days = [];
            $row->total_days = 0;
            $row->ontime = null;

            if (!$row->start_date) continue;

            $start = Carbon::parse($row->start_date);
            $end   = $row->end_date ? Carbon::parse($row->end_date) : Carbon::now();
            $row->total_days = $start->diffInDays($end) + 1;
            $cursor = $start->copy();

            while ($cursor->lte($end)) {
                if ($cursor->month != $now->month) {
                    $cursor->addDay();
                    continue;
                }

                $day = $cursor->day;

                if ($row->status === 'done' && $row->end_date && $cursor->isSameDay($end)) {
                    $row->days[$day] = 'done';
                    $row->ontime = true;
                } elseif ($row->status === 'progress' || ($row->status === 'done' && $cursor->lt($end))) {
                    $row->days[$day] = 'progress';
                    $row->ontime = false;
                }

                $cursor->addDay();
            }

            if ($row->status === 'done' && !$row->end_date) {
                $row->ontime = false;
            }
        }

        // ===================== SUMMARY =====================
        // ===================== SUMMARY =====================
        $ontime = 0;
        $late = 0;

        foreach ($data as $row) {
            if ($row->start_date && $row->end_date) {
                $durasi = Carbon::parse($row->start_date)->diffInDays(Carbon::parse($row->end_date)) + 1;

                if ($durasi <= 3) {
                    $row->ontime = true;
                    $ontime++;
                } else {
                    $row->ontime = false;
                    $late++;
                }
            } else {
                $row->ontime = null; // belum selesai
            }
        }

        $summary = [
            'ontime' => $ontime,
            'late' => $late,
        ];

        // ===================== GROUP BY KABUPATEN =====================
        $groupedByKabupaten = [];
        foreach ($data as $row) {
            $kab = $row->kabupaten ?? 'Unknown';

            // ===================== HITUNG PENALTI 3 HARI =====================
            $maxDurasi = 3;
            $totalDays = $row->total_days;
            $noteFinal = $row->note_final;

            if ($totalDays > $maxDurasi) {
                $status = 'TERLAMBAT';
                $penalty = $totalDays - $maxDurasi;
                $noteFinal = $noteFinal ? $noteFinal . " | Telat $penalty hari" : "Telat $penalty hari";
            } else {
                $status = 'ONTIME';
            }

            if (!isset($groupedByKabupaten[$kab])) $groupedByKabupaten[$kab] = [];
            $groupedByKabupaten[$kab][] = [
                'site'       => $row->site_name,
                'teknisi'    => $row->teknisi,
                'start'      => $row->start_date,
                'end'        => $row->end_date,
                'total_days' => $totalDays,
                'status'     => $status,
                'note'       => $noteFinal,
            ];
        }

        // ===================== KURVA S =====================
        if ($mitraId) {
            $timelines = DB::table('project_timeline as pt')
                ->join('project_sites as ps', 'ps.id', '=', 'pt.project_site_id')
                ->where('ps.project_id', $mitraId)
                ->select('pt.*')
                ->get();
        } else {
            $timelines = DB::table('project_timeline')->get();
        }

        $totalSite = $data->count();
        $minDate = $timelines->min('tanggal_mulai') ?? now();
        $maxDate = $timelines->max('tanggal_selesai') ?? now();

        $dates = [];
        $current = Carbon::parse($minDate);
        $max = Carbon::parse($maxDate);
        while ($current->lte($max)) {
            $dates[] = $current->format('Y-m-d');
            $current->addDay();
        }

        // cumulative actual progress
        $actualProgress = [];
        foreach ($dates as $date) {
            $doneCount = $timelines->filter(function($t) use ($date) {
                return $t->status === 'done' && $t->tanggal_selesai && Carbon::parse($t->tanggal_selesai)->lte($date);
            })->count();

            $actualProgress[] = $totalSite > 0 ? round($doneCount / $totalSite * 100, 2) : 0;
        }

        // cumulative planned progress
        $plannedProgress = [];
        foreach ($dates as $date) {
            $plannedCount = $timelines->filter(function($t) use ($date) {
                return $t->tanggal_selesai && Carbon::parse($t->tanggal_selesai)->lte($date);
            })->count();

            $plannedProgress[] = $totalSite > 0 ? round($plannedCount / $totalSite * 100, 2) : 0;
        }

        // ===================== RETURN VIEW =====================
        return view('timeplan', [
            'data' => $data,
            'daysInMonth' => $daysInMonth,
            'summary' => $summary,
            'groupedByKabupaten' => $groupedByKabupaten,
            'mitras' => $mitras,
            'selectedMitra' => $mitraId,
            'labels' => $dates,
            'planned' => $plannedProgress,
            'actual' => $actualProgress
        ]);
    }

    // ===================== SIMPAN TEKNISI =====================
public function updateTeknisi(Request $request)
{
    $request->validate([
        'project_site_id' => 'required|exists:project_sites,id',
        'teknisi' => 'nullable|string|max:100',
    ]);

    // Ambil tanggal mulai dari project_timeline
    $startDate = DB::table('project_timeline')
        ->where('project_site_id', $request->project_site_id)
        ->value('tanggal_mulai');

    // Jika belum ada timeline, buat default
    if (!$startDate) {
        $startDate = now()->toDateString(); // default hari ini
        DB::table('project_timeline')->updateOrInsert(
            ['project_site_id' => $request->project_site_id],
            ['tanggal_mulai' => $startDate, 'created_at' => now(), 'updated_at' => now()]
        );
    }

    // Simpan teknisi di timeplans
    DB::table('timeplans')->updateOrInsert(
        ['project_site_id' => $request->project_site_id],
        [
            'teknisi'     => $request->teknisi,
            'start_date'  => $startDate,
            'jumlah_site' => 1,
            'updated_at'  => now(),
            'created_at'  => now(),
        ]
    );

    // ================= LOGIKA OTOMATIS SELESAI 3 HARI =================
    $endDate = Carbon::now();
    $durasi = Carbon::parse($startDate)->diffInDays($endDate) + 1;
    $maxDurasi = 3;
    $ontime = true;
    $note = null;

    if ($durasi > $maxDurasi) {
        $ontime = false;
        $penalty = $durasi - $maxDurasi;
        $note = "Telat $penalty hari";
    }

    // Update project_timeline dengan status done
    DB::table('project_timeline')->updateOrInsert(
        ['project_site_id' => $request->project_site_id],
        [
            'tanggal_selesai' => $endDate,
            'durasi_hari'     => $durasi,
            'status'          => 'done',
            'note_manual'     => $note,
            'updated_at'      => now(),
            'created_at'      => now(),
        ]
    );

    return back()->with('success', 'Teknisi dan status site berhasil disimpan');
}

public function saveNote(Request $request)
{
    $request->validate([
        'site_id' => 'required|exists:project_sites,id',
        'note_manual' => 'required|string'
    ]);

    DB::table('project_timeline')->updateOrInsert(
        ['project_site_id' => $request->site_id],
        [
            'note_manual' => $request->note_manual,
            'updated_at' => now()
        ]
    );

    return back()->with('success', 'Note disimpan');
}

}
