<?php
namespace App\Models;

use App\Models\Membership;
use App\Models\BookingKelas;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = [
        'name',
        'email',
        'join_date',
        'status',
    ];

    // Relasi ke Membership
    public function membership()
    {
        return $this->hasOne(Membership::class, 'member_id');
    }

    // Relasi ke Booking Kelas
    public function bookings()
    {
        return $this->hasMany(BookingKelas::class, 'member_id');
    }
}
