<?php

namespace Database\Seeders;

use App\Models\Barangay;
use App\Models\DisabilityType;
use App\Models\PwdApplication;
use App\Models\PwdRegistrant;
use Illuminate\Database\Seeder;

class PwdRegistrySeeder extends Seeder
{
    public function run(): void
    {
        $barangays = collect(['Poblacion', 'San Isidro', 'Santa Cruz'])->mapWithKeys(function (string $name, int $index) {
            $barangay = Barangay::updateOrCreate(
                ['code' => 'BRGY-'.str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)],
                ['name' => $name]
            );

            return [$name => $barangay];
        });

        $types = collect(['Mobility Impairment', 'Visual Impairment', 'Hearing Impairment', 'Psychosocial Disability'])->mapWithKeys(function (string $name, int $index) {
            $type = DisabilityType::updateOrCreate(
                ['code' => 'DT-'.str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)],
                ['name' => $name, 'is_active' => true]
            );

            return [$name => $type];
        });

        $records = [
            ['id' => '13-0001-000001', 'first' => 'Maria', 'middle' => 'Santos', 'last' => 'Dela Cruz', 'birth' => '1985-04-12', 'sex' => 'female', 'barangay' => 'Poblacion', 'type' => 'Mobility Impairment', 'status' => 'active'],
            ['id' => '13-0001-000002', 'first' => 'Juan', 'middle' => 'Reyes', 'last' => 'Garcia', 'birth' => '1992-09-21', 'sex' => 'male', 'barangay' => 'San Isidro', 'type' => 'Visual Impairment', 'status' => 'active'],
            ['id' => '13-0001-000003', 'first' => 'Ana', 'middle' => 'Lopez', 'last' => 'Villanueva', 'birth' => '2001-01-30', 'sex' => 'female', 'barangay' => 'Santa Cruz', 'type' => 'Hearing Impairment', 'status' => 'active'],
        ];

        foreach ($records as $index => $record) {
            $registrant = PwdRegistrant::updateOrCreate(['pwd_id_number' => $record['id']], [
                'first_name' => $record['first'], 'middle_name' => $record['middle'], 'last_name' => $record['last'],
                'birth_date' => $record['birth'], 'sex' => $record['sex'], 'civil_status' => 'Single',
                'address_line' => $record['barangay'].', Sample Municipality', 'contact_number' => '0917'.str_pad((string) ($index + 1), 7, '0', STR_PAD_LEFT),
                'barangay_id' => $barangays[$record['barangay']]->id, 'disability_type_id' => $types[$record['type']]->id,
                'disability_cause' => 'Congenital', 'card_issued_date' => now()->subYear()->toDateString(),
                'card_expiry_date' => now()->addYears(2)->toDateString(), 'card_status' => $record['status'],
            ]);

            PwdApplication::updateOrCreate(['application_number' => 'APP-2026-000'.($index + 1)], [
                'pwd_registrant_id' => $registrant->id,
                'type' => $index === 0 ? 'new' : ($index === 1 ? 'renewal' : 'replacement'),
                'submitted_at' => now()->subDays($index + 2),
                'status' => $index === 0 ? 'pending' : ($index === 1 ? 'under_review' : 'draft'),
                'notes' => 'Sample seeded application.',
            ]);
        }
    }
}
