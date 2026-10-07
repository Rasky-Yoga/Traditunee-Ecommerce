<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
    'transaction_code',
    'user_id',
    'recipient_name',
    'deliver_to',
    'payment_code',
    'payment_proof',  // TAMBAH INI
    'paid_at',        // TAMBAH INI
    'total_amount',
    'status',
];

protected $casts = [
    'total_amount' => 'decimal:2',
    'paid_at' => 'datetime',  // TAMBAH INI
];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    // Boot method untuk generate transaction code otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (empty($transaction->transaction_code)) {
                $transaction->transaction_code = 'TRX-' . strtoupper(Str::random(10));
            }
        });
    }

    // Helper methods
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    public function isProcessing()
    {
        return $this->status === 'processing';
    }

    public function isShipped()
    {
        return $this->status === 'shipped';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }
}