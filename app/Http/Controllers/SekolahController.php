<?php

namespace App\Http\Controllers;

use App\Models\sekolah;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoresekolahRequest;
use App\Http\Requests\UpdatesekolahRequest;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = Auth::user();
        $tittle = $user->nama;
        $kabkota = $user->kab_kota;
        // dd($kabkota);
        if($user->jabatan === "kpa"){
            $data = Sekolah::where('kab_kota',$kabkota)->get();
        }elseif($user->jabatan === "admin"){
            $data = Sekolah::all();
            }

        
        // dd($data);
        // return $data;
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $url = Crypt::encrypt($data->id);
                    return '<a href="javascript:void(0)" data-id="' . $url . '" class="btn btn-info show-btn"> Edit</a>';
                })
                ->addColumn('kondisi', function ($data) {
                    $cek = $data->updated_at;
                    if($cek !== null){
                        return '<span class="badge badge-success">Sudah di edit</span>';
                    }else{
                        return '<span class="badge badge-info">Belum di edit</span>';
                    }
                })        
                ->rawColumns(['aksi','kondisi'])        
                // ->rawColumns([])
                ->make(true);
        }
        return view(
            'sekolah.daftar_sekolah',
            compact('tittle')
        );
    }
    public function admin(Request $request)
    {
        //
        $user = Auth::user();
        $tittle = $user->nama;
        $kabkota = $user->kab_kota;
        // dd($kabkota);
        $data = Sekolah::all();
        // dd($data);
        // return $data;
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kondisi', function ($data) {
                    $cek = $data->kondisi;
                    if($cek == 1){
                        return 'Buka';
                    }else{
                        return 'Tutup';
                    }
                })
                ->addColumn('mengisi', function ($data) {
                    $cek1 = $data->updated_at;
                    if($cek1 !== null){
                        return '<span class="badge badge-success">Sudah di edit</span>';
                    }else{
                        return '<span class="badge badge-info">Belum di edit</span>';
                    }
                })   
                ->rawColumns(['mengisi','kondisi'])    
                ->make(true);
        }
        return view(
            'sekolah.admin_sekolah',
            compact('tittle')
        );
    }
    public function bmps(Request $request)
    {
        //
        $user = Auth::user();
        $tittle = $user->nama;
        $kabkota = $user->kab_kota;
        $status = 'swasta';
        // dd($kabkota);
        // $data = Sekolah::where('kab_kota',$kabkota)
        // ->where('status','swasta')
        // ->get();
        $data = Sekolah::latest()->where('status',$status)->get();
        // ddd($data);
        // return $data;
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $url = Crypt::encrypt($data->id);
                    return '<a href="javascript:void(0)" data-id="' . $url . '" class="btn btn-info show-btn"> Edit</a>';
                })
                ->addColumn('kondisi', function ($data) {
                    $cek = $data->updated_at;
                    if($cek !== null){
                        return '<span class="badge badge-success">Sudah di edit</span>';
                    }else{
                        return '<span class="badge badge-info">Belum di edit</span>';
                    }
                })        
                ->rawColumns(['aksi','kondisi'])        
                // ->rawColumns([])
                ->make(true);
        }
        return view(
            'sekolah.bmps_daftar_sekolah',
            compact('tittle')
        );
    }
    public function post($id)
    {
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
     * @param  \App\Http\Requests\StoresekolahRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $alldata = $request->all();
        $id = $request->id;
        $validator = $request->validate([
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'alamat' => 'required',
            'kelas' => 'max:25',
            'hpks' => 'numeric|digits_between:9,13',
            'hppj' => 'numeric|digits_between:9,13',
            'keterangan' => 'max:250',
            'kondisi' => 'required',
            'ijop' => 'file|mimes:pdf,PDF|max:512|nullable',
            'masa_ijop' => 'after:01/01/2019|before:01/01/2027|nullable',

        ]);
        $npsn = $request->npsn;
        // return $npsn;
        if ($request->file('ijop')) {
            $file = $request->file('ijop');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "_" . $npsn . "." . $extension;
            $validator['ijop'] = $filename;
            $file->storeAs('ijop', $filename);            
        }

        
        if($request->ijop!=null){
            $fileijop = $validator['ijop'];
        }else{
            $fileijop = '';           
        }
        if($request->masa_ijop!=null){
            $masaijop = $validator['masa_ijop'];
        }else{
            $masaijop = '';           
        }

        $unit =
            Sekolah::updateOrCreate(
            ['id' => $id],
            [
            'kelurahan' => $validator['kelurahan'],
            'kecamatan' => $validator['kecamatan'],
            'alamat' => $validator['alamat'],
            'kelas' => $validator['kelas'],
            'kondisi' => $validator['kondisi'],
            'keterangan' => $validator['keterangan'],
            'namaks' => $request->namaks,
            'namapj' => $request->namapj,
            'meluluskan' => $request->lulus,
            'no_ks' => $validator['hpks'],
            'file_ijop' =>$fileijop,
            'masa_ijop' => $masaijop,
            'hppj' => $validator['hppj']
        ]);

        return response()->json($unit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $decid = Crypt::decrypt($id);        // dd($decid);
        $where = array('id' => $decid);
        $unit = Sekolah::where($where)->first();
        return response()->json($unit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function edit(sekolah $sekolah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatesekolahRequest  $request
     * @param  \App\Models\sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesekolahRequest $request, $id)
    {
        //
        $decid = Crypt::decrypt($id);
        // return response()->json([
        //     'status'=>'200',
        //     'message'=>'Mengembalikan ID ='+$decid
        // ]);

        $validator = $request->validate([
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'alamat' => 'required',
            'kelas' => 'max:25',
            'keterangan' => 'max:250',
            'kondisi' => 'required',
            'file_ijop' => 'required|file|mimes:pdf,PDF|max:2048',
            'masa' => 'required|after:01/01/2019|before:01/01/2023',
            'namaks' => 'min:8|max:50',
            'namapj' => 'min:8|max:50',
            'hppj' => 'min:8|max:13|numeric',
            'hpks' => 'min:8|max:13|numeric'
        ]);

        $where = array('id' => $decid);
        $npsn = $where['npsn'];
        if ($request->file('file_ijop')) {
            $file = $request->file('ijop');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "_" . $npsn . $extension;
            $validator['file_ijop'] = $filename;
            $file->store('ijop/' . $filename);
        }
        Sekolah::upsert($validator);
        // if ($validator) {
        //     return response()->json([
        //         'status'=>400,
        //         'messages'=>'mohon cek data anda'
        //     ]);
        // } else {
        //     $where = array('id' => $decid);
        // $where->kelurahan = $request->input('kelurahan');
        // $where->kecamatan = $request->input('kecamatan');
        // $where->alamat = $request->input('alamat');
        // $where->kelas = $request->input('kelas');
        // $where->keterangan = $request->input('keterangan');
        // $where->kondisi = $request->input('kondisi');
        // $where->masa = $request->input('masa');
        // $where->namaks = $request->input('namaks');
        // $where->namapj = $request->input('namapj');
        // $where->hpks = $request->input('hpks');
        // $where->hppj = $request->input('hppj');

        // }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function destroy(sekolah $sekolah)
    {
        //
    }
}
