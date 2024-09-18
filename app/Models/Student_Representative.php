<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Representative extends Model
{
    use HasFactory;

    public function students()
    {
        return $this->hasMany(Student::class, 'students')->withPivot('relationship');
    }

    public function representatives()
    {
        return $this->hasMany(Representative::class, 'representatives')->withPivot('relationship');
    }

    public function relationship()
    {
        return $this->belongsTo(Student_Representative::class, 'relationship');
    }
}
