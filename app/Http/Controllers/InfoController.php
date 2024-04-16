<?php

namespace App\Http\Controllers;

use App\Models\info;
use App\Http\Requests\StoreinfoRequest;
use App\Http\Requests\UpdateinfoRequest;

class InfoController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreinfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreinfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\info  $info
     * @return \Illuminate\Http\Response
     */
    public function show(info $info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\info  $info
     * @return \Illuminate\Http\Response
     */
    public function edit(info $info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateinfoRequest  $request
     * @param  \App\Models\info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateinfoRequest $request, info $info)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\info  $info
     * @return \Illuminate\Http\Response
     */
    public function destroy(info $info)
    {
        //
    }
}
