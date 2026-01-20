<?php

namespace App\Http\Controllers;

use App\Models\nama_sekretariat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class NamaSekretariatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tittle = 'Staff Management';
        $data = nama_sekretariat::all();
        
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="' . route('admin.staff.edit', $row->id) . '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>';
                    $deleteBtn = '<button class="btn btn-sm btn-danger" onclick="deleteStaff(' . $row->id . ')"><i class="fas fa-trash"></i> Delete</button>';
                    return $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('admin.staff.index', compact('tittle', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tittle = 'Create Staff';
        return view('admin.staff.create', compact('tittle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'unit' => 'nullable|string|in:Ketua,Sekretaris,Anggota,KPKK,Staff Administrasi,Staff Keuangan,Staff Data dan IT',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = [
            'nama' => $request->nama,
            'unit' => $request->unit ?? null,
            'createdAt' => now(),
            'updated_at' => now(),
        ];
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            try {
                $uploadDir = storage_path('app/public/staff_photos');
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                if (!is_writable($uploadDir)) {
                    chmod($uploadDir, 0777);
                }
                
                $photoPath = $request->file('photo')->store('staff_photos', 'public');
                $data['photo'] = 'storage/' . $photoPath;
            } catch (\Exception $e) {
                \Log::error('Photo upload error: ' . $e->getMessage());
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['photo' => 'Failed to upload photo: ' . $e->getMessage()]);
            }
        }
        
        nama_sekretariat::create($data);
        
        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\nama_sekretariat  $nama_sekretariat
     * @return \Illuminate\Http\Response
     */
    public function show(nama_sekretariat $nama_sekretariat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\nama_sekretariat  $nama_sekretariat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tittle = 'Edit Staff';
        $staff = nama_sekretariat::findOrFail($id);
        return view('admin.staff.edit', compact('tittle', 'staff'));
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
            'nama' => 'required|string|max:255',
            'unit' => 'nullable|string|in:Ketua,Sekretaris,Anggota,KPKK,Staff Administrasi,Staff Keuangan,Staff Data dan IT',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $staff = nama_sekretariat::findOrFail($id);
        
        $data = [
            'nama' => $request->nama,
            'unit' => $request->unit ?? null,
            'updated_at' => now(),
        ];
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            try {
                $uploadDir = storage_path('app/public/staff_photos');
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                if (!is_writable($uploadDir)) {
                    chmod($uploadDir, 0777);
                }
                
                // Delete old photo if exists
                if ($staff->photo && Storage::disk('public')->exists(str_replace('storage/', '', $staff->photo))) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $staff->photo));
                }
                
                $photoPath = $request->file('photo')->store('staff_photos', 'public');
                $data['photo'] = 'storage/' . $photoPath;
            } catch (\Exception $e) {
                \Log::error('Photo upload error: ' . $e->getMessage());
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['photo' => 'Failed to upload photo: ' . $e->getMessage()]);
            }
        } elseif ($request->input('clear_photo')) {
            // Delete photo if clear_photo is checked
            if ($staff->photo && Storage::disk('public')->exists(str_replace('storage/', '', $staff->photo))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $staff->photo));
            }
            $data['photo'] = null;
        }
        
        $staff->update($data);
        
        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = nama_sekretariat::findOrFail($id);
        
        // Delete photo if exists
        if ($staff->photo && Storage::disk('public')->exists(str_replace('storage/', '', $staff->photo))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $staff->photo));
        }
        
        $staff->delete();
        
        return response()->json(['success' => true, 'message' => 'Staff deleted successfully.']);
    }
}
