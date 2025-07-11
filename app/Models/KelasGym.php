<?php
namespace App\Models;

use App\Models\BookingKelas;
use Illuminate\Database\Eloquent\Model;

class KelasGym extends Model
{
    protected $fillable = [
        'name',
        'schedule',
        'quota',
    ];

    // Relasi ke Booking Kelas
    public function bookings()
    {
        return $this->hasMany(BookingKelas::class, 'class_id');
    }
}
