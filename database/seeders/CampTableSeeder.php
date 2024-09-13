<?php

namespace Database\Seeders;

use App\Models\Camps;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CampTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $camps = [
            [
                'title' => 'Gila Belajar',
                'slug' => 'gila-belajar',
                'price' => 200,
                
            ],
            [
                'title' => 'Jago Coding',
                'slug' => 'jago-coding',
                'price' => 300,
                
            ],
        ];

        foreach ($camps as $camp) {
            Camps::create($camp);
        }
    }
}
