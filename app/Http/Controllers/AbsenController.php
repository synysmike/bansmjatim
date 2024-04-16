<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\UpdateAbsenRequest;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $mytime = Carbon::now('Asia/Jakarta');
        $today = $mytime->format('d-m-Y');
        // dd($today);
        $data = Absen::where('tanggal',$today)->get();
        // $data = Absen::all();
        // return $data;
        if ($request->ajax()) {            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('ttd', function ($data) {
                    $ttd = $data->ttd;
                    
                    return '<img width="100" src="storage/'.$ttd.'" alt="">';
                })
                ->addColumn('hapus', function ($data) {
                    $url= $data->id;
                    return '<a href="javascript:void(0)" id="'. $url .'" data-id="' . $url . '" class="btn btn-info show-btn delete"> delete</a>';
                })
                ->rawColumns(['ttd','hapus'])
                ->make(true);
            }
                return view('absen.absen',compact('data','today'));
            
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
     * @param  \App\Http\Requests\StoreAbsenRequest  $request
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
        $file = 'ttdabsen/'.$signatureFileName;
        Storage::disk('public')->put($file, $ttd);

        // $id = $request->id;
        $validator = $request->validate([
            'nama' => 'required',
            'cek' => 'required',
            'signature' => 'required',
            // 'kpr' => 'file|mimes:pdf,PDF|max:2048|nullable',
        ]);
        // simpan nama gambar
        
        // $validator['signature'] = Storage::disk('local')->put($file, $ttd);
        $mytime = Carbon::now('Asia/Jakarta');
        $unit =
            Absen::updateOrCreate(
            [
            'nama' => $validator['nama'],
            'cek' => $validator['cek'],
            'jam'=> $mytime->format('H:i:s') ,
            'tanggal'=>$mytime->format('d-m-Y'),
            'ttd' => $file

            // 'document' => $request->file('document')->store('dokumen/'.$parent->tahun.'/'.$parent->satker->namasatker.'/'.$parent->risk_code.'/tindakan-penanganan', 'public'),

            ]
        );
            return response()->json($unit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function show(Absen $absen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function edit(Absen $absen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAbsenRequest  $request
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAbsenRequest $request, Absen $absen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $data = Absen::where('id', $id)->delete();
        return response()->json($data);
    }
}
