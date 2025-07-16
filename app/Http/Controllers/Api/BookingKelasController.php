<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\BookingKelas;
use App\Models\KelasGym;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingKelasController extends Controller
{

    public function index()
    {
        //get all
        $booking = BookingKelas::with(['pelanggan.membership', 'kelas'])
            ->latest('booking_time')
            ->get()
            ->map(function ($booking) {
                return [
                    'nama_pelanggan'  => $booking->pelanggan->name,
                    'email'           => $booking->pelanggan->email,
                    'tanggal_join'    => $booking->pelanggan->join_date ?? null,
                    'tanggal_expired' => $booking->pelanggan->membership->end_date ?? null,
                    'kelas_diambil'   => $booking->kelas->name,
                    'waktu_booking'   => $booking->booking_time,
                ];
            });

        //return collection
        return new PostResource(true, 'List Data Booking', $booking);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'member_id'    => 'required|exists:pelanggans,id',
            'class_id'     => 'required|exists:kelas_gyms,id',
            'booking_time' => 'required|date',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Cek apakah sudah dibooking sebelumnya
        $existingBooking = BookingKelas::where('member_id', $request->member_id)
            ->where('class_id', $request->class_id)
            ->where('booking_time', $request->booking_time)
            ->first();

        if ($existingBooking) {
            return response()->json([
                'success' => false,
                'message' => 'Member sudah melakukan booking untuk kelas ini pada tanggal yang sama.',
            ], 409);
        }

        // cek quota booking
        $count = BookingKelas::where('class_id', $request->class_id)->count();
        $quota = KelasGym::where('id', $request->class_id)->value('quota');
        if ($count >= $quota) {
            return response()->json([
                'success' => false,
                'message' => 'Kelas sudah penuh!',
            ], 409);

        }
        
        // cek membership
        $membership = Membership::where('member_id', $request->member_id)
            ->orderBy('end_date', 'desc')
            ->first();
        if (! $membership || $request->booking_time > $membership->end_date) {
            return response()->json([
                'success' => false,
                'message' => 'Membership tidak aktif atau sudah expired!',
            ], 409);
        }

        // Simpan booking
        $booking = BookingKelas::create([
            'member_id'    => $request->member_id,
            'class_id'     => $request->class_id,
            'booking_time' => $request->booking_time,
        ]);

        return new PostResource(true, 'Booking berhasil disimpan!', $booking);
    }
}
