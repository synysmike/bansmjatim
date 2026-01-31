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
                        return '<img src="' . $url . '" class="w-20 h-20 object-cover rounded-lg border border-admin-border" alt="Berita Image" />';
                    }
                    return '<span class="text-admin-text-secondary text-sm">No Image</span>';
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<button type="button" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-admin-primary rounded-lg hover:bg-admin-primary-dark transition-all focus:outline-none focus:ring-2 focus:ring-admin-primary focus:ring-offset-2 editBeritaBtn" data-id="' . $row->id . '"><i class="fas fa-edit mr-1.5"></i>Edit</button>';
                    $deleteBtn = '<button type="button" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-admin-danger rounded-lg hover:bg-red-600 transition-all focus:outline-none focus:ring-2 focus:ring-admin-danger focus:ring-offset-2 deleteBeritaBtn ml-2" data-id="' . $row->id . '"><i class="fas fa-trash mr-1.5"></i>Delete</button>';
                    return '<div class="flex items-center space-x-2">' . $editBtn . $deleteBtn . '</div>';
                })
                ->rawColumns(['gambar', 'action'])
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

            // Ensure the folder exists with proper permissions
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            } else {
                // Ensure directory is writable
                chmod($destinationPath, 0777);
            }

            // Try to move the file
            try {
                $image->move($destinationPath, $imageName);
                // Save relative path for use in views or database
                $imagePath = 'images/berita/' . $imageName;
            } catch (\Exception $e) {
                \Log::error('Failed to save berita image: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan gambar: ' . $e->getMessage()
                ], 500);
            }
        }

        $berita = berita::create([
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
                    $editBtn = '<button type="button" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-admin-primary rounded-lg hover:bg-admin-primary-dark transition-all focus:outline-none focus:ring-2 focus:ring-admin-primary focus:ring-offset-2 editBtn" data-id="' . $row->id . '"><i class="fas fa-edit mr-1.5"></i>Edit</button>';
                    $deleteBtn = '<button type="button" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-admin-danger rounded-lg hover:bg-red-600 transition-all focus:outline-none focus:ring-2 focus:ring-admin-danger focus:ring-offset-2 deleteBtn ml-2" data-id="' . $row->id . '"><i class="fas fa-trash mr-1.5"></i>Delete</button>';
                    return '<div class="flex items-center space-x-2">' . $editBtn . $deleteBtn . '</div>';
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
    public function show(berita $beritum)
    {
        // Always return JSON for AJAX requests or when Accept header is application/json
        if (request()->wantsJson() || request()->ajax() || request()->expectsJson()) {
            // Helper function to get image URL
            $getImageUrl = function ($path) {
                if (!$path || trim($path) === '') return null;

                // Remove leading slash if present
                $normalizedPath = ltrim($path, '/');

                // Check if path already starts with http (absolute URL)
                if (strpos($normalizedPath, 'http') === 0) {
                    return $normalizedPath;
                }

                // Check if file exists
                $publicPath = public_path($normalizedPath);
                if (file_exists($publicPath)) {
                    return asset($normalizedPath);
                }

                // Fallback: try with asset() anyway
                return asset($normalizedPath);
            };

            // Get image URL - check both gmb and gmb1 fields, and any other image-related fields
            $imageUrl = null;

            // Check gmb field
            if (!empty($beritum->gmb)) {
                $imageUrl = $getImageUrl($beritum->gmb);
            }

            // Check gmb1 field if gmb is empty
            if (!$imageUrl && !empty($beritum->gmb1)) {
                $imageUrl = $getImageUrl($beritum->gmb1);
            }

            // Debug: log what we found
            \Log::info('Berita image check', [
                'id' => $beritum->id,
                'judul' => $beritum->judul,
                'gmb' => $beritum->gmb,
                'gmb1' => $beritum->gmb1,
                'imageUrl' => $imageUrl,
                'all_attributes' => array_keys($beritum->getAttributes())
            ]);

            return response()->json([
                'id' => $beritum->id,
                'judul' => $beritum->judul ?? '',
                'isi' => $beritum->isi ?? '',
                'gmb' => $imageUrl,
                'gmb1' => $beritum->gmb1 ? $getImageUrl($beritum->gmb1) : null,
                'created_at' => $beritum->created_at ? $beritum->created_at->format('d M Y') : '',
                'updated_at' => $beritum->updated_at ? $beritum->updated_at->format('d M Y') : '',
            ]);
        }

        return view('berita.show', compact('beritum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $berita = berita::findOrFail($id);
        return response()->json($berita);
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
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => 'required|exists:kategori,id',
            'croppedImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $berita = berita::findOrFail($id);
        $imagePath = $berita->gmb; // Keep existing image by default

        // Handle new image upload
        if ($request->hasFile('croppedImage')) {
            $image = $request->file('croppedImage');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('images/berita');

            // Ensure the folder exists with proper permissions
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            } else {
                chmod($destinationPath, 0777);
            }

            // Delete old image if exists
            if ($berita->gmb && file_exists(public_path($berita->gmb))) {
                @unlink(public_path($berita->gmb));
            }

            try {
                $image->move($destinationPath, $imageName);
                $imagePath = 'images/berita/' . $imageName;
            } catch (\Exception $e) {
                \Log::error('Failed to save berita image: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan gambar: ' . $e->getMessage()
                ], 500);
            }
        }

        // Handle cropped image from form data
        if ($request->has('croppedImageData') && $request->croppedImageData) {
            // This would be handled by the frontend converting base64 to file
            // For now, we'll rely on the croppedImage file upload
        }

        $berita->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'id_kat' => $request->kategori,
            'gmb' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil diperbarui.',
            'data' => $berita
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita = berita::findOrFail($id);

        // Delete associated image file if exists
        if ($berita->gmb && file_exists(public_path($berita->gmb))) {
            @unlink(public_path($berita->gmb));
        }

        $berita->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil dihapus.'
        ]);
    }
}
