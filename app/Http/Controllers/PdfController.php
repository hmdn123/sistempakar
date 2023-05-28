<?php

namespace App\Http\Controllers;

use App\Models\DataPengguna;
use App\Models\Indikator;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class PdfController extends Controller
{
    public function exportIndikator()
    {
        $html = '
        <div class="page-heading">
            <h3>Indikator Sistem Pakar</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" border="1">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Indikator</th>
                        </tr>
                    </thead>
                    <tbody>';

        $indikators = Indikator::orderBy('id')->get();
        foreach ($indikators as $key => $item) {
            $html .= '
                <tr>
                    <td>' . ($key + 1) . '</td>
                    <td>' . $item->kode . '</td>
                    <td>' . $item->indikator . '</td>
                </tr>';
        }

        $html .= '
                    </tbody>
                </table>
            </div>
        </div>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();

        return $dompdf->stream('Indikator.pdf');
    }

    public function exportPenyakit()
    {
        $html = '
        <div class="page-heading">
            <h3>Penyakit Sistem Pakar</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" border="1">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Penyakit</th>
                        </tr>
                    </thead>
                    <tbody>';

        $indikators = Penyakit::orderBy('id')->get();
        foreach ($indikators as $key => $item) {
            $html .= '
                <tr>
                    <td>' . ($key + 1) . '</td>
                    <td>' . $item->kode . '</td>
                    <td>' . $item->penyakit . '</td>
                </tr>';
        }

        $html .= '
                    </tbody>
                </table>
            </div>
        </div>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();

        return $dompdf->stream('Penyakit.pdf');
    }

    public function exportPengguna()
    {
        $html = '
        <div class="page-heading">
            <h3>Data Pengguna Sistem Pakar</h3>
        </div>
        <div class="card-body">
            <table class="table-bordered table" border="1">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Nomor</th>
                        <th scope="col">Luas Lahan</th>
                        <th scope="col">Indikator</th>
                        <th scope="col">Penyakit</th>
                    </tr>
                </thead>
                <tbody>';

        $penyakits = DataPengguna::orderBy('id')->get();
        foreach ($penyakits as $key => $item) {
            $html .= '
                <tr>
                    <th scope="row">' . ($key + 1) . '</th>
                    <td>' . $item->nama . '</td>
                    <td>' . $item->alamat . '</td>
                    <td>' . $item->nomor . '</td>
                    <td>' . $item->luas_lahan . '</td>
                    <td>' . $item->kode_indikator . '</td>
                    <td>';

            $penyakitData = Penyakit::whereIn('kode', json_decode($item->kode_penyakit, true))->get();
            if ($penyakitData->isEmpty()) {
                $html .= '(Tidak Ditemukan)';
            } else {
                foreach ($penyakitData as $penyakit) {
                    $html .= $penyakit->penyakit;
                }
            }

            $html .= '</td>
                </tr>';
        }

        $html .= '
                </tbody>
            </table>
        </div>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();

        return $dompdf->stream('Data Pengguna.pdf');
    }
}
