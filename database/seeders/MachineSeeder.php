<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Machine;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ar = [
            'ПТ',
	        'ML',
	        'STS',
        ];
        foreach($ar as $item) {
            Machine::create(['value' => $item]);
        };
    }
}
