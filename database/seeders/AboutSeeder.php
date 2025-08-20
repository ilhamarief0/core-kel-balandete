<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
          'view' => 'landingpage',
          'title' => 'Kami Adalah Solusi Teknologi yang Anda Cari!',
          'content' => '
          <p>Kami adalah perusahaan teknologi yang bergerak di bidang Pembuatan Aplikasi, Maintanance Jaringan Dll</p>
          '
      ]);
        About::create([
          'view' => 'aboutdetail',
          'title' => 'Kami akan memberikan yang terbaik!',
          'content' => '
          <p>Kami adalah perusahaan teknologi yang bergerak di bidang Pembuatan Aplikasi, Maintanance Jaringan Dll</p>
          '
      ]);
    }
}
