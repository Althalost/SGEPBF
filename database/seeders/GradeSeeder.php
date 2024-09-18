<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grade::create(['code' => '1']);
        Grade::create(['code' => '2']);
        Grade::create(['code' => '3']);
        Grade::create(['code' => '4']);
        Grade::create(['code' => '5']);
        Grade::create(['code' => '6']);
    }
}
