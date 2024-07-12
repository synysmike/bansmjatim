<?php

namespace App\Http\Controllers;

use App\Models\record_bio;
use Illuminate\Http\Request;
use App\Models\M_soslok_form;
use App\Models\M_soslok_judul;
use App\Models\M_soslok_sekolah;
use Yajra\DataTables\DataTables;
use App\Models\Record_soslok_config;
use App\Http\Requests\Storerecord_bioRequest;
use App\Http\Requests\Updaterecord_bioRequest;

class RecordBioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tittle = "bio";
        $compact = array('tittle');
        $data = record_bio::all();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('soslok/bio', compact($compact));
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
     * @param  \App\Http\Requests\Storerecord_bioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storerecord_bioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\record_bio  $record_bio
     * @return \Illuminate\Http\Response
     */
    public function show(record_bio $record_bio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\record_bio  $record_bio
     * @return \Illuminate\Http\Response
     */
    public function edit(record_bio $record_bio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updaterecord_bioRequest  $request
     * @param  \App\Models\record_bio  $record_bio
     * @return \Illuminate\Http\Response
     */
    public function update(Updaterecord_bioRequest $request, record_bio $record_bio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\record_bio  $record_bio
     * @return \Illuminate\Http\Response
     */
    public function destroy(record_bio $record_bio)
    {
        //
    }
}
