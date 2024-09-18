<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RepresentativeStudent extends Pivot
{
    public function relationship()
    {
        return $this->belongsTo(Student_Representative::class, 'role_id');
    }
}
