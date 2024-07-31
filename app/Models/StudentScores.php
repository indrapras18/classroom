<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentScores extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
{
    return $this->belongsTo(User::class, 'id_user');
}

public function materi()
{
    return $this->belongsTo(Materis::class, 'id_materi');
}
}
