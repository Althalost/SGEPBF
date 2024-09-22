<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\SchoolTerm;
use Carbon\Carbon;

class UpdateSchoolTerms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $currentDate = Carbon::now();

        // Desactivar todos los periodos que no sean el actual
        SchoolTerm::where('start_date', '>', $currentDate)
                    ->orWhere('end_date', '<', $currentDate)->update(['active' => false]);

        // Activar el periodo que incluye la fecha actual
        $activeTerm = SchoolTerm::where('start_date', '<=', $currentDate)
                                ->where('end_date', '>=', $currentDate)
                                ->first();

        if ($activeTerm) {
            $activeTerm->update(['active' => true]);
        }
    }
}