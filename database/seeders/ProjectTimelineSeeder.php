<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectTimeline;
use Carbon\Carbon;

class ProjectTimelineSeeder extends Seeder
{
    public function run(): void
   {
        // Panggil seeder ProjectTimelineSeeder
        $this->call(ProjectTimelineSeeder::class);
    
    
    
        // 20 lokasi
        $lokasi = [
            'Site A','Site B','Site C','Site D','Site E',
            'Site F','Site G','Site H','Site I','Site J',
            'Site K','Site L','Site M','Site N','Site O',
            'Site P','Site Q','Site R','Site S','Site T',
        ];

        $startDate = Carbon::today();

        foreach ($lokasi as $index => $nama) {
            // otomatis: 12 selesai, 4 progress, sisanya pending
            if ($index < 12) {
                $status = 'done';
            } elseif ($index < 16) {
                $status = 'progress';
            } else {
                $status = 'pending';
            }

            ProjectTimeline::create([
                'nama_lokasi' => $nama,
                'status' => $status,
                'tanggal' => $startDate->copy()->addDays($index),
            ]);
        }
    }
}
