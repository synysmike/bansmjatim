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
        $forms = Form::all();
        $confs = Config::all();
        $tittle = $request->routeIs('admin.config.*') ? 'Configuration' : 'uji select2';

        if ($request->ajax()) {
            $isAdmin = $request->routeIs('admin.config.*');
            return DataTables::of($confs)
                ->addIndexColumn()
                ->addColumn('link', function ($confs) {
                    $link = $confs->link ? trim($confs->link) : '';
                    $fullUrl = $link !== '' ? url('/form/' . $link) : '';
                    $display = $fullUrl !== '' ? e($fullUrl) : '—';
                    if ($fullUrl === '') {
                        return '<span class="text-admin-text-secondary">—</span>';
                    }
                    return '<button type="button" class="config-copy-link inline-flex items-center gap-2 text-left text-sm text-admin-primary hover:text-admin-secondary hover:underline break-all" data-url="' . e($fullUrl) . '" title="Klik untuk copy link"><span class="min-w-0 truncate max-w-[200px] sm:max-w-none">' . $display . '</span><i class="fas fa-copy admin-icon flex-shrink-0"></i></button>';
                })
                ->addColumn('aksi', function ($confs) use ($isAdmin) {
                    $valId = $confs->id;
                    $url = Crypt::encrypt($valId);
                    $link = e($confs->link);
                    $html = '<div class="action-dropdown">';
                    $html .= '<button type="button" class="action-dropdown-toggle" aria-haspopup="true"><span>Actions</span><i class="fas fa-chevron-down admin-icon-sm"></i></button>';
                    $html .= '<div class="action-dropdown-menu hidden">';
                    $html .= '<a href="/form/' . $link . '" target="_blank"><i class="fas fa-external-link-alt admin-icon"></i> View Form</a>';
                    $html .= '<a href="/list-dh/' . $link . '" target="_blank"><i class="fas fa-list admin-icon"></i> Report</a>';
                    $html .= '<button type="button" data-id="' . $valId . '" class="text-left config-edit-btn"><i class="fas fa-edit admin-icon"></i> Edit</button>';
                    $html .= '<a href="/cetak-dh/' . $link . '" target="_blank"><i class="fas fa-print admin-icon"></i> Cetak Form</a>';
                    $html .= '<button type="button" data-id="' . $url . '" class="text-left text-red-600 config-del-btn"><i class="fas fa-trash admin-icon"></i> Hapus</button>';
                    $html .= '</div></div>';
                    return $html;
                })
                ->rawColumns(['aksi', 'link'])
                ->make(true);
        }

        if ($request->routeIs('admin.config.*')) {
            return view('admin.config.index', compact('tittle', 'forms'));
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
