<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_soslok_form;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreM_soslok_formRequest;
use App\Http\Requests\UpdateM_soslok_formRequest;

class MSoslokFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tittle = "form-field";
        $compact = array('tittle');
        $data = M_soslok_form::all();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('soslok/form', compact($compact));
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
     * @param  \App\Http\Requests\StoreM_soslok_formRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreM_soslok_formRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\M_soslok_form  $m_soslok_form
     * @return \Illuminate\Http\Response
     */
    public function show(M_soslok_form $m_soslok_form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\M_soslok_form  $m_soslok_form
     * @return \Illuminate\Http\Response
     */
    public function edit(M_soslok_form $m_soslok_form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateM_soslok_formRequest  $request
     * @param  \App\Models\M_soslok_form  $m_soslok_form
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateM_soslok_formRequest $request, M_soslok_form $m_soslok_form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\M_soslok_form  $m_soslok_form
     * @return \Illuminate\Http\Response
     */
    public function destroy(M_soslok_form $m_soslok_form)
    {
        //
    }
}
