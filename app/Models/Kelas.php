<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function Users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }


}
