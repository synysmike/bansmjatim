<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class FormBuilderController extends Controller
{
    /**
     * Display list of form templates.
     */
    public function index(Request $request)
    {
        $tittle = 'Form Builder';

        if ($request->ajax()) {
            try {
                $templates = FormTemplate::query()
                    ->select(['id', 'name', 'slug', 'description', 'is_active', 'created_at', 'updated_at'])
                    ->selectRaw('JSON_LENGTH(COALESCE(form_data, "[]")) as field_count')
                    ->orderBy('updated_at', 'desc');
                return DataTables::of($templates)
                    ->addIndexColumn()
                    ->addColumn('form_data_preview', function ($row) {
                        $count = (int) ($row->field_count ?? 0);
                        return $count ? $count . ' field(s)' : '—';
                    })
                    ->addColumn('status', function ($row) {
                        return $row->is_active
                            ? '<span class="badge badge-success">Active</span>'
                            : '<span class="badge badge-secondary">Inactive</span>';
                    })
                    ->addColumn('actions', function ($row) {
                        $html = '<div class="action-dropdown">';
                        $html .= '<button type="button" class="action-dropdown-toggle" aria-haspopup="true"><span>Actions</span><i class="fas fa-chevron-down admin-icon-sm"></i></button>';
                        $html .= '<div class="action-dropdown-menu hidden">';
                        $html .= '<a href="' . route('admin.form-builder.edit', $row->id) . '"><i class="fas fa-edit admin-icon"></i> Edit</a>';
                        $html .= '<a href="' . route('admin.form-builder.show', $row->id) . '" target="_blank"><i class="fas fa-eye admin-icon"></i> Preview</a>';
                        $html .= '<button type="button" onclick="deleteTemplate(' . $row->id . ')" class="text-left text-red-600"><i class="fas fa-trash admin-icon"></i> Delete</button>';
                        $html .= '</div></div>';
                        return $html;
                    })
                    ->rawColumns(['status', 'actions'])
                    ->make(true);
            } catch (\Illuminate\Database\QueryException $e) {
                if ($e->getCode() === '42S02' || str_contains($e->getMessage(), "doesn't exist")) {
                    $empty = DataTables::of(collect([]))->make(true);
                    $data = $empty->getData(true);
                    $data['table_missing'] = true;
                    return response()->json($data);
                }
                throw $e;
            }
        }

        return view('admin.form-builder.index', compact('tittle'));
    }

    /**
     * Show the form builder (create new template).
     */
    public function create()
    {
        $tittle = 'Create Form';
        $template = null;
        return view('admin.form-builder.builder', compact('tittle', 'template'));
    }

    /**
     * Store a new form template.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:form_templates,name',
            'form_data' => 'nullable|array',
            'description' => 'nullable|string|max:500',
        ]);

        $formData = $request->input('form_data');
        if (is_string($formData)) {
            $formData = json_decode($formData, true) ?: [];
        }

        $template = FormTemplate::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'form_data' => $formData,
            'description' => $request->description,
            'is_active' => true,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Form template saved successfully.',
                'data' => $template,
                'redirect' => route('admin.form-builder.index'),
            ]);
        }
        return redirect()->route('admin.form-builder.index')
            ->with('success', 'Form template saved successfully.');
    }

    /**
     * Show form template (preview / render).
     */
    public function show($id)
    {
        $template = FormTemplate::findOrFail($id);
        $tittle = $template->name;
        return view('admin.form-builder.show', compact('template', 'tittle'));
    }

    /**
     * Show the form builder with existing template (edit).
     */
    public function edit($id)
    {
        $template = FormTemplate::findOrFail($id);
        $tittle = 'Edit Form: ' . $template->name;
        return view('admin.form-builder.builder', compact('tittle', 'template'));
    }

    /**
     * Update form template.
     */
    public function update(Request $request, $id)
    {
        $template = FormTemplate::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:form_templates,name,' . $id,
            'form_data' => 'nullable|array',
            'description' => 'nullable|string|max:500',
        ]);

        $formData = $request->input('form_data');
        if (is_string($formData)) {
            $formData = json_decode($formData, true) ?: [];
        }

        $template->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'form_data' => $formData,
            'description' => $request->description,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Form template updated successfully.',
                'data' => $template->fresh(),
                'redirect' => route('admin.form-builder.index'),
            ]);
        }
        return redirect()->route('admin.form-builder.index')
            ->with('success', 'Form template updated successfully.');
    }

    /**
     * Remove form template.
     */
    public function destroy($id)
    {
        $template = FormTemplate::findOrFail($id);
        $template->delete();
        return response()->json([
            'success' => true,
            'message' => 'Form template deleted successfully.',
        ]);
    }

    /**
     * Get template data as JSON (for edit / API).
     */
    public function getTemplate($id)
    {
        $template = FormTemplate::findOrFail($id);
        return response()->json([
            'success' => true,
            'template' => [
                'id' => $template->id,
                'name' => $template->name,
                'form_data' => $template->form_data,
                'description' => $template->description,
            ],
        ]);
    }
}
