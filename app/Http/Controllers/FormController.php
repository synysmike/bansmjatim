<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Requests\StoreFormRequest;
use App\Http\Requests\UpdateFormRequest;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tittle = 'Form';
        return view('form.list_form',compact('tittle'));

        //
    }

public function get_form()
{
    $data = Form::all(); // or Form::select('*') if needed
    return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('tag_field', function ($row) {
            return '<span class="badge bg-success">' . $row->tag_field . '</span>';
        })
        ->rawColumns(['tag_field']) // 👈 this ensures your HTML is rendered
        ->make(true);


}

    public function create()
    {
        //
    }

    
    public function store(StoreFormRequest $request)
    {
        //
    }

    
    public function show(Form $form)
    {
        //
    }

    
    public function edit(Form $form)
    {
        //
    }

    public function update(UpdateFormRequest $request, Form $form)
    {
        //
    }

    public function destroy(Form $form)
    {
        //
    }
}
