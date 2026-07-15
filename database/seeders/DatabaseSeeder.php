<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@pwdregistry.test'], [
            'name' => 'System Administrator',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $this->call(PwdRegistrySeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(MunicipalitySeeder::class);
        $this->call(BarangaySeeder::class);
    }
}
