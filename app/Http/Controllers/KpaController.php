<?php

namespace App\Http\Controllers;

use App\Models\kpa;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorekpaRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Http\Requests\UpdatekpaRequest;

class KpaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('auth.reg');
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
     * @param  \App\Http\Requests\StorekpaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate(['nama' => 'required',
            'k_asal' => 'required',
            'unit' => 'required',
            'unsur' => 'required',
            'nohp' => 'numeric|digits_between:9,13'
        ]);
        // simpan nama gambar

        // $validator['signature'] = Storage::disk('local')->put($file, $ttd);

        $unit =
            [
            'nama' => $request->nama,
            'tgl_lhr' => $request->tgl_lhr,
            'k_asal' => $request->k_asal,
            'unit' => $request->unit,
            'unsur' => $request->unsur,
            'nohp' => $request->nohp,
            // 'npwp' =>$request->,
            // 'norek' =>$request->,
            'alamat_r' => $request->alamat_r,
            'alamat_k' => $request->alamat_k

            ];

        $useracc = [
            'name' => $request->nama,
            'kab_kota' => $request->k_asal,
            'username' => $request->nohp,
            'password' => bcrypt('kpabanjatim'),
            'jabatan' => 'kpa'

        ];
        $user = User::updateOrCreate($useracc);
        $user->assignRole('kpa');
        Kpa::updateOrCreate($unit);
        //     // 'document' => $request->file('document')->store('dokumen/'.$parent->tahun.'/'.$parent->satker->namasatker.'/'.$parent->risk_code.'/tindakan-penanganan', 'public'),
        //

        return response()->json($unit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kpa  $kpa
     * @return \Illuminate\Http\Response
     */
    public function show(kpa $kpa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kpa  $kpa
     * @return \Illuminate\Http\Response
     */
    public function edit(kpa $kpa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatekpaRequest  $request
     * @param  \App\Models\kpa  $kpa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatekpaRequest $request, kpa $kpa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kpa  $kpa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        // $data = User::where('id', $id)->delete();
        // return response()->json($data);
    }
}
