<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Schedule::job(new \App\Jobs\UpdateSchoolTerms())->timezone('America/Caracas')->dailyAt('05:00');
Schedule::job(new \App\Jobs\GenerateStudentRecords())->timezone('America/Caracas')->dailyAt('00:11');
Schedule::job(new \App\Jobs\AdvanceStudentsGrade())->timezone('America/Caracas')->dailyAt('17:37');