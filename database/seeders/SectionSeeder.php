<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::create(['code' => 'A']);
        Section::create(['code' => 'B']);
        Section::create(['code' => 'C']);
        Section::create(['code' => 'D']);
        Section::create(['code' => 'E']);
    }
}
