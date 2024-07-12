<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = Gallery::All();
        $tittle = "Daftar Gallery";
        $cek = 1;
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('file', function ($data) {
                    $src = $data->file;
                    // $alt = $data->fjudul;
                    // return '<img class="img-thumbnail" src="' . $img . '" alt="' . $alt . '">';
                    return '<img width="100px" class="img-thumbnail" data-magnify="gallery" data-src="' . $src . '" src="' . $src . '" alt=""> </br><label class="form-label">click image to Preview</label>';
                })
                ->addColumn('aksi', function ($data) {
                    $url = Crypt::encrypt($data->id);
                $btn = '<a href="javascript:void(0)" data-id="' . $url . '" class="btn btn-info show-btn"> Edit</a>';
                $btn1 = $btn . " " . '<a href="javascript:void(0)" data-id="' . $url . '" class="btn btn-danger del-btn"> Hapus</a>';
                return $btn1;
                })
                // ->addColumn('kondisi', function ($data) {
                //     $cek = $data->updated_at;
                //     if($cek !== null){
                //         return '<span class="badge badge-success">Sudah di edit</span>';
                //     }else{
                //         return '<span class="badge badge-info">Belum di edit</span>';
                //     }
                // })        
                ->rawColumns(['aksi', 'file'])
                // ->rawColumns([])
                ->make(true);
        }
        return view(
            'konten.gallery.index',
            compact('tittle', 'cek')
        );

        // return "galeri";
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = $request->validate([
            'file' => 'file|mimes:jpg,jpeg,png|max:1028|nullable',
            'judul' => 'nullable',
            'jenis' => 'nullable',
        ]);

        if (isset($validator->error)) {
            return response()->json($validator);
        } else {
            $mytime = date('Y-m-d H:i:s');
            if ($request->file('gambar')) {
                $imageName = time() . '.' . $request->gambar->getClientOriginalExtension();
                $path = $request->gambar->storeAs('images', $imageName, 'my_files');
            }

            $unit_gall = Gallery::updateOrCreate(
                ['id' => $request->id_gall],
                [
                    'judul' => $validator['judul'],
                    'file' => $path,
                    'desc' => $request->desc,
                    'jenis' => $validator['jenis'],
                    'show' => $request->show,
                    'range_show' => $request->range_show
                ]
            );
            return response()->json($unit_gall);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $decid = Crypt::decrypt($id);        // dd($decid);
        $where = array('id' => $decid);
        $unit = Gallery::where($where)->first();
        return response()->json($unit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $id = crypt::decrypt($id);
        $data = Gallery::where('id', $id)->delete();
        return response()->json($data);
    }
}
