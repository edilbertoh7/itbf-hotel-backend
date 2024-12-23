<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;
    public function hotels()
    {
        return $this->hasMany(Hotel::class, 'city');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
