<?php

namespace App\Http\Controllers;

use App\Models\berita;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreberitaRequest;
use App\Http\Requests\UpdateberitaRequest;
use App\Models\Kategori;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function ordal_berita(Request $request)
    {
        //
        $tittle = 'Ordal Berita';
        $data = berita::all();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn();
        }
        return view('berita.ordal', compact('data', 'tittle'));

        // return view('berita.ordal', compact('tittle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreberitaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }


    public function get_kat(Request $request)
    {
        if ($request->ajax()) {
            $data = Kategori::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editBtn = '<button type="button" class="btn btn-sm btn-primary editBtn" data-id="' . $row->id . '">Edit</button>';
                    $deleteBtn = '<button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="' . $row->id . '">Delete</button>';
                    return $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store_kat(Request $request)
    {
        //
        Kategori::updateOrCreate(
            ['id' => $request->id],
            [
                'nama' => $request->categoryName,
                'desc' => $request->categoryDescription,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }

    public function edit_kat($id)
    {
        $kategori = Kategori::findOrFail($id);
        return response()->json($kategori);
    }
    public function destroy_kat($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return response()->json(['success' => true, 'message' => 'Category deleted successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show(berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit(berita $berita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateberitaRequest  $request
     * @param  \App\Models\berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateberitaRequest $request, berita $berita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy(berita $berita)
    {
        //
    }
}
