<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $tittle = "Shorten Link BANSM Jatim";
        $data = Url::all();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $id = Crypt::encrypt($data->id);
                    $url = $data->long_url;
                    $btn = '<a href="javascript:void(0)" data-url="' . $url . '" data-name="'.$data->judul.'" class="btn-sm btn-success go-btn" title="Menuju halaman"><i class="fa fa-share"></i></a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $id . '" data-id="' . $id . '" class="ml-1 btn-sm btn-info edit" title="Edit"> <i class="fa fa-pencil"></i></a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $id . '" data-id="' . $id . '" class="ml-1 btn-sm btn-danger del-btn" title="hapus data"> <i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                // ->rawColumns([])
                ->make(true);
        }
        return view('url.form', compact('tittle'));
    }



    public function redirect($red)
    {
        $data = Url::where('slug', $red)->first();
        if($data){

            $redirect = $data->long_url;
            return redirect()->to(url($redirect));
        }
        // dd($redirect);
        
        // dd($red);
    }



    public function store(Request $request)
    {
        // $alldata = $request->all();
        // dd($alldata);
        $id = $request->id;
        $unit =
            Url::updateOrCreate(
                ['id' => $id],
                [
                    'judul' => $request->judul,
                    'slug' => $request->slug,
                    'long_url' => $request->long_url,
                    'short_url' => $request->short_url,
                    'deskripsi' => $request->deskripsi,

                ]
            );

        return response()->json($unit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUrlRequest  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function edit(Url $url)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUrlRequest  $request
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUrlRequest $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $id = crypt::decrypt($id);
        $data = Url::where('id', $id)->delete();
        return response()->json($data);
    }
}
