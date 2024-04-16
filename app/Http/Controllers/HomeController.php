<?php

namespace App\Http\Controllers;

use App\Models\home;
use App\Models\Gallery;
use Illuminate\Routing\Controller;
use App\Http\Requests\StorehomeRequest;
use App\Http\Requests\UpdatehomeRequest;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $yt_api = "AIzaSyDIIombcWAuo0y-P0WpJS16gTh1wXnlZvA";
        $channelId = "UCY3xEkfOgt4zNi4gDT-0kTw";
        $yt_api_url = "https://www.googleapis.com/youtube/v3/search?key=".$yt_api."&channelId=".$channelId."&part=snippet,id&order=date&maxResults=6";
        $yt_json = file_get_contents($yt_api_url);
        $decode_json = json_decode($yt_json,true);
        $items = $decode_json['items'];
        // dd($decode_json['items']);
        $foto= Gallery::orderBy('created_date','DESC')->get();
        return view(
            'public.home',compact('foto','items')
        );
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
