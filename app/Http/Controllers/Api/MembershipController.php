<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MembershipController extends Controller
{
    public function index()
    {
        //get all Memberships
        $memberships = Membership::with('pelanggan')
            ->latest()
            ->get()
            ->map(function ($membership) {
                return [
                    'nama_pelanggan' => $membership->pelanggan->name,
                    'start_date'     => $membership->start_date,
                    'end_date'       => $membership->end_date,
                    'payment_amount' => $membership->payment_amount,
                ];
            });

        //return collection
        return new PostResource(true, 'List Data Membership', $memberships);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'member_id'      => 'required|integer',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date',
            'payment_amount' => 'required|numeric',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        //create
        $membership = Membership::create([
            'member_id'      => $request->member_id,
            'start_date'     => $request->start_date,
            'end_date'       => $request->end_date,
            'payment_amount' => $request->payment_amount,
        ]);

        //return response
        return new PostResource(true, 'Data Membership Berhasil Ditambahkan!', $membership);
    }

}