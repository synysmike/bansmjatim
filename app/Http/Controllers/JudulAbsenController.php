<?php

namespace App\Http\Controllers;

use App\Models\judul_absen;
use App\Http\Requests\Storejudul_absenRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Updatejudul_absenRequest;
use Carbon\Carbon;

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
        $data = judul_absen::all()->sortByDesc('created_at');
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $tanggalDisplay = $data->tanggal ? \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') : '';
                    $reportUrl = url('report_dh/' . $data->id);
                    $formUrl = url('presensi/' . $data->url);
                    $html = '<div class="action-dropdown">';
                    $html .= '<button type="button" class="action-dropdown-toggle">Aksi <i class="fas fa-chevron-down admin-icon-sm"></i></button>';
                    $html .= '<div class="action-dropdown-menu hidden">';
                    $html .= '<a href="' . $reportUrl . '" target="_blank"><i class="fas fa-file-alt admin-icon"></i> Report</a>';
                    $html .= '<a href="' . $formUrl . '" target="_blank"><i class="fas fa-external-link-alt admin-icon"></i> Lihat form</a>';
                    $html .= '<button type="button" class="btn-edit-judul" data-id="' . $data->id . '" data-judul="' . e($data->judul) . '" data-url="' . e($data->url) . '" data-tanggal="' . e($tanggalDisplay) . '" data-active="' . $data->activate . '"><i class="fas fa-edit admin-icon"></i> Edit</button>';
                    $html .= '<button type="button" class="btn-delete-judul text-red-600" data-id="' . $data->id . '" data-judul="' . e($data->judul) . '"><i class="fas fa-trash admin-icon"></i> Hapus</button>';
                    $html .= '</div></div>';
                    return $html;
                })
                ->addColumn('act', function ($data) {
                    if ($data->activate == 1) {
                        return '<span class="inline-flex px-2 py-1 text-xs font-medium rounded bg-green-100 text-green-800">Active</span>';
                    }
                    return '<span class="inline-flex px-2 py-1 text-xs font-medium rounded bg-red-100 text-red-800">Inactive</span>';
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
        // Convert DD-MM-YYYY from frontend to YYYY-MM-DD for MySQL
        $tanggal = $request->tanggal;
        if ($tanggal) {
            try {
                $tanggal = Carbon::createFromFormat('d-m-Y', $tanggal)->format('Y-m-d');
            } catch (\Exception $e) {
                // If already Y-m-d or other format, use as-is
            }
        }

        if ($request->id) {
            $inpid = ['id' => $request->id];
            $unit = judul_absen::updateOrCreate(
                $inpid,
                [
                    'judul' => $request->judul,
                    'url' => $request->url,
                    'tanggal' => $tanggal,
                    'activate' => $request->active
                ]
            );
        } else {
            $unit = judul_absen::updateOrCreate(
                [
                    'judul' => $request->judul,
                    'url' => $request->url,
                    'tanggal' => $tanggal,
                    'activate' => $request->active
                ]
            );
        }
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
        judul_absen::where('id', $judul_absen->id)->first();
        $tittle = $judul_absen->judul;
        $tanggal = $judul_absen->tanggal;
        $act = $judul_absen->activate;
        $mytime = now('Asia/Jakarta');
        $data = [
            'judul' => $tittle,
            'tanggal' => $tanggal,
            'activate' => $act,
            'waktu' => $mytime,
        ];
        dd($data);
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
        $judul_absen->delete();
        return response()->json(['success' => true, 'message' => 'Judul absen telah dihapus.']);
    }
}
