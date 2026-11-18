<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasaKhidmat as MasaKhidmatModel;
use App\Models\User;

class MasaKhidmat extends Controller
{
    public function index()
    {
        // $masaKhidmat = MasaKhidmatModel::all();
        // $coba = User::with('role')->find(1);
        // return view('masa_khidmat.index', compact('masaKhidmat'));
        // return inertia('masa_khidmat/index', [
        //     'masaKhidmat' => $masaKhidmat,
        //     'coba' => $coba,
        // ]);
    }
}
