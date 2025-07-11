<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    public function index()
    {
        //get all pelanggans
        $pelanggans = Pelanggan::latest()->get();

        //return collection
        return new PostResource(true, 'List Data Pelanggan', $pelanggans);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
            'join_date' => 'required|date',
            'status'    => 'required|in:active,inactive',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create Pelanggan
        $pelanggan = Pelanggan::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'join_date' => $request->join_date,
            'status'    => $request->status,
        ]);

        //return response
        return new PostResource(true, 'Data Pelanggan Berhasil Ditambahkan!', $pelanggan);
    }
}
