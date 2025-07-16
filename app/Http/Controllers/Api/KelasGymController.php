<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\KelasGym;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasGymController extends Controller
{
    public function index()
    {
        //get all
        $kelasGym = KelasGym::latest()->get();

        //return collection
        return new PostResource(true, 'List Data Kelas Gym', $kelasGym);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'schedule' => 'required|date',
            'quota'    => 'required|integer|min:1',
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
        $kelasGym = KelasGym::create([
            'name'     => $request->name,
            'schedule' => $request->schedule,
            'quota'    => $request->quota,
        ]);

        //return response
        return new PostResource(true, 'Data Kelas GYM Berhasil Ditambahkan!', $kelasGym);
    }

}