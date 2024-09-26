<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolTerm extends Model
{
    use HasFactory;

    public function StudentRecords(){
        return $this->hasMany(StudentRecord::class);
    }

    protected $casts = [
        'active' => 'boolean',
    ];

/*     public function changeSchoolTerm($newTerm)
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
    $newTerm->update(['active' => true]);
    } */
}
