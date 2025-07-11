<?php
namespace App\Models;

use App\Models\KelasGym;
use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Model;

class BookingKelas extends Model
{
    protected $fillable = [
        'member_id',
        'class_id',
        'booking_time',
    ];

    // Relasi ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'member_id');
    }

    // Relasi ke KelasGym
    public function kelas()
    {
        return $this->belongsTo(KelasGym::class, 'class_id');
    }
}
