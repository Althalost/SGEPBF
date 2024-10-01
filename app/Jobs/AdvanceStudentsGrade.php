<?php

namespace App\Jobs;

use App\Models\Grade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\SchoolTerm;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdvanceStudentsGrade implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $currentDate = Carbon::now();

        // Busca el periodo activo
        $currentTerm = SchoolTerm::where('active', '=', true)->first();

        if (!$currentTerm) {
            Log::info('No se encontró un periodo activo.');
            return;
        }

        $end_date = Carbon::parse($currentTerm->end_date);

        Log::info('Job iniciado');
        Log::info('Fecha actual: ' . $currentDate->format('Y-m-d'));
        Log::info('Periodo activo: ' . ($currentTerm ? $end_date->format('Y-m-d') : 'No encontrado'));

      

        if($currentTerm && $end_date->format('Y-m') == $currentDate->format('Y-m')){
            // Obtener todos los registros de la tabla students
            $students = Student::with('group.grade')->get();


            // Iniciar una transacción
            DB::beginTransaction();

            try {
                // Pasar a los estudiantes al siguiente grado
                foreach ($students as $student) {
                    $currentGrade = $student->group->grade->code;
                    $nextGradeCode = intval($currentGrade) + 1;
                    $nextGrade = Grade::where('code', '=', $nextGradeCode)->first();
        
                    if ($nextGrade) {
                        $student->group->grade_id = $nextGrade->id;
                        $student->group->save();
                    }else{
                        // Desasociar al estudiante del grupo
                        $student->group_id = null;
                        $student->save();

                        // Eliminar el grupo
                        $student->group->delete();
                    }
                }
        
                // Confirmar la transacción
                DB::commit();
            } catch (\Exception $e) {
                // Revertir la transacción en caso de error
                DB::rollBack();
                Log::error('Error al actualizar los grados de los estudiantes: ' . $e->getMessage());
                throw $e;
            }
        }
    }
}