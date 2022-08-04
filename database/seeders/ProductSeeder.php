<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ar = [
            'Коробки',
	        'Обечайки',
	        'Открытки',
	        'Папки',
	        'Пакеты',
	        'Футляры',
	        'Буклеты',
	        'Обложки',
	        'Конверты',
	        'Рубрикаторы',
	        'Бирки',
	        'Хангеры',
	        'Этикетки',
        ];
        foreach($ar as $item) {
            Product::create(['value' => $item]);
        };        
    }
}
