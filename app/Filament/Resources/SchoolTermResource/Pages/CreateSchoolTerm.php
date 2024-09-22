<?php

namespace App\Filament\Resources\SchoolTermResource\Pages;

use App\Filament\Resources\SchoolTermResource;
use App\Models\SchoolTerm;
use App\Models\SchoolTermRecord;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSchoolTerm extends CreateRecord
{
    protected static string $resource = SchoolTermResource::class;

/*     protected function beforeCreate()
    {
        $this->changeSchoolTerm($this->record);
    }

    public function changeSchoolTerm($newTerm)
    {
        // Guardar el periodo actual en el histórico
        $currentTerm = SchoolTerm::where('active', true)->first();
        if ($currentTerm) {
            SchoolTermRecord::create([
                'start_date' => $currentTerm->start_date,
                'end_date' => $currentTerm->end_date,
            ]);

            // Desactivar el periodo actual
            $currentTerm->update(['active' => false]);
        }

        // Activar el nuevo periodo
        //$newTerm->update(['active' => true]);
    } */
}
