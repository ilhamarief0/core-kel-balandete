<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          WebsiteSetting::create([
            'website_name' => 'Kelurahan Balandete',
            'website_description' => 'Core Web Profil website adalah situs sederhana yang menampilkan informasi inti tentang individu atau organisasi, seperti identitas, visi, dan kontak, untuk membangun citra profesional dan memudahkan komunikasi.',
            'website_logo' => '',
            'website_address' => 'Jln. HEA Mokodompit No. 9, Kec. Kambu, Kota Kendari, Prov. Sulawesi Tenggara',
            'website_phone' => '(62)82244156660',
            'website_email' => 'meanhills019@gmail.com',
            'website_instagram' => 'https://instagram.com/ilhamarief0',
            'website_x' => '',
            'website_facebook' => '',
            'website_youtube' => '',
        ]);
    }
}
