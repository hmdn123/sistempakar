<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.penyakit', [
            'penyakits' => Penyakit::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lastItem = Penyakit::orderBy('kode', 'desc')->first();

        if ($lastItem) {
            $lastCode = $lastItem->kode;
            $number = substr($lastCode, 1);
            $nextNumber = str_pad($number + 1, strlen($number), '0', STR_PAD_LEFT);
            $code = 'P' . $nextNumber;
        } else {
            $code = 'P01';
        }

        $model = new Penyakit();
        $model->penyakit = $request->penyakit;
        $model->kode = $code;
        $model->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Penyakit::find($id);
        $model->penyakit = $request->penyakit;
        $model->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Penyakit::find($id);
        $model->delete();
        return back();
    }
}