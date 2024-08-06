<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function scores()
    {
        return $this->hasMany(StudentScores::class, 'id_assignments');
    }
}
