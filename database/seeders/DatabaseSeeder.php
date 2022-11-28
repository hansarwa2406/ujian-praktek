<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Employee::create([
            'jenis_karyawan' => 'Kontrak',
            'nama' => 'Budi Suwandi',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '1985-01-13'
        ]);
        Employee::create([
            'jenis_karyawan' => 'Tetap',
            'nama' => 'Andi Istandi',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_lahir' => '1990-12-30'
        ]);
    }
}
