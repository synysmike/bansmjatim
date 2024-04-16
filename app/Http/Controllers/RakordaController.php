<?php

namespace App\Http\Controllers;

use App\Models\Rakorda;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreRakordaRequest;
use App\Http\Requests\UpdateRakordaRequest;

class RakordaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = Rakorda::orderBy('created_at','DESC')->get();
        if ($request->ajax()) {            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('ttd', function ($data) {
                    $ttd = $data->ttd;                    
                    return '<img width="50" src="storage/'.$ttd.'" alt="">';
                })
                ->rawColumns(['ttd'])
                ->make(true);
            }
        return view('rakorda.dh');
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
     * @param  \App\Http\Requests\StoreRakordaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $signature = $request->signature;      
        $signatureFileName = uniqid().'.png';
        $signature = str_replace('data:image/png;base64,', '', $signature);
        $signature = str_replace(' ', '+', $signature);
        $ttd = base64_decode($signature);
        $file = 'ttdrakorda1/'.$signatureFileName;
        Storage::disk('public')->put($file, $ttd);

        // $id = $request->id;
        $validator = $request->validate([
            'nama' => 'required',
            'hp' => 'numeric|digits_between:9,13',
            'asal' => 'required',
            'unit' => 'required',
            'jabatan' => 'required',
            'signature' => 'required',
            // 'kpr' => 'file|mimes:pdf,PDF|max:2048|nullable',
        ]);
        // simpan nama gambar
        
        // $validator['signature'] = Storage::disk('local')->put($file, $ttd);
        
        $unit =
            Rakorda::updateOrCreate(
            [
            'nama' => $validator['nama'],
            'hp' => $validator['hp'],
            'asal' => $validator['asal'],
            'unit' => $validator['unit'],
            'jabatan' => $validator['jabatan'],
            'ttd' => $file

            // 'document' => $request->file('document')->store('dokumen/'.$parent->tahun.'/'.$parent->satker->namasatker.'/'.$parent->risk_code.'/tindakan-penanganan', 'public'),

            ]
        );
            return response()->json($unit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rakorda  $rakorda
     * @return \Illuminate\Http\Response
     */
    public function show(Rakorda $rakorda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rakorda  $rakorda
     * @return \Illuminate\Http\Response
     */
    public function edit(Rakorda $rakorda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRakordaRequest  $request
     * @param  \App\Models\Rakorda  $rakorda
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRakordaRequest $request, Rakorda $rakorda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rakorda  $rakorda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rakorda $rakorda)
    {
        //
    }
}
