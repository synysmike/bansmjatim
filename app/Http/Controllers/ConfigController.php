<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Config;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreConfigRequest;
use App\Http\Requests\UpdateConfigRequest;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $forms = Form::all();
        $confs = Config::all();
        $tittle = "uji select2";
        // $data = Config::where('id', '1')->first();        
        // $newdata = explode(",", $confs->tabel);
        // dd($data);
        if ($request->ajax()) {
            return DataTables::of($confs)
                ->addIndexColumn()
                ->addColumn('aksi', function ($confs) {
                    $valId = $confs->id;
                    $url = Crypt::encrypt($valId);
                    $red = ' <a href="/form/' . $confs->link . '" terget="_blank" class="btn btn-outline-secondary"> View Form</a>';
                    $btn = ' <a href="/list-dh/' . $confs->link . '" data-id="' . $url . '" class="btn btn-success"> Report</a>';
                    $btn1 = ' <a href="javascript:void(0)" data-id="' . $valId . '" class="btn btn-info show-btn"> Edit</a>';
                    $aksi = $red . $btn . $btn1 . ' <a href="javascript:void(0)" data-id="' . $url . '" class="btn btn-danger del-btn"> Hapus</a>';
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('daftarhadir.config', compact('tittle', 'forms'));
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
     * @param  \App\Http\Requests\StoreConfigRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $test = $request->all();
        // dd($test);
        // return response()->json($test);
        $tabel = str_replace(" ", "", $request->tag);
        $newdata = implode("),(", $tabel);
        // $decid = Crypt::decrypt($request->id);
        // if ($request->id) {
        //     $insertId = ['id' => $decid];
        // } else {
        //     $insertId = null;
        // }
        $unit = Config::updateOrCreate(
            ['id' => $request->id],
            [
                "tabel" => $newdata,
                "kategori" => $request->kat,
                "link" => $request->link,
                "judul" => $request->judul,
            ]
        );
        return response()->json($unit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $decid = Crypt::decrypt($id);        // dd($decid);
        $where = array('id' => $id);
        $unit = Config::where($where)->first();
        return response()->json($unit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit(Config $config)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConfigRequest  $request
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConfigRequest $request, Config $config)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $id = crypt::decrypt($id);
        $data = Config::where('id', $id)->delete();
        return response()->json($data);
    }
}
