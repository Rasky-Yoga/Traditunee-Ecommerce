<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daerah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_daerah',
        'deskripsi',
    ];

    // Relationships
    public function alatMusiks()
    {
        return $this->hasMany(AlatMusik::class);
    }
}