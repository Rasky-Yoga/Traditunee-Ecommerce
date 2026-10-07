<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alat_musik_id',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alatMusik()
    {
        return $this->belongsTo(AlatMusik::class);
    }

    // Helper methods
    public function getSubtotal()
    {
        return $this->quantity * $this->alatMusik->harga;
    }
}