<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use App\Models\Bulan;
use App\Models\Pemakaian;
use App\Models\Periode;
use App\Models\Tahun;
use App\Models\Tarif;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Admin',
            'email'     => 'admin@mail.com',
            'password'  => bcrypt('11223344'),
            'role_id'   => 1
        ]);

        User::create([
            'name'      => 'Petugas',
            'email'     => 'petugas@mail.com',
            'password'  => bcrypt('11223344'),
            'role_id'   => 2
        ]);

        User::create([
            'no_pelanggan'  => 'PAM0001',
            'name'          => 'Thoriqul Birri',
            'email'         => 'thorik@mail.com',
            'no_hp'         => '082220301741',
            'tgl_pasang'    => '2023-10-16',
            'password'      => bcrypt('11223344'),
            'role_id'       => 3
        ]);

        Role::create([
            'role'  => 'admin'
        ]);
        Role::create([
            'role'  => 'petugas'
        ]);
        Role::create([
            'role'  => 'pelanggan'
        ]);

        Bulan::create([
            'bulan' => 'Januari'
        ]);
        Bulan::create([
            'bulan' => 'Februari'
        ]);
        Bulan::create([
            'bulan' => 'Maret'
        ]);
        Bulan::create([
            'bulan' => 'April'
        ]);
        Bulan::create([
            'bulan' => 'Mei'
        ]);
        Bulan::create([
            'bulan' => 'Juni'
        ]);
        Bulan::create([
            'bulan' => 'Juli'
        ]);
        Bulan::create([
            'bulan' => 'Agustus'
        ]);
        Bulan::create([
            'bulan' => 'September'
        ]);
        Bulan::create([
            'bulan' => 'Oktober'
        ]);
        Bulan::create([
            'bulan' => 'November'
        ]);
        Bulan::create([
            'bulan' => 'Desember'
        ]);

        Tahun::create([
            'tahun' => '2024'
        ]);

        Tarif::create([
            'm3'        => '1500',
            'beban'     => '5000',
            'denda'     => '5000'
        ]);

        Periode::create([
            'periode'   => 'Januari 2024',
            'bulan_id'  => 1,
            'tahun_id'  => 1,
            'status'    => 'Aktif'
        ]);
    }
}
