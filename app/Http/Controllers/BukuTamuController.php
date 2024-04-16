<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class BukuTamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = BukuTamu::orderBy('created_at','DESC')->get();
        // return $data;
        if ($request->ajax()) {            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('ttd', function ($data) {
                    $ttd = $data->ttd;
                    
                    return '<img width="100" src="public/app/public/'.$ttd.'" alt="">';
                })
                ->rawColumns(['ttd'])
                ->make(true);
            }
                return view('bukutamu.bt',compact('data'));
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
        //
        // $alldata = $request->all();
        // dd($alldata);


        // convert eot signature jadi png
        $mytime = Carbon::now('Asia/Jakarta');
        $today = $mytime->format('d-m-Y');
        $signature = $request->signature;
        $signatureFileName = uniqid() . '.png';
        $signature = str_replace('data:image/png;base64,', '', $signature);
        $signature = str_replace(' ', '+', $signature);
        $ttd = base64_decode($signature);
        $file = 'ttdbukutamu/' . $signatureFileName;
        // file_put_contents($file, $ttd);
        Storage::disk('public')->put($file, $ttd);

        // $id = $request->id;
        $validator = $request->validate([
            'nama' => 'required',
            'hp' => 'numeric|digits_between:9,13',
            'asal' => 'required',
            'kpr' => 'required',
            'signature' => 'required',
            // 'kpr' => 'file|mimes:pdf,PDF|max:2048|nullable',
        ]);
        // simpan nama gambar
        
        // $validator['signature'] = Storage::disk('local')->put($file, $ttd);
        
        $unit =
            BukuTamu::updateOrCreate(
            [
            'nama' => $validator['nama'],
            'nohp' => $validator['hp'],
            'asal' => $validator['asal'],
            'keperluan' => $validator['kpr'],
            'alamat' => $request->alamat,
            'tgl' => $today,
            'ttd' => $file

            // 'document' => $request->file('document')->store('dokumen/'.$parent->tahun.'/'.$parent->satker->namasatker.'/'.$parent->risk_code.'/tindakan-penanganan', 'public'),

            ]
        );
            return response()->json($unit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BukuTamu  $bukuTamu
     * @return \Illuminate\Http\Response
     */
    public function show(BukuTamu $bukuTamu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BukuTamu  $bukuTamu
     * @return \Illuminate\Http\Response
     */
    public function edit(BukuTamu $bukuTamu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BukuTamu  $bukuTamu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BukuTamu $bukuTamu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BukuTamu  $bukuTamu
     * @return \Illuminate\Http\Response
     */
    public function destroy(BukuTamu $bukuTamu)
    {
        //
    }
}
