<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
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

    }
}
