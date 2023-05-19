<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
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

        $penyakitcek = Aturan::select('kode_penyakit')
            ->groupBy('kode_penyakit')
            ->pluck('kode_penyakit');

        foreach ($penyakitcek as $kode_penyakit) {
            $kode_indikator[$kode_penyakit] = Aturan::where('kode_penyakit', $kode_penyakit)
                ->pluck('kode_indikator')
                ->toArray();
        }

        $result = [];

        foreach ($kode_indikator as $key => $value) {
            $intersect = array_intersect($indikator, $value);
            if (count($intersect) == count($value)) {
                $result[] = $key;
            }
        }

        return $result;

        // $aturans = Aturan::whereIn('kode_indikator', $indikator)->get();
        // $countAturan = count($aturans);
        // $countIndikator = count($indikator);
        // foreach ($aturans as $aturan) {
        //     $penyakit[] = $aturan->penyakit->penyakit;
        // }

        // $penyakitUnik = array_unique($penyakit);
        // $isPenyakitSama = count($penyakitUnik) === 1;

        // dd($penyakit);

        // if ($countAturan != $countIndikator) {
        //     dd('tidak ada penyakit');
        // } elseif ($isPenyakitSama) {
        //     $penyakitTunggal = reset($penyakit);
        //     dd($penyakitTunggal);
        // } else {
        //     dd('tidak ada penyakit');
        // }
    }
}
