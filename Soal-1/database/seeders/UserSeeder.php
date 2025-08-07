<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\DailyLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        $kepalaDinas = User::create([
            'name' => 'Ahmad Kepala Dinas',
            'email' => 'kepala.dinas@pemda.go.id',
            'password' => Hash::make('password123'),
            'role' => 'kepala_dinas',
            'supervisor_id' => null,
        ]);

        $kepalaBidang1 = User::create([
            'name' => 'Budi Kepala Bidang 1',
            'email' => 'kepala.bidang1@pemda.go.id',
            'password' => Hash::make('password123'),
            'role' => 'kepala_bidang',
            'supervisor_id' => $kepalaDinas->id,
        ]);

        $kepalaBidang2 = User::create([
            'name' => 'Citra Kepala Bidang 2',
            'email' => 'kepala.bidang2@pemda.go.id',
            'password' => Hash::make('password123'),
            'role' => 'kepala_bidang',
            'supervisor_id' => $kepalaDinas->id,
        ]);

        $staff1 = User::create([
            'name' => 'Dani Staff Bidang 1',
            'email' => 'staff1@pemda.go.id',
            'password' => Hash::make('password123'),
            'role' => 'staff',
            'supervisor_id' => $kepalaBidang1->id,
        ]);

        $staff2 = User::create([
            'name' => 'Eka Staff Bidang 2',
            'email' => 'staff2@pemda.go.id',
            'password' => Hash::make('password123'),
            'role' => 'staff',
            'supervisor_id' => $kepalaBidang2->id,
        ]);

        // Create sample daily logs
        $users = [$kepalaDinas, $kepalaBidang1, $kepalaBidang2, $staff1, $staff2];

        foreach ($users as $user) {
            for ($i = 6; $i >= 0; $i--) {
                $logDate = Carbon::now()->subDays($i);

                $activities = [
                    'Menghadiri rapat koordinasi dengan tim',
                    'Melakukan review dokumen laporan bulanan',
                    'Konsultasi dengan atasan terkait proyek baru',
                    'Mengupdate database pegawai',
                    'Menyiapkan presentasi untuk meeting klien',
                    'Melakukan monitoring dan evaluasi kinerja',
                    'Koordinasi dengan bidang lain untuk sinkronisasi program'
                ];

                $statuses = ['pending', 'approved', 'rejected'];
                $randomStatus = $i > 2 ? $statuses[array_rand($statuses)] : 'pending';

                DailyLog::create([
                    'user_id' => $user->id,
                    'log_date' => $logDate->format('Y-m-d'),
                    'activity_description' => $activities[array_rand($activities)] . ' pada tanggal ' . $logDate->format('d M Y'),
                    'status' => $randomStatus,
                    'attachment' => null,
                ]);
            }
        }
    }
}
