<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materis extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function questions()
    {
        return $this->hasMany(Questions::class, 'id_materi');
    }

    public function scores()
{
    return $this->hasMany(StudentScores::class, 'id_materi');
}
}
