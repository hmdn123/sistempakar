<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\DataPengguna;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function temukanPenyakit(Request $request)
    {
        $indikator = $request->indikator;
        $nama = $request->nama;
        $alamat = $request->alamat;
        $nomor = $request->nomor;
        $luas_lahan = $request->luas_lahan;

        if ($indikator == null || $nama = null || $alamat = null || $nomor == null || $luas_lahan == null) {
            return view('hasil', ['pesan' => 'Lengkapi semua informasi yang diperlukan untuk mendapatkan hasil']);
        }

        $penyakitcek = Aturan::select('kode_penyakit')
            ->groupBy('kode_penyakit')
            ->pluck('kode_penyakit');

        foreach ($penyakitcek as $kode_penyakit) {
            $kode_indikator[$kode_penyakit] = Aturan::where('kode_penyakit', $kode_penyakit)
                ->pluck('kode_indikator')
                ->toArray();
        }

        $hasil = [];

        foreach ($kode_indikator as $key => $value) {
            $intersect = array_intersect($indikator, $value);
            if (count($intersect) == count($value)) {
                $hasil[] = $key;
            }
        }
        $result = Penyakit::whereIn('kode', $hasil)->get();

        $model = new DataPengguna();
        $model->nama = $request->nama;
        $model->alamat = $request->alamat;
        $model->nomor = $nomor;
        $model->luas_lahan = $luas_lahan;
        $model->kode_penyakit = json_encode($hasil);
        $model->save();

        if ($hasil == null) {
            return view('hasil', ['pesan' => 'Maaf, penyakit tidak ditemukan']);
        } else {
            return view('hasil', ['results' => $result, 'pesan' => '']);
        }
    }
}