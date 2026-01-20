<?php

namespace App\Http\Controllers;

use App\Models\home;
use App\Models\Gallery;
use App\Models\nama_sekretariat;
use Illuminate\Routing\Controller;
use App\Http\Requests\StorehomeRequest;
use App\Http\Requests\UpdatehomeRequest;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // Get YouTube settings from database
        $ytSettings = home::getYouTubeSettings();
        $yt_api = $ytSettings['api_key'] ?? "AIzaSyDIIombcWAuo0y-P0WpJS16gTh1wXnlZvA";
        $channelId = $ytSettings['channel_id'] ?? "UCY3xEkfOgt4zNi4gDT-0kTw";
        $maxResults = $ytSettings['max_results'] ?? 6;
        
        $items = [];
        
        // Fetch YouTube videos if API key and channel ID are available
        if ($yt_api && $channelId) {
            try {
                $response = Http::get('https://www.googleapis.com/youtube/v3/search', [
                    'key' => $yt_api,
                    'channelId' => $channelId,
                    'part' => 'snippet,id',
                    'order' => 'date',
                    'maxResults' => $maxResults
                ]);
                
                if ($response->successful()) {
                    $decode_json = $response->json();
                    $items = $decode_json['items'] ?? [];
                } else {
                    // Set empty array on failure, try to log but don't fail if logging fails
                    try {
                        \Log::error('YouTube API Error: ' . $response->status() . ' - ' . $response->body());
                    } catch (\Exception $logException) {
                        // Silently ignore logging errors
                    }
                    $items = [];
                }
            } catch (\Exception $e) {
                // Set empty array on exception, try to log but don't fail if logging fails
                try {
                    \Log::error('YouTube API Exception: ' . $e->getMessage());
                } catch (\Exception $logException) {
                    // Silently ignore logging errors
                }
                $items = [];
            }
        }
        
        // Get organization name
        $orgName = home::getOrganizationName('BAN-PDM');
        
        // Get home page content sections
        $heroTitle = home::getByKey('hero_title', 'Selamat Datang Di Website ' . $orgName . ' Provinsi Jawa Timur');
        $heroDescription = home::getByKey('hero_description', 'Misi ' . $orgName . ' Provinsi Jawa Timur');
        $heroMedia = home::getHeroMedia();
        $welcomeTitle = home::getByKey('welcome_title', 'SAMBUTAN KETUA ' . $orgName . ' PROVINSI JAWA TIMUR');
        $welcomeMessage = home::getByKey('welcome_message', '');
        $visi = home::getByKey('visi', '');
        $misi = home::getByKey('misi', '');
        $ketuaImage = home::getImageByKey('ketua_image', asset('public_assets/images/ketua.jpeg'));
        $mekanismeImage = home::getImageByKey('mekanisme_image', asset('public_assets/images/meka.png'));
        $hakKewajibanImage = home::getImageByKey('hak_kewajiban_image', asset('public_assets/images/hak.JPG'));
        
        // Get gallery photos
        $foto = Gallery::orderBy('created_date','DESC')->get();
        
        // Get recent updates/news (using berita model)
        // Note: Remove is_active filter if column doesn't exist in beritas table
        $recentUpdates = \App\Models\berita::orderBy('created_at', 'DESC')
            ->limit(3)
            ->get();
        
        // Get staff members grouped by unit
        $allStaff = nama_sekretariat::orderBy('nama')->get();
        
        // Group staff by unit
        $staffByUnit = [
            'ketua_sekretaris' => $allStaff->whereIn('unit', ['Ketua', 'Sekretaris'])->values(),
            'anggota' => $allStaff->where('unit', 'Anggota')->values(),
            'kpkk' => $allStaff->where('unit', 'KPKK')->values(),
            'staff_administrasi' => $allStaff->where('unit', 'Staff Administrasi')->values(),
            'staff_keuangan' => $allStaff->where('unit', 'Staff Keuangan')->values(),
            'staff_data_it' => $allStaff->where('unit', 'Staff Data dan IT')->values(),
        ];
        
        return view('public.home', compact(
            'foto', 
            'items', 
            'orgName',
            'heroTitle',
            'heroDescription',
            'heroMedia',
            'welcomeTitle',
            'welcomeMessage',
            'visi',
            'misi',
            'ketuaImage',
            'mekanismeImage',
            'hakKewajibanImage',
            'recentUpdates',
            'staffByUnit'
        ));
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
     * @param  \App\Http\Requests\StorehomeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorehomeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\home  $home
     * @return \Illuminate\Http\Response
     */
    public function show(home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\home  $home
     * @return \Illuminate\Http\Response
     */
    public function edit(home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatehomeRequest  $request
     * @param  \App\Models\home  $home
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatehomeRequest $request, home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\home  $home
     * @return \Illuminate\Http\Response
     */
    public function destroy(home $home)
    {
        //
    }
}
