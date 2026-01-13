<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPiket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JadwalPiketExport;

class JadwalPiketController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->query('bulan', now()->month);
        $tahun = $request->query('tahun', now()->year);

        $jadwal = JadwalPiket::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->orderBy('tanggal', 'asc')
            ->get();

        $namaList = [
            'Raden Kukuh Ridho Ahadi',
            'Hendra Hadi Pratama',
            'Andri Pratama',
            'Muhammad Azul',
            'Lalu Taufiq Wijaya',
            'Aditia Marandika Rachman',
            'IWAN VANI',
        ];

        $url = "https://raw.githubusercontent.com/guangrei/tanggal-merah-indonesia/main/{$tahun}.json";
        $response = Http::get($url);
        $tanggalMerah = $response->successful() ? array_keys($response->json()) : [];

        $tanggalAwal = Carbon::create($tahun, $bulan, 1);
        $tanggalAkhir = $tanggalAwal->copy()->endOfMonth();

        $now = Carbon::now('Asia/Jakarta');
        $hour = $now->hour;
        $shiftAktif = ($hour >= 8 && $hour < 16) ? 'P' : (($hour >= 16 && $hour < 24) ? 'S' : 'M');

        return view('jadwalpiket', compact(
            'jadwal',
            'namaList',
            'bulan',
            'tahun',
            'shiftAktif',
            'tanggalMerah',
            'tanggalAwal',
            'tanggalAkhir'
        ));
    }

    public function update(Request $request)
    {
        \Log::info('DATA MASUK KE CONTROLLER:', $request->all());
        $dataList = $request->input('data', []);

        foreach ($dataList as $item) {
            if (empty($item['nama']) || empty($item['tanggal'])) continue;

            $tanggal = Carbon::parse($item['tanggal']);
            $namaBaru = $item['nama'];
            $namaAsli = $item['nama_asli'] ?? $item['nama'];
            $shiftBaru = $item['shift'] ?? '';

            if ($namaAsli !== $namaBaru) {
                $jadwalLama = JadwalPiket::where('nama', $namaAsli)
                    ->whereDate('tanggal', $tanggal)
                    ->first();

                $jadwalBaru = JadwalPiket::where('nama', $namaBaru)
                    ->whereDate('tanggal', $tanggal)
                    ->first();

                if ($jadwalLama && $jadwalBaru) {
                    $shiftTemp = $jadwalLama->shift;
                    $jadwalLama->update(['shift' => $jadwalBaru->shift]);
                    $jadwalBaru->update(['shift' => $shiftTemp]);
                } elseif ($jadwalLama && !$jadwalBaru) {
                    $jadwalLama->update([
                        'nama' => $namaBaru,
                        'shift' => $shiftBaru,
                    ]);
                } elseif (!$jadwalLama && !$jadwalBaru) {
                    JadwalPiket::create([
                        'nama' => $namaBaru,
                        'tanggal' => $tanggal,
                        'shift' => $shiftBaru,
                    ]);
                }
            } else {
                $existing = JadwalPiket::where('nama', $namaBaru)
                    ->whereDate('tanggal', $tanggal)
                    ->first();

                if ($existing) {
                    $existing->update(['shift' => $shiftBaru]);
                } else {
                    JadwalPiket::create([
                        'nama' => $namaBaru,
                        'tanggal' => $tanggal,
                        'shift' => $shiftBaru,
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan.'
        ]);
    }

    public function exportExcel(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');
        return Excel::download(new JadwalPiketExport($bulan, $tahun), "Jadwal_Piket_{$bulan}_{$tahun}.xlsx");
    }

    public function generate($tahun, $bulan)
    {
        $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $tahun = intval($tahun);
    
        $existing = JadwalPiket::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->exists();
    
        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal bulan ini sudah ada!'
            ]);
        }
    
        $tanggalAwal = Carbon::create($tahun, $bulan, 1);
        $tanggalAkhir = $tanggalAwal->copy()->endOfMonth();
    
        $namaList = [
            'Raden Kukuh Ridho Ahadi',
            'Hendra Hadi Pratama',
            'Andri Pratama',
            'Muhammad Azul',
            'Lalu Taufiq Wijaya',
            'Aditia Marandika Rachman',
            'IWAN VANI',
        ];
        // Loop semua tanggal dalam bulan
        for ($tanggal = $tanggalAwal->copy(); $tanggal->lte($tanggalAkhir); $tanggal->addDay()) {
            foreach ($namaList as $nama) {
                JadwalPiket::create([
                    'tanggal' => $tanggal->format('Y-m-d'),
                    'nama' => $nama,
                    'shift' => '', // <---- kosong, tidak ada M/P/S
                ]);
            }
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Jadwal bulan ' . $tanggalAwal->translatedFormat('F Y') . ' berhasil dibuat!'
        ]);
    }
}
