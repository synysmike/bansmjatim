<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class AdminHomeController extends Controller
{
    /**
     * Get allowed section keys with their descriptions
     */
    private function getAllowedSectionKeys()
    {
        return [
            'hero_title' => [
                'name' => 'Hero Section - Title',
                'description' => 'Main title displayed in the hero/banner section',
                'type' => 'text',
            ],
            'hero_description' => [
                'name' => 'Hero Section - Description',
                'description' => 'Description text displayed below the hero title',
                'type' => 'text',
            ],
            'hero_media' => [
                'name' => 'Hero Section - Background Media',
                'description' => 'Background media for hero section (Video file, Image file, or YouTube URL)',
                'type' => 'hero_media',
            ],
            'welcome_title' => [
                'name' => 'Welcome Section - Title',
                'description' => 'Title for the welcome/ketua section',
                'type' => 'text',
            ],
            'welcome_message' => [
                'name' => 'Welcome Section - Message',
                'description' => 'Welcome message from Ketua',
                'type' => 'rich_text',
            ],
            'ketua_image' => [
                'name' => 'Ketua Image',
                'description' => 'Photo of Ketua (displayed in welcome section)',
                'type' => 'image',
            ],
            'mekanisme_image' => [
                'name' => 'Mekanisme Akreditasi Image',
                'description' => 'Image explaining the accreditation mechanism',
                'type' => 'image',
            ],
            'hak_kewajiban_image' => [
                'name' => 'Hak dan Kewajiban Image',
                'description' => 'Image showing rights and obligations of members',
                'type' => 'image',
            ],
            'youtube_settings' => [
                'name' => 'YouTube API Settings',
                'description' => 'YouTube API configuration (API Key, Channel ID, Max Results)',
                'type' => 'youtube',
            ],
            'visi' => [
                'name' => 'Visi',
                'description' => 'Vision statement of the organization',
                'type' => 'rich_text',
            ],
            'misi' => [
                'name' => 'Misi',
                'description' => 'Mission statement of the organization',
                'type' => 'rich_text',
            ],
            'organization_name' => [
                'name' => 'Organization Name',
                'description' => 'Organization name used throughout the website (e.g., BAN-S/M, BAN-PDM)',
                'type' => 'text',
            ],
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tittle = 'Manage Home Page Content';

        $data = home::orderBy('sort_order')->orderBy('section_name')->get();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $status = $row->is_active
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-secondary">Inactive</span>';
                    return $status;
                })
                ->editColumn('content', function ($row) {
                    // Strip HTML tags for preview
                    $content = strip_tags($row->content ?? '');
                    if (strlen($content) > 50) {
                        return substr($content, 0, 50) . '...';
                    }
                    return $content ?: '-';
                })
                ->addColumn('image_preview', function ($row) {
                    if ($row->image_path) {
                        $url = asset($row->image_path);
                        return '<img src="' . $url . '" width="100" class="img-thumbnail" />';
                    }
                    return '<span class="text-muted">No Image</span>';
                })
                ->addColumn('actions', function ($row) {
                    $html = '<div class="action-dropdown">';
                    $html .= '<button type="button" class="action-dropdown-toggle" aria-haspopup="true"><span>Actions</span><i class="fas fa-chevron-down admin-icon-sm"></i></button>';
                    $html .= '<div class="action-dropdown-menu hidden">';
                    $html .= '<button type="button" onclick="openEditHomeContent(' . $row->id . ')" class="text-left"><i class="fas fa-edit admin-icon"></i> Edit</button>';
                    $html .= '<button type="button" onclick="deleteContent(' . $row->id . ')" class="text-left text-red-600"><i class="fas fa-trash admin-icon"></i> Delete</button>';
                    $html .= '</div></div>';
                    return $html;
                })
                ->rawColumns(['status', 'image_preview', 'actions'])
                ->make(true);
        }

        $sectionKeys = $this->getAllowedSectionKeys();
        $existingKeys = home::pluck('section_key')->toArray();
        $availableKeys = array_diff_key($sectionKeys, array_flip($existingKeys));
        return view('admin.home.index', compact('tittle', 'sectionKeys', 'availableKeys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tittle = 'Create Home Page Content';
        $sectionKeys = $this->getAllowedSectionKeys();
        $existingKeys = home::pluck('section_key')->toArray();
        // Filter out already created section keys
        $availableKeys = array_diff_key($sectionKeys, array_flip($existingKeys));

        return view('admin.home.create', compact('tittle', 'availableKeys', 'sectionKeys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $allowedKeys = array_keys($this->getAllowedSectionKeys());
        $sectionKeys = $this->getAllowedSectionKeys();

        // Auto-populate section_name based on selected section_key
        if ($request->filled('section_key') && isset($sectionKeys[$request->section_key])) {
            $request->merge(['section_name' => $sectionKeys[$request->section_key]['name']]);
        }

        $request->validate([
            'section_key' => 'required|string|in:' . implode(',', $allowedKeys) . '|unique:home_page_contents,section_key',
            'section_name' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'media_type' => 'nullable|in:video,youtube,image',
            'media_url' => 'nullable|string|max:500',
            'video_file' => 'nullable|mimes:mp4,webm,ogg|max:10240', // Max 10MB for video
            'youtube_api_key' => 'nullable|string|max:255',
            'youtube_channel_id' => 'nullable|string|max:255',
            'max_youtube_results' => 'nullable|integer|min:1|max:50',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|in:0,1',
        ]);

        $data = $request->except(['image', '_token', '_method']);

        // Handle is_active checkbox - convert to boolean
        $data['is_active'] = $request->input('is_active', 0) == 1 || $request->input('is_active') === true || $request->input('is_active') === '1';

        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                // Ensure directory exists and is writable
                $uploadDir = storage_path('app/public/home_content');
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                if (!is_writable($uploadDir)) {
                    chmod($uploadDir, 0777);
                }

                $imagePath = $request->file('image')->store('home_content', 'public');
                $data['image_path'] = 'storage/' . $imagePath;
            } catch (\Exception $e) {
                \Log::error('Image upload error: ' . $e->getMessage());
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()]);
            }
        } else {
            // Ensure image_path is null if no image uploaded
            $data['image_path'] = null;
        }

        // Handle hero media (video file, YouTube URL, or image)
        if ($request->section_key === 'hero_media') {
            $data['media_type'] = $request->input('media_type');

            if ($request->hasFile('video_file')) {
                try {
                    $uploadDir = storage_path('app/public/home_content');
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    if (!is_writable($uploadDir)) {
                        chmod($uploadDir, 0777);
                    }

                    $videoPath = $request->file('video_file')->store('home_content', 'public');
                    $data['media_url'] = 'storage/' . $videoPath;
                    $data['media_type'] = 'video';
                } catch (\Exception $e) {
                    \Log::error('Video upload error: ' . $e->getMessage());
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['video_file' => 'Failed to upload video: ' . $e->getMessage()]);
                }
            } elseif ($request->filled('media_url') && $request->input('media_type') === 'youtube') {
                $data['media_url'] = $request->input('media_url');
            } elseif ($request->hasFile('image') && $request->input('media_type') === 'image') {
                // Image already handled above, just set media_type
                $data['media_type'] = 'image';
                $data['media_url'] = $data['image_path'];
            }
        }

        // Ensure empty string values are null for nullable fields
        if (empty($data['content'])) {
            $data['content'] = null;
        } elseif ($request->section_key === 'organization_name') {
            // Strip HTML tags from organization name (should be plain text)
            $data['content'] = strip_tags(trim($data['content']));
        }
        if (empty($data['youtube_api_key'])) {
            $data['youtube_api_key'] = null;
        }
        if (empty($data['youtube_channel_id'])) {
            $data['youtube_channel_id'] = null;
        }
        if (empty($data['max_youtube_results'])) {
            $data['max_youtube_results'] = null;
        }
        if (empty($data['sort_order'])) {
            $data['sort_order'] = 0;
        }

        try {
            $content = home::create($data);
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Home page content created successfully.', 'data' => $content]);
            }
            return redirect()->route('admin.home.index')
                ->with('success', 'Home page content created successfully.');
        } catch (\Exception $e) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage(), 'errors' => []], 422);
            }
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create content: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $content = home::findOrFail($id);
        $tittle = 'View Home Page Content';
        return view('admin.home.show', compact('content', 'tittle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $content = home::findOrFail($id);
        if ($request->wantsJson() || $request->ajax()) {
            $data = $content->toArray();
            $data['image_path'] = $content->image_path ? (strpos($content->image_path, 'http') === 0 ? $content->image_path : asset($content->image_path)) : null;
            return response()->json($data);
        }
        $tittle = 'Edit Home Page Content';
        $sectionKeys = $this->getAllowedSectionKeys();
        return view('admin.home.edit', compact('content', 'tittle', 'sectionKeys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = home::findOrFail($id);

        $allowedKeys = array_keys($this->getAllowedSectionKeys());

        $request->validate([
            'section_key' => 'required|string|in:' . implode(',', $allowedKeys) . '|unique:home_page_contents,section_key,' . $id,
            'section_name' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'media_type' => 'nullable|in:video,youtube,image',
            'media_url' => 'nullable|string|max:500',
            'video_file' => 'nullable|mimes:mp4,webm,ogg|max:10240',
            'youtube_api_key' => 'nullable|string|max:255',
            'youtube_channel_id' => 'nullable|string|max:255',
            'max_youtube_results' => 'nullable|integer|min:1|max:50',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|in:0,1',
        ]);

        $data = $request->except(['image', 'video_file', '_token', '_method']);

        // Handle is_active checkbox - convert to boolean
        $data['is_active'] = $request->input('is_active', 0) == 1 || $request->input('is_active') === true || $request->input('is_active') === '1';

        // Handle hero media (video file, YouTube URL, or image)
        if ($request->section_key === 'hero_media') {
            $data['media_type'] = $request->input('media_type');

            if ($request->hasFile('video_file')) {
                try {
                    $uploadDir = storage_path('app/public/home_content');
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    if (!is_writable($uploadDir)) {
                        chmod($uploadDir, 0777);
                    }

                    // Delete old video if exists
                    if ($content->media_url && Storage::disk('public')->exists(str_replace('storage/', '', $content->media_url))) {
                        Storage::disk('public')->delete(str_replace('storage/', '', $content->media_url));
                    }

                    $videoPath = $request->file('video_file')->store('home_content', 'public');
                    $data['media_url'] = 'storage/' . $videoPath;
                    $data['media_type'] = 'video';
                } catch (\Exception $e) {
                    \Log::error('Video upload error: ' . $e->getMessage());
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['video_file' => 'Failed to upload video: ' . $e->getMessage()]);
                }
            } elseif ($request->filled('media_url') && $request->input('media_type') === 'youtube') {
                $data['media_url'] = $request->input('media_url');
            } elseif ($request->hasFile('image') && $request->input('media_type') === 'image') {
                // Handle image upload for hero media
                try {
                    $uploadDir = storage_path('app/public/home_content');
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    if (!is_writable($uploadDir)) {
                        chmod($uploadDir, 0777);
                    }

                    // Delete old media if exists
                    if ($content->media_url && Storage::disk('public')->exists(str_replace('storage/', '', $content->media_url))) {
                        Storage::disk('public')->delete(str_replace('storage/', '', $content->media_url));
                    }

                    $imagePath = $request->file('image')->store('home_content', 'public');
                    $data['image_path'] = 'storage/' . $imagePath;
                    $data['media_url'] = 'storage/' . $imagePath;
                    $data['media_type'] = 'image';
                } catch (\Exception $e) {
                    \Log::error('Image upload error: ' . $e->getMessage());
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()]);
                }
            } elseif ($request->filled('media_type')) {
                // Keep existing media_url if no new file uploaded
                $data['media_url'] = $content->media_url ?? $request->input('media_url');
            }
        } else {
            // Handle regular image upload
            if ($request->hasFile('image')) {
                try {
                    // Ensure directory exists and is writable
                    $uploadDir = storage_path('app/public/home_content');
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    if (!is_writable($uploadDir)) {
                        chmod($uploadDir, 0777);
                    }

                    // Delete old image
                    if ($content->image_path && Storage::disk('public')->exists(str_replace('storage/', '', $content->image_path))) {
                        Storage::disk('public')->delete(str_replace('storage/', '', $content->image_path));
                    }

                    $imagePath = $request->file('image')->store('home_content', 'public');
                    $data['image_path'] = 'storage/' . $imagePath;
                } catch (\Exception $e) {
                    \Log::error('Image upload error: ' . $e->getMessage());
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()]);
                }
            }
        }

        // Strip HTML tags from organization name if it's organization_name section
        if ($content->section_key === 'organization_name' && isset($data['content'])) {
            $data['content'] = strip_tags(trim($data['content']));
        }

        $content->update($data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Home page content updated successfully.', 'data' => $content->fresh()]);
        }
        return redirect()->route('admin.home.index')
            ->with('success', 'Home page content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $content = home::findOrFail($id);

        // Delete image if exists
        if ($content->image_path && Storage::disk('public')->exists(str_replace('storage/', '', $content->image_path))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $content->image_path));
        }

        $content->delete();

        return response()->json(['success' => true, 'message' => 'Content deleted successfully.']);
    }
}
