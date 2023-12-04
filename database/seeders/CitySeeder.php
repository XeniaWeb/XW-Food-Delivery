<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = ['Zürich','Genf','Basel','Lausanne','Bern','Winterthur','Luzern','St.Gallen','Lugano','Biel/Bienne','Thun','Bellinzona','Köniz','Freiburg','Schaffhausen','La Chaux-de-Fonds','Chur',    'Uster','Sitten','Vernier','Lancy','Neuenburg','Emmen','Zug','Yverdon-les-Bains','Dübendorf','Kriens','Dietikon','Rapperswil-Jona','Meyrin','Montreux','Frauenfeld','Wetzikon','Wädenswil','Baar','Bulle','Wil','Horgen','Carouge','Kreuzlingen','Bülach','Aarau','Nyon','Riehen','Allschwil','Wettingen','Opfikon','Renens','Kloten','Schlieren','Vevey','Baden','Reinach','Adliswil','Onex','Volketswil','Glarus Nord','Pully','Regensdorf','Olten','Martigny','Thalwil','Gossau','Muttenz','Monthey','Ostermundigen','Grenchen','Illnau-Effretikon','Wallisellen','Val-de-Ruz','Cham','Wohlen','Siders','Solothurn','Pratteln','Burgdorf','Freienbach','Einsiedeln','Morges','Steffisburg','Binningen','Lyss','Locarno','Herisau','Langenthal','Schwyz','Arbon','Mendrisio','Küsnacht','Stäfa','Liestal','Thônex','Meilen','Oftringen','Horw','Amriswil','Ebikon','Richterswil','Rheinfelden','Küssnacht SZ','Zollikon','Uzwil','Versoix','Gland','Brig-Glis','Muri bei Bern','Ecublens','Buchs','Münsingen','Spiez','Brugg','Chêne-Bougeries','Delsberg','Glarus','Rüti','Le Grand-Saconnex','Prilly','Affoltern am Albis','Villars-sur-Glâne','Arth','Pfäffikon','Spreitenbach','Zofingen','La Tour-de-Peilz','Münchenstein','Altstätten','Bassersdorf','Veyrier','Weinfelden','Worb','Belp','Ittigen','Männedorf','Hinwil','Romanshorn','Risch','Oberwil','Möhlin','Lenzburg','Davos','Maur','Suhr','Zollikofen','Plan-les-Ouates','Val-de-Travers NE','Sarnen','Flawil','Neuhausen am Rheinfall','Aigle','Lutry','Birsfelden','Sursee','Aesch','Naters','Gossau','Bernex','Münchenbuchsee','Crans-Montana','Wald','Steinhausen','Payerne','Urdorf'];

        foreach ($cities as $city) {
            City::create(['name' => $city]);
        }
    }
}
