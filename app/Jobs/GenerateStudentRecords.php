<?php

namespace App\Jobs;

use App\Models\Representative;
use App\Models\SchoolTerm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GenerateStudentRecords implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $currentDate = Carbon::now();

        // Busca el periodo activo
        $currentTerm = SchoolTerm::where('active', '=', true)->first();

        $end_date = Carbon::parse($currentTerm->end_date);

        Log::info('Job iniciado');
        Log::info('Fecha actual: ' . $currentDate->format('Y-m-d'));
        Log::info('Periodo activo: ' . $currentTerm ? $end_date->format('Y-m-d') : 'No encontrado');

      

        if($currentTerm && $end_date->format('Y-m') == $currentDate->format('Y-m')){
            // Obtener todos los registros de la tabla students
            $students = Student::with(['group.grade', 'group.section', 'representatives'])->get();


            // Copiar cada registro a la tabla student_records
            foreach ($students as $student) {

                // Concatenar nombres y cédulas de los representantes
                $representativeNames = $student->representatives->pluck('full_name')->implode(', ');
                $representativeCIs = $student->representatives->pluck('ci')->implode(', ');


                DB::table('student_records')->insert([
                    'full_name' => $student->full_name,
                    'ci' => $student->ci,
                    'representative_full_name' => $representativeNames,
                    'representative_ci' => $representativeCIs,
                    'date_of_birth' => $student->date_of_birth,
                    'gender' => $student->gender,
                    'grade_code' => $student->group->grade->code,
                    'section_code' => $student->group->section->code,
                    'school_term_id' => $currentTerm->id,
                    'join_date' => $student->join_date,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
