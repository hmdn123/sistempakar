<?php

namespace App\Http\Controllers;

use App\Models\Masterakun;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan', [
            'title' => 'Laporan',
            'akun' => Masterakun::all(),
        ]);
    }
}
