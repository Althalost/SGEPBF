<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function representatives()
    {
        return $this->belongsToMany(Representative::class, 'student_representative')->withPivot('relationship')->using(RepresentativeStudent::class)->withTimestamps();
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function studentRecord(){
        return $this->hasMany(StudentRecord::class,  'id', 'id');
    }

    public function studentMedicalRecord(){
        return $this->hasMany(StudentMedicalRecord::class,  'student_id', 'id');
    }
}
