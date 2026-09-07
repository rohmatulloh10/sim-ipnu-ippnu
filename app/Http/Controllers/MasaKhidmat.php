<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasaKhidmat as MasaKhidmatModel;

class MasaKhidmat extends Controller
{
    public function index()
    {
        $masaKhidmat = MasaKhidmatModel::all();
        // return view('masa_khidmat.index', compact('masaKhidmat'));
        return inertia('masa_khidmat/index', [
            'masaKhidmat' => $masaKhidmat,
        ]);
    }
}
