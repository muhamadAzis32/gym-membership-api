<?php
namespace App\Models;

use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'member_id',
        'start_date',
        'end_date',
        'payment_amount',
    ];

    // Relasi ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'member_id');
    }
}
