<?php

namespace App\Http\Controllers;

use App\Models\absen_dh;
use App\Models\judul_absen;
use App\Models\nama_sekretariat;
use App\Http\Requests\Storeabsen_dhRequest;
use App\Http\Requests\Updateabsen_dhRequest;
use DateTime;
use App\Http\Controllers\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class AbsenDhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $link) {}
    public function view(Request $request, $link)
    {

        // dd($link);
        $judul = judul_absen::where('id', $link)->first();

        $tittle = $judul->judul;
        $tanggal = $judul->tanggal;
        $data = absen_dh::join('tbm_nama_sekretariat', 'tbm_nama_sekretariat.id', '=', 'tbr_dhabsen.id_nama')
            ->where('tbr_dhabsen.tanggal', $tanggal)
            ->where('tbr_dhabsen.nama_judul', $tittle)
            ->get(['tbr_dhabsen.*', 'tbm_nama_sekretariat.nama'])->sortByDesc('created_at');

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('ttd', function ($data) {
                $cek =  URL::to($data->ttd);
                    if (!empty($data->ttd)) {
                        return '<img width="170" src="' . $cek . '" />';
                    } else {
                        return '-';
                    }
                })
                ->rawColumns(['ttd'])
                ->make(true);
        }
        return view('absen.report', compact('tittle'));
    }

    public function create() {}


    public function store(Request $request)
    {
        // untuk TTD
        $signature = $request->signature;
        $signatureFileName = uniqid() . '.png';
        $signature = str_replace('data:image/png;base64,', '', $signature);
        $signature = str_replace(' ', '+', $signature);
        $ttd = base64_decode($signature);
        $file = 'ttd_rapat/' . $signatureFileName;
        $mytime = Carbon::now('Asia/Jakarta');
        // file_put_contents($file, $ttd);
        Storage::disk('public')->put($file, $ttd);
        // file_put_contents($file, );
        $unit = absen_dh::updateOrCreate(
            [
                'id_nama' => $request->nama,
                'nama_judul' => $request->judul,
                'ttd' => $file,
                'tanggal' => $mytime
            ]
        );
        return response()->json($unit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\absen_dh  $absen_dh
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $link)
    {
        //
        // dd($link);
        $judul = judul_absen::where('id', $link)->first();
        $tittle = $judul->judul;
        $tanggal = $judul->tanggal;
        $act = $judul->activate;
        $mytime = Carbon::now('Asia/Jakarta');
        $format_tgl = date("d-m-Y", strtotime($tanggal));
        $data = absen_dh::join('tbm_nama_sekretariat', 'tbm_nama_sekretariat.id', '=', 'tbr_dhabsen.id_nama')
            ->where('tbr_dhabsen.tanggal', $tanggal)
            ->where('tbr_dhabsen.nama_judul', $tittle)
            ->get(['tbr_dhabsen.*', 'tbm_nama_sekretariat.nama'])->sortByDesc('created_at');

        $namas = nama_sekretariat::all();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('ttd', function ($data) {
                    $cek =  URL::to($data->ttd);
                    if (!empty($data->ttd)) {
                        return '<img width="170" src="' . $cek . '" />';
                    } else {
                        return '-';
                    }
                })
                ->rawColumns(['ttd'])
                ->make(true);
        }
        // dd($form);
        return view('absen.dh_absen', compact('tittle', 'namas', 'format_tgl', 'act'));
        // dd($cek);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\absen_dh  $absen_dh
     * @return \Illuminate\Http\Response
     */
    public function edit(absen_dh $absen_dh)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateabsen_dhRequest  $request
     * @param  \App\Models\absen_dh  $absen_dh
     * @return \Illuminate\Http\Response
     */
    // public function update(Updateabsen_dhRequest $request, absen_dh $absen_dh)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\absen_dh  $absen_dh
     * @return \Illuminate\Http\Response
     */
    public function destroy(absen_dh $absen_dh)
    {
        //
    }
}
