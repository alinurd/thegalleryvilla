<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppSetting::create([
            'id' => '1',
            'title' => 'PT. Maxon Prime Technology',
            'telephone'	=> '021 54282388',
            'mobile_phone' => '08119761229',
            'email' =>	'maxonpump1@gmail.com',
            'address' => "<table>
                    <tbody>
                        <tr>
                            <td><strong>Factory:</strong><br />
                            Jl. Raya Ciangir, Legok, Banten,<br />
                            Indonesia, 15820.<br />
                            Phone : 021 54282388<br />
                            Mobile : 0811 9761 229</td>
                            <td>
                            <p><strong>Surabaya:</strong><br />
                            Jl. Raya Menganti No.1 C, Jajar Tunggal,<br />
                            Kec.Wiyung, Surabaya, Jawa Timur,<br />
                            Indonesia, 60223<br />
                            Phone : 031 87863753</p>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Head Office:</strong><br />
                            Gedung Office 8 Lt. 19 Unit E -,<br />
                            Jl. Jend Sudirman, Jakarta Selatan, Indonesia<br />
                            12190.<br />
                            Phone : 021 29335856</td>
                            <td><strong>Cikarang:</strong><br />
                            Jl. Greenland II AE-19 Sukamahi,<br />
                            Kec. Cikarang Pusat, Kab. Bekasi, Jawa Barat<br />
                            17530.</td>
                        </tr>
                    </tbody>
                </table>",
            'footer_text' => '© 2025, PT. Maxon Prime Technology  -  All Right Reserved',
            'logo' => 'storage/photos/1/logo-maxon.png',
            'favicon' => 'storage/photos/1/icon-maxon-air.png',
            'meta_keyword' => "maxon,  maxonpump,  maxonprime, maxon prime technology, maxonprime.com, mechanical, electrical, plumbing, maxonpump. Pompa Air Centrifugal Rumah Tangga, Pompa Air Sentrifugal Rumah Tangga, Pompa Air Sumur Dangkal, Pompa Air Sumur Dalam, Pompa Air Submersible Rumah Tangga, Pompa Air Booster, Pompa Air Otomatis, Pompa Air Kolam Renang, Pompa Air Taman, Pompa Air Akuarium, pompa maxon, maxon pompa, maxon, makson prime,makson prime teknologi, maksen prem teknologi, HEAD PUMP, EFISIENSI PUMP, EFISIENSI MOTOR	",
            'meta_description' => 'maxon prime technology, maxonpump',
            'whatsapp' =>	'08119761229',
            'website' =>	'www.maxonprime.id',
            'facebook' =>	'https://www.facebook.com/maxonpump',
            'status_facebook' => 1,
            'twitter' => 'https://www.x.com',
            'status_twitter' => 0,
            'youtube' => 'https://www.youtube.com',
            'status_youtube'	=> 0,
            'instagram' => 'https://www.instagram.com/pumpmaxon',
            'status_instagram' =>	1,
        ]);
    }
}
