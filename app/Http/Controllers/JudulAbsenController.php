<?php

namespace App\Http\Controllers;

use App\Models\judul_absen;
use App\Http\Requests\Storejudul_absenRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Updatejudul_absenRequest;

class JudulAbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $tittle = "judul dh";
        $data = judul_absen::all();
        if ($request->ajax()) {
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $rp = '<a target="_blank" href="report_dh/' . $data->id . '" class="btn btn-success" id="goto">Report</a> ';
                $form = ' <a href="/presensi/' . $data->id . '" target="_blank" class="btn btn-primary btn-icon icon-right">lihat form</a>';
                $btn = $rp . $form;
                return $btn;
            })
                ->addColumn('act', function ($data) {
                    if ($data->activate == 1) {
                        # code...
                        return '<div class="badge badge-success">Active</div>';
                    } else {
                        return '<div class="badge badge-danger">Inactive</div>';
                    }
                })
                ->rawColumns(['action', 'act'])
                ->make(true);
        }
        // dd($data);
        // $cek = $data->activate;
        return view('absen.judul_absen', compact('tittle'));
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
     * @param  \App\Http\Requests\Storejudul_absenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $cek = $request->all();
        // dd($cek);
        //
        $id = 1;
        $inpid =  ['id' => $id];
        $unit = judul_absen::updateOrCreate( 
            $inpid,           
            [
                'judul'=>$request->judul,
                'tanggal'=>$request->tanggal,
                'activate'=>$request->active
                

            ]);
        return response()->json($unit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\judul_absen  $judul_absen
     * @return \Illuminate\Http\Response
     */
    public function show(judul_absen $judul_absen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\judul_absen  $judul_absen
     * @return \Illuminate\Http\Response
     */
    public function edit(judul_absen $judul_absen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatejudul_absenRequest  $request
     * @param  \App\Models\judul_absen  $judul_absen
     * @return \Illuminate\Http\Response
     */
    // public function update(Updatejudul_absenRequest $request, judul_absen $judul_absen)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\judul_absen  $judul_absen
     * @return \Illuminate\Http\Response
     */
    public function destroy(judul_absen $judul_absen)
    {
        //
    }
}
