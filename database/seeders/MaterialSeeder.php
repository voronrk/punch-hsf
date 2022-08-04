<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $ar = [
            'Картон',
	        'Гофрокартон',
	        'Бумага',
	        'Переплетные материалы',
        ];
        foreach($ar as $item) {
            Material::create(['value' => $item]);
        };
    }
}
