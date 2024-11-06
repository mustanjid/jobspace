<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Position extends Model
{

    use HasFactory;

    static public function getRecord(){
        return self::get();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
