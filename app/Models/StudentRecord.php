<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRecord extends Model
{
    use HasFactory;

    public function schoolTerm(){
        return $this->belongsTo(SchoolTerm::class);
    }
}
