<?php

namespace Database\Seeders;

use App\Models\Obat;
use App\Models\Keluhan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        //     CategorySeeder::class,
        //     ProgramSeeder::class,
        // ]);

        // $keluhans = Keluhan::all();

        // Obat::all()->each(function ($obat) use ($keluhans) {
        //     $obat->keluhans()->attach(
        //         $keluhans->random(rand(1, 3))->pluck('id')->toArray()
        //     );
        // });
        DB::table('users')->insert([
            'email' => 'example@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('a'),
            'role' => 'manajemen',
            'nama' => 'John Doe',
            'alamat' => '123 Main Street',
            'notelp' => '123456789',
            'status' => '1',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
