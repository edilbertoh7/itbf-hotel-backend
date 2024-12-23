<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_type_id',
        'assignment_id',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
