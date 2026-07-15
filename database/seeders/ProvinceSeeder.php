<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $provinces = [
            ['code' => 'ABR', 'name' => 'Abra', 'region_code' => 'CAR'],
            ['code' => 'AGN', 'name' => 'Agusan del Norte', 'region_code' => 'CARAGA'],
            ['code' => 'AGS', 'name' => 'Agusan del Sur', 'region_code' => 'CARAGA'],
            ['code' => 'AKL', 'name' => 'Aklan', 'region_code' => 'VI'],
            ['code' => 'ALB', 'name' => 'Albay', 'region_code' => 'V'],
            ['code' => 'ANT', 'name' => 'Antique', 'region_code' => 'VI'],
            ['code' => 'APA', 'name' => 'Apayao', 'region_code' => 'CAR'],
            ['code' => 'AUR', 'name' => 'Aurora', 'region_code' => 'III'],
            ['code' => 'BAS', 'name' => 'Basilan', 'region_code' => 'BARMM'],
            ['code' => 'BAN', 'name' => 'Bataan', 'region_code' => 'III'],
            ['code' => 'BTN', 'name' => 'Batanes', 'region_code' => 'II'],
            ['code' => 'BTG', 'name' => 'Batangas', 'region_code' => 'IV-A'],
            ['code' => 'BEN', 'name' => 'Benguet', 'region_code' => 'CAR'],
            ['code' => 'BIL', 'name' => 'Biliran', 'region_code' => 'VIII'],
            ['code' => 'BOH', 'name' => 'Bohol', 'region_code' => 'VII'],
            ['code' => 'BUK', 'name' => 'Bukidnon', 'region_code' => 'X'],
            ['code' => 'BUL', 'name' => 'Bulacan', 'region_code' => 'III'],
            ['code' => 'CAG', 'name' => 'Cagayan', 'region_code' => 'II'],
            ['code' => 'CAM', 'name' => 'Camarines Norte', 'region_code' => 'V'],
            ['code' => 'CAS', 'name' => 'Camarines Sur', 'region_code' => 'V'],
            ['code' => 'CAM', 'name' => 'Camiguin', 'region_code' => 'X'],
            ['code' => 'CAP', 'name' => 'Capiz', 'region_code' => 'VI'],
            ['code' => 'CAT', 'name' => 'Catanduanes', 'region_code' => 'V'],
            ['code' => 'CAV', 'name' => 'Cavite', 'region_code' => 'IV-A'],
            ['code' => 'CEB', 'name' => 'Cebu', 'region_code' => 'VII'],
            ['code' => 'COM', 'name' => 'Compostela Valley', 'region_code' => 'XI'],
            ['code' => 'NCO', 'name' => 'Davao de Oro', 'region_code' => 'XI'],
            ['code' => 'DAV', 'name' => 'Davao del Norte', 'region_code' => 'XI'],
            ['code' => 'DAS', 'name' => 'Davao del Sur', 'region_code' => 'XI'],
            ['code' => 'DAC', 'name' => 'Davao Occidental', 'region_code' => 'XI'],
            ['code' => 'DAO', 'name' => 'Davao Oriental', 'region_code' => 'XI'],
            ['code' => 'DIN', 'name' => 'Dinagat Islands', 'region_code' => 'CARAGA'],
            ['code' => 'EAS', 'name' => 'Eastern Samar', 'region_code' => 'VIII'],
            ['code' => 'GUI', 'name' => 'Guimaras', 'region_code' => 'VI'],
            ['code' => 'IFU', 'name' => 'Ifugao', 'region_code' => 'CAR'],
            ['code' => 'ILN', 'name' => 'Ilocos Norte', 'region_code' => 'I'],
            ['code' => 'ILS', 'name' => 'Ilocos Sur', 'region_code' => 'I'],
            ['code' => 'ILI', 'name' => 'Iloilo', 'region_code' => 'VI'],
            ['code' => 'ISA', 'name' => 'Isabela', 'region_code' => 'II'],
            ['code' => 'KAL', 'name' => 'Kalinga', 'region_code' => 'CAR'],
            ['code' => 'LUN', 'name' => 'La Union', 'region_code' => 'I'],
            ['code' => 'LAG', 'name' => 'Laguna', 'region_code' => 'IV-A'],
            ['code' => 'LAN', 'name' => 'Lanao del Norte', 'region_code' => 'BARMM'],
            ['code' => 'LAS', 'name' => 'Lanao del Sur', 'region_code' => 'BARMM'],
            ['code' => 'LEY', 'name' => 'Leyte', 'region_code' => 'VIII'],
            ['code' => 'MAG', 'name' => 'Maguindanao del Norte', 'region_code' => 'BARMM'],
            ['code' => 'MAS', 'name' => 'Maguindanao del Sur', 'region_code' => 'BARMM'],
            ['code' => 'MAD', 'name' => 'Marinduque', 'region_code' => 'IV-B'],
            ['code' => 'MAS', 'name' => 'Masbate', 'region_code' => 'V'],
            ['code' => 'MSC', 'name' => 'Misamis Occidental', 'region_code' => 'X'],
            ['code' => 'MSR', 'name' => 'Misamis Oriental', 'region_code' => 'X'],
            ['code' => 'MOU', 'name' => 'Mountain Province', 'region_code' => 'CAR'],
            ['code' => 'NEC', 'name' => 'Negros Occidental', 'region_code' => 'VI'],
            ['code' => 'NER', 'name' => 'Negros Oriental', 'region_code' => 'VII'],
            ['code' => 'NUE', 'name' => 'Nueva Ecija', 'region_code' => 'III'],
            ['code' => 'NUV', 'name' => 'Nueva Vizcaya', 'region_code' => 'II'],
            ['code' => 'MDC', 'name' => 'Occidental Mindoro', 'region_code' => 'IV-B'],
            ['code' => 'MDR', 'name' => 'Oriental Mindoro', 'region_code' => 'IV-B'],
            ['code' => 'PLW', 'name' => 'Palawan', 'region_code' => 'IV-B'],
            ['code' => 'PAM', 'name' => 'Pampanga', 'region_code' => 'III'],
            ['code' => 'PAN', 'name' => 'Pangasinan', 'region_code' => 'I'],
            ['code' => 'QUE', 'name' => 'Quezon', 'region_code' => 'IV-A'],
            ['code' => 'QUI', 'name' => 'Quirino', 'region_code' => 'II'],
            ['code' => 'RIZ', 'name' => 'Rizal', 'region_code' => 'IV-A'],
            ['code' => 'ROM', 'name' => 'Romblon', 'region_code' => 'IV-B'],
            ['code' => 'SAR', 'name' => 'Sarangani', 'region_code' => 'XII'],
            ['code' => 'SIG', 'name' => 'Siquijor', 'region_code' => 'VII'],
            ['code' => 'SOR', 'name' => 'Sorsogon', 'region_code' => 'V'],
            ['code' => 'SCO', 'name' => 'South Cotabato', 'region_code' => 'XII'],
            ['code' => 'SLU', 'name' => 'Southern Leyte', 'region_code' => 'VIII'],
            ['code' => 'SUK', 'name' => 'Sultan Kudarat', 'region_code' => 'XII'],
            ['code' => 'SLU', 'name' => 'Sulu', 'region_code' => 'BARMM'],
            ['code' => 'SUR', 'name' => 'Surigao del Norte', 'region_code' => 'CARAGA'],
            ['code' => 'SUS', 'name' => 'Surigao del Sur', 'region_code' => 'CARAGA'],
            ['code' => 'TAR', 'name' => 'Tarlac', 'region_code' => 'III'],
            ['code' => 'TAW', 'name' => 'Tawi-Tawi', 'region_code' => 'BARMM'],
            ['code' => 'ZMB', 'name' => 'Zambales', 'region_code' => 'III'],
            ['code' => 'ZAN', 'name' => 'Zamboanga del Norte', 'region_code' => 'IX'],
            ['code' => 'ZAS', 'name' => 'Zamboanga del Sur', 'region_code' => 'IX'],
            ['code' => 'ZSI', 'name' => 'Zamboanga Sibugay', 'region_code' => 'IX'],
            ['code' => 'ZAM', 'name' => 'Zamboanga City', 'region_code' => 'IX'],
            ['code' => 'ISB', 'name' => 'Isabela City', 'region_code' => 'BARMM'],
        ];

        foreach ($provinces as $province) {
            Province::updateOrCreate(
                ['code' => $province['code']],
                $province
            );
        }
    }
}
