<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function materis()
    {
        return $this->belongsTo(Materis::class, 'id_materi');
    }

    public function answers()
    {
        return $this->hasMany(Answers::class, 'id_questions');
    }

    public function materi()
    {
        return $this->belongsTo(Materis::class, 'id_materi');
    }

    // public function assignment()
    // {
    //     return $this->belongsTo(Assignments::class, 'id_assignment');
    // }

    public function resultEssays()
    {
        return $this->hasMany(ResultEssay::class, 'id_question');
    }

    public function results()
    {
        return $this->hasMany(Results::class, 'id_question');
    }

    public function assignment()
    {
        return $this->belongsTo(Assignments::class, 'id_assignment');
    }
}
