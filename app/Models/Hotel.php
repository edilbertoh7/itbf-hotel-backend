<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['name', 'address','city', 'tax_id', 'max_rooms'];

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'city','id');
    }
}
