<?php

namespace App\Http\Controllers;

use App\Models\nama_sekretariat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Requests\Storenama_sekretariatRequest;
use App\Http\Requests\Updatenama_sekretariatRequest;

class NamaSekretariatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = nama_sekretariat::all();
        dd($data);
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
     * @param  \App\Http\Requests\Storenama_sekretariatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storenama_sekretariatRequest $request)
    {
        //
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
    public function edit(nama_sekretariat $nama_sekretariat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatenama_sekretariatRequest  $request
     * @param  \App\Models\nama_sekretariat  $nama_sekretariat
     * @return \Illuminate\Http\Response
     */
    public function update(Updatenama_sekretariatRequest $request, nama_sekretariat $nama_sekretariat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\nama_sekretariat  $nama_sekretariat
     * @return \Illuminate\Http\Response
     */
    public function destroy(nama_sekretariat $nama_sekretariat)
    {
        //
    }
}
