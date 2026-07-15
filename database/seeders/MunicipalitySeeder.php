<?php

namespace Database\Seeders;

use App\Models\Municipality;
use App\Models\Province;
use Illuminate\Database\Seeder;

class MunicipalitySeeder extends Seeder
{
    public function run(): void
    {
        // Sample municipalities for a few provinces
        // In production, this should include all municipalities from the Philippines
        $municipalities = [
            // Cebu
            ['code' => 'CEB-CGY', 'name' => 'Cebu City', 'province_code' => 'CEB'],
            ['code' => 'CEB-MDN', 'name' => 'Mandaue City', 'province_code' => 'CEB'],
            ['code' => 'CEB-LAP', 'name' => 'Lapu-Lapu City', 'province_code' => 'CEB'],
            ['code' => 'CEB-TLG', 'name' => 'Talisay City', 'province_code' => 'CEB'],
            ['code' => 'CEB-TOO', 'name' => 'Toledo City', 'province_code' => 'CEB'],
            ['code' => 'CEB-ARG', 'name' => 'Argao', 'province_code' => 'CEB'],
            ['code' => 'CEB-BAD', 'name' => 'Badian', 'province_code' => 'CEB'],
            ['code' => 'CEB-BAL', 'name' => 'Balamban', 'province_code' => 'CEB'],
            ['code' => 'CEB-BAN', 'name' => 'Bantayan', 'province_code' => 'CEB'],
            ['code' => 'CEB-BAR', 'name' => 'Barili', 'province_code' => 'CEB'],
            
            // Metro Manila (as province-like entities)
            ['code' => 'MM-QC', 'name' => 'Quezon City', 'province_code' => 'NCR'],
            ['code' => 'MM-MK', 'name' => 'Manila', 'province_code' => 'NCR'],
            ['code' => 'MM-CA', 'name' => 'Caloocan', 'province_code' => 'NCR'],
            ['code' => 'MM-LP', 'name' => 'Las Piñas', 'province_code' => 'NCR'],
            ['code' => 'MM-MA', 'name' => 'Makati', 'province_code' => 'NCR'],
            ['code' => 'MM-MD', 'name' => 'Malabon', 'province_code' => 'NCR'],
            ['code' => 'MM-MG', 'name' => 'Mandaluyong', 'province_code' => 'NCR'],
            ['code' => 'MM-MN', 'name' => 'Marikina', 'province_code' => 'NCR'],
            ['code' => 'MM-MT', 'name' => 'Muntinlupa', 'province_code' => 'NCR'],
            ['code' => 'MM-NA', 'name' => 'Navotas', 'province_code' => 'NCR'],
            ['code' => 'MM-PA', 'name' => 'Parañaque', 'province_code' => 'NCR'],
            ['code' => 'MM-PS', 'name' => 'Pasay', 'province_code' => 'NCR'],
            ['code' => 'MM-PG', 'name' => 'Pasig', 'province_code' => 'NCR'],
            ['code' => 'MM-PL', 'name' => 'Pateros', 'province_code' => 'NCR'],
            ['code' => 'MM-SJ', 'name' => 'San Juan', 'province_code' => 'NCR'],
            ['code' => 'MM-TG', 'name' => 'Taguig', 'province_code' => 'NCR'],
            ['code' => 'MM-VA', 'name' => 'Valenzuela', 'province_code' => 'NCR'],
            
            // Cavite
            ['code' => 'CAV-BC', 'name' => 'Bacoor', 'province_code' => 'CAV'],
            ['code' => 'CAV-CA', 'name' => 'Cavite City', 'province_code' => 'CAV'],
            ['code' => 'CAV-DA', 'name' => 'Dasmarinas', 'province_code' => 'CAV'],
            ['code' => 'CAV-GE', 'name' => 'General Trias', 'province_code' => 'CAV'],
            ['code' => 'CAV-IM', 'name' => 'Imus', 'province_code' => 'CAV'],
            ['code' => 'CAV-KK', 'name' => 'Kawit', 'province_code' => 'CAV'],
            ['code' => 'CAV-MA', 'name' => 'Maragondon', 'province_code' => 'CAV'],
            ['code' => 'CAV-MN', 'name' => 'Mendez', 'province_code' => 'CAV'],
            ['code' => 'CAV-NA', 'name' => 'Naic', 'province_code' => 'CAV'],
            ['code' => 'CAV-NO', 'name' => 'Noveleta', 'province_code' => 'CAV'],
            ['code' => 'CAV-RO', 'name' => 'Rosario', 'province_code' => 'CAV'],
            ['code' => 'CAV-SI', 'name' => 'Silang', 'province_code' => 'CAV'],
            ['code' => 'CAV-TA', 'name' => 'Tagaytay', 'province_code' => 'CAV'],
            ['code' => 'CAV-TR', 'name' => 'Tanza', 'province_code' => 'CAV'],
            ['code' => 'CAV-TE', 'name' => 'Ternate', 'province_code' => 'CAV'],
            ['code' => 'CAV-TI', 'name' => 'Trece Martires', 'province_code' => 'CAV'],
            
            // Laguna
            ['code' => 'LAG-BC', 'name' => 'Biñan City', 'province_code' => 'LAG'],
            ['code' => 'LAG-CA', 'name' => 'Calamba City', 'province_code' => 'LAG'],
            ['code' => 'LAG-CV', 'name' => 'Cavinti', 'province_code' => 'LAG'],
            ['code' => 'LAG-FG', 'name' => 'Famy', 'province_code' => 'LAG'],
            ['code' => 'LAG-KL', 'name' => 'Kalayaan', 'province_code' => 'LAG'],
            ['code' => 'LAG-LB', 'name' => 'Los Baños', 'province_code' => 'LAG'],
            ['code' => 'LAG-LU', 'name' => 'Lumban', 'province_code' => 'LAG'],
            ['code' => 'LAG-MG', 'name' => 'Mabitac', 'province_code' => 'LAG'],
            ['code' => 'LAG-MJ', 'name' => 'Majayjay', 'province_code' => 'LAG'],
            ['code' => 'LAG-ND', 'name' => 'Nagcarlan', 'province_code' => 'LAG'],
            ['code' => 'LAG-PA', 'name' => 'Pagsanjan', 'province_code' => 'LAG'],
            ['code' => 'LAG-PK', 'name' => 'Pakil', 'province_code' => 'LAG'],
            ['code' => 'LAG-PG', 'name' => 'Pangil', 'province_code' => 'LAG'],
            ['code' => 'LAG-PC', 'name' => 'Pedro Cabungao', 'province_code' => 'LAG'],
            ['code' => 'LAG-RI', 'name' => 'Rizal', 'province_code' => 'LAG'],
            ['code' => 'LAG-SB', 'name' => 'San Pablo City', 'province_code' => 'LAG'],
            ['code' => 'LAG-SC', 'name' => 'Santa Cruz', 'province_code' => 'LAG'],
            ['code' => 'LAG-SM', 'name' => 'Santa Maria', 'province_code' => 'LAG'],
            ['code' => 'LAG-SI', 'name' => 'Siniloan', 'province_code' => 'LAG'],
            ['code' => 'LAG-VI', 'name' => 'Victoria', 'province_code' => 'LAG'],
        ];

        foreach ($municipalities as $municipality) {
            $province = Province::where('code', $municipality['province_code'])->first();
            
            if ($province) {
                Municipality::updateOrCreate(
                    ['code' => $municipality['code']],
                    [
                        'name' => $municipality['name'],
                        'province_id' => $province->id,
                    ]
                );
            }
        }
    }
}
