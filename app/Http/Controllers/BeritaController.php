<?php

namespace App\Http\Controllers;

use App\Models\berita;
use Illuminate\Support\Facades\Storage;
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
                ->addIndexColumn()
                ->addColumn('gambar', function ($row) {
                    if ($row->gmb) {
                        $url = asset($row->gmb); // uses public path directly
                        return '<img src="' . $url . '" width="100" class="img-thumbnail" />';
                    }
                    return '<span class="text-muted">No Image</span>';
                })

                ->rawColumns(['gambar'])
                ->make(true);
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
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => 'required|exists:kategori,id',
            'croppedImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('croppedImage')) {
            $image = $request->file('croppedImage');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('images/berita');

            // Ensure the folder exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            // Save relative path for use in views or database
            $imagePath = 'images/berita/' . $imageName;
        }

        $berita = Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'id_kat' => $request->kategori,
            'gmb' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil disimpan.',
            'data' => $berita
        ]);
    }



    public function get_katlist()
    {
        // $kategori = Kategori::all();
        $kategori = Kategori::select('id', 'nama')->get();
        return response()->json($kategori);
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
        $kategori = Kategori::updateOrCreate(
            ['id' => $request->id],
            [
                'nama' => $request->categoryName,
                'desc' => $request->categoryDescription,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil disimpan.',
            'data' => $kategori
        ]);
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
