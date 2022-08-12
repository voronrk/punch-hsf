<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['punch_id', 'session'];

    function punches()
    {
        return $this->hasOne(Punch::class);
    }
}
