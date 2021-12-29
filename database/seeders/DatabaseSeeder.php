<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Quiz::create([
            'question' => '5+5=10',
            'answer' => 1
        ]);
        Quiz::create([
            'question' => '5+6=10',
            'answer' => 0
        ]);
        Quiz::create([
            'question' => '15+6=12',
            'answer' => 0
        ]);
        Quiz::create([
            'question' => '15+6=12',
            'answer' => 0
        ]);
        Quiz::create([
            'question' => '15+6=12',
            'answer' => 0
        ]);
        Quiz::create([
            'question' => '15+6=12',
            'answer' => 0
        ]);
        Quiz::create([
            'question' => '15+6=12',
            'answer' => 0
        ]);
        Quiz::create([
            'question' => '15+6=12',
            'answer' => 0
        ]);
        Quiz::create([
            'question' => '15+6=12',
            'answer' => 0
        ]);
        Quiz::create([
            'question' => '15+6=12',
            'answer' => 0
        ]);
    }
}
