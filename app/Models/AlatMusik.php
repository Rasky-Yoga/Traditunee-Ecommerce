<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatMusik extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_alat',
        'daerah_id',
        'kategori_id',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok' => 'integer',
    ];

    // Relationships
    public function daerah()
    {
        return $this->belongsTo(Daerah::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    // Helper methods
    public function isAvailable()
    {
        return $this->stok > 0;
    }

    public function decreaseStock($quantity)
    {
        $this->stok -= $quantity;
        $this->save();
    }

    public function increaseStock($quantity)
    {
        $this->stok += $quantity;
        $this->save();
    }
}