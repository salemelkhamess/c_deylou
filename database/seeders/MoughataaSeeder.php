<?php

namespace Database\Seeders;

use App\Models\Moughataa;
use App\Models\Wilaya;
use Illuminate\Database\Seeder;

class MoughataaSeeder extends Seeder
{
    public function run()
    {
        $moughataas = [
            // Exemple pour Nouakchott Nord
            ['nom_fr' => 'Tevragh Zeina', 'nom_ar' => 'تفرغ زينة', 'nom_en' => 'Tevragh Zeina', 'code' => 'TZ', 'wilaya_id' => 1, 'population' => 150000],
            ['nom_fr' => 'Ksar', 'nom_ar' => 'لكصر', 'nom_en' => 'Ksar', 'code' => 'KS', 'wilaya_id' => 1, 'population' => 120000],

            // Exemple pour Nouakchott Ouest
            ['nom_fr' => 'Teyarett', 'nom_ar' => 'تيارت', 'nom_en' => 'Teyarett', 'code' => 'TY', 'wilaya_id' => 2, 'population' => 100000],

            // Exemple pour Nouakchott Sud
            ['nom_fr' => 'Arafat', 'nom_ar' => 'عرفات', 'nom_en' => 'Arafat', 'code' => 'AF', 'wilaya_id' => 3, 'population' => 180000],
            ['nom_fr' => 'El Mina', 'nom_ar' => 'الميناء', 'nom_en' => 'El Mina', 'code' => 'EM', 'wilaya_id' => 3, 'population' => 90000],
        ];

        foreach ($moughataas as $moughataa) {
            Moughataa::create($moughataa);
        }
    }
}
