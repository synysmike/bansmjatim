<?php

namespace App\Http\Controllers;
use App\Models\sekolah;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DetilSekolahController extends Controller
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
        $decid = $user->username;
        $where = array('npsn' => $decid);
        $unit = Sekolah::where($where)->first();

        return view(
            'sekolah.edit_sekolah',
            compact('unit','tittle'));
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
    public function status()
    {
        //
        $user = Auth::user();
        $npsn = $user->username;
        $where = array('npsn' => $npsn);
        $unit = Verifikasi::where($where)->first();
        return response()->json($unit);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    public function perbaikan(Request $request)
    { 
        // dd($request->all());
        $id = $request->id;
        $unit =
        Verifikasi::updateOrCreate(
            ['id' => $id],
            [
            'cek' => $request->cek,
            'perbaikan' => $request->perbaikan
        ]);
        return response()->json($unit);
    }



    public function store(Request $request)
    {        
        $alldata = $request->all();
        // ddd($alldata);
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
        // dd($unit);

        return response()->json($unit);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
