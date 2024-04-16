<?php

namespace App\Http\Controllers;

use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class VerifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        //
        $user = Auth::user();
        $tittle = $user->nama;
        $role = $user->jabatan;
        if($role=="admin"){
            $data = Verifikasi::where('cek','0')
            ->get();
        }elseif($role=="sekre"){
            $korwil = $user->role;
            $data = Verifikasi::where('cek', 0)
            ->where('korwil', $korwil)
            ->get();
        }

        
        
        // $kabkota = $user->kab_kota;
        // dd($kabkota);
        // dd($data);
        // return $data;
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $url = Crypt::encrypt($data->id);
                    return '<a href="javascript:void(0)" data-id="' . $url . '" class="btn btn-info show-btn"> Cek Berkas</a>';
                })
                ->rawColumns(['aksi'])      
                // ->rawColumns([])
                ->make(true);
        }
        return view(
            'sekolah.verifikasi',
            compact('tittle')
        );
        
    }

    public function total(){
        
        $sudah = Verifikasi::where('cek', 1)
        ->where('status', 'Re 2023')
        ->get();
        $semua = Verifikasi::where('status', 'Re 2023')
        ->get();
        $totalsudah = count($sudah);
        $totalre = count($semua);
        $message = $totalsudah."  dari ".$totalre;
        return response()->json($message);
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
        $alldata = $request->all();
        $user = Auth::user();
        $id = $request->id;
        $validator = $request->validate([
            'pr' => 'required',
            'sk' => 'required',
            'sa' => 'required',
        ]);
        // dd($alldata);
        //
        $unit =
            Verifikasi::updateOrCreate(
            ['id' => $id],
            [
            'statuspr' => $validator['pr'],
            'statussk' => $validator['sk'],
            'statussa' => $validator['sa'],
            'ktpr' => $request->alasanpr,
            'ktsk' => $request->alasansk,
            'ktsa' => $request->alasansa,
            'verifikator' => $user->name,
            'cek' => 1
        ]);
        return response()->json($unit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Verifikasi  $verifikasi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $decid = Crypt::decrypt($id);        // dd($decid);
        $where = array('id' => $decid);
        $unit = Verifikasi::where($where)->first();
        return response()->json($unit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Verifikasi  $verifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Verifikasi $verifikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Verifikasi  $verifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Verifikasi $verifikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Verifikasi  $verifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verifikasi $verifikasi)
    {
        //
    }
}
