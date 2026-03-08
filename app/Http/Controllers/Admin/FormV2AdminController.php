<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormFieldDefinition;
use App\Models\FormV2Config;
use App\Models\FormV2Submission;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class FormV2AdminController extends Controller
{
    public function index(Request $request)
    {
        $tittle = 'Form V2 (Struktur)';
        return view('admin.form-v2.index', compact('tittle'));
    }

    /** Field definitions - DataTable */
    public function fieldDefinitions(Request $request)
    {
        if ($request->ajax()) {
            $data = FormFieldDefinition::orderBy('sort_order')->orderBy('nama_field');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    return '<button type="button" data-edit-field="' . $row->id . '" class="text-admin-primary hover:underline bg-transparent border-none cursor-pointer"><i class="fas fa-edit admin-icon"></i> Edit</button> | ' .
                        '<button type="button" onclick="deleteFieldDef(' . $row->id . ')" class="text-red-600 hover:underline bg-transparent border-none cursor-pointer"><i class="fas fa-trash admin-icon"></i> Hapus</button>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return abort(404);
    }

    public function storeFieldDefinition(Request $request)
    {
        $request->validate([
            'nama_field' => 'required|string|max:100|unique:form_field_definitions,nama_field',
            'tipe' => 'required|in:' . implode(',', FormFieldDefinition::TYPES),
            'label' => 'required|string|max:255',
            'required' => 'nullable|boolean',
            'options' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) use ($request) {
                    if (!$value || !in_array($request->tipe, ['select', 'radio', 'checkbox'])) {
                        return;
                    }
                    $trimmed = trim($value);
                    if ($trimmed === '') {
                        return;
                    }
                    if (json_decode($value, true) === null) {
                        $fail('Options harus berformat JSON yang valid (contoh: [{"value":"a","label":"A"}]). Gunakan tanda petik ganda.');
                    }
                },
            ],
            'placeholder' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        $data = $request->only(['nama_field', 'tipe', 'label', 'placeholder', 'sort_order']);
        $data['required'] = (bool) $request->input('required');
        $data['options'] = $this->parseOptionsFromRequest($request->input('options'));
        FormFieldDefinition::create($data);
        return response()->json(['success' => true, 'message' => 'Field definisi berhasil ditambah.']);
    }

    public function editFieldDefinition($id)
    {
        $field = FormFieldDefinition::findOrFail($id);
        return response()->json($field);
    }

    public function updateFieldDefinition(Request $request, $id)
    {
        $field = FormFieldDefinition::findOrFail($id);
        $request->validate([
            'nama_field' => 'required|string|max:100|unique:form_field_definitions,nama_field,' . $id,
            'tipe' => 'required|in:' . implode(',', FormFieldDefinition::TYPES),
            'label' => 'required|string|max:255',
            'required' => 'nullable|boolean',
            'options' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) use ($request) {
                    if (!$value || !in_array($request->tipe, ['select', 'radio', 'checkbox'])) {
                        return;
                    }
                    $trimmed = trim($value);
                    if ($trimmed === '') {
                        return;
                    }
                    if (json_decode($value, true) === null) {
                        $fail('Options harus berformat JSON yang valid (contoh: [{"value":"a","label":"A"}]). Gunakan tanda petik ganda.');
                    }
                },
            ],
            'placeholder' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        $data = $request->only(['nama_field', 'tipe', 'label', 'placeholder', 'sort_order']);
        $data['required'] = (bool) $request->input('required');
        $data['options'] = $this->parseOptionsFromRequest($request->input('options'));
        $field->update($data);
        return response()->json(['success' => true, 'message' => 'Field definisi berhasil diubah.']);
    }

    /**
     * Parse options from request (JSON string) to array for DB. Always returns array or null.
     */
    private function parseOptionsFromRequest($value)
    {
        if ($value === null || trim((string) $value) === '') {
            return null;
        }
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : null;
    }

    public function destroyFieldDefinition($id)
    {
        FormFieldDefinition::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Field definisi dihapus.']);
    }

    /** Config - DataTable */
    public function configs(Request $request)
    {
        if ($request->ajax()) {
            $data = FormV2Config::orderBy('link');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('field_list', function ($row) {
                    $names = $row->field_names ?? [];
                    return count($names) ? implode(', ', array_slice($names, 0, 5)) . (count($names) > 5 ? '...' : '') : '—';
                })
                ->addColumn('actions', function ($row) {
                    $url = url('form-v2/' . $row->link);
                    $rekapUrl = route('admin.form-v2.configs.rekap', $row->id);
                    return '<a href="' . $url . '" target="_blank" class="text-admin-primary hover:underline"><i class="fas fa-external-link-alt admin-icon"></i> Form</a> | ' .
                        '<a href="' . $rekapUrl . '" class="text-admin-primary hover:underline"><i class="fas fa-list admin-icon"></i> Rekap</a> | ' .
                        '<button type="button" data-edit-config="' . $row->id . '" class="text-admin-primary hover:underline bg-transparent border-none cursor-pointer"><i class="fas fa-edit admin-icon"></i> Edit</button> | ' .
                        '<button type="button" onclick="deleteConfig(' . $row->id . ')" class="text-red-600 hover:underline bg-transparent border-none cursor-pointer"><i class="fas fa-trash admin-icon"></i> Hapus</button>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return abort(404);
    }

    public function storeConfig(Request $request)
    {
        $request->validate([
            'link' => 'required|string|max:255|unique:form_v2_config,link',
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'field_names' => 'required|array',
            'field_names.*' => 'string|max:100',
            'is_active' => 'nullable|boolean',
            'signature_enabled' => 'nullable|boolean',
        ]);
        FormV2Config::create([
            'link' => $request->link,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'field_names' => $request->field_names,
            'is_active' => (bool) $request->input('is_active', true),
            'signature_enabled' => (bool) $request->input('signature_enabled', true),
        ]);
        return response()->json(['success' => true, 'message' => 'Konfigurasi form berhasil ditambah.']);
    }

    public function editConfig($id)
    {
        $config = FormV2Config::findOrFail($id);
        return response()->json($config);
    }

    public function updateConfig(Request $request, $id)
    {
        $config = FormV2Config::findOrFail($id);
        $request->validate([
            'link' => 'required|string|max:255|unique:form_v2_config,link,' . $id,
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'field_names' => 'required|array',
            'field_names.*' => 'string|max:100',
            'is_active' => 'nullable|boolean',
            'signature_enabled' => 'nullable|boolean',
        ]);
        $config->update([
            'link' => $request->link,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'field_names' => $request->field_names,
            'is_active' => (bool) $request->input('is_active', true),
            'signature_enabled' => (bool) $request->input('signature_enabled', true),
        ]);
        return response()->json(['success' => true, 'message' => 'Konfigurasi form berhasil diubah.']);
    }

    public function destroyConfig($id)
    {
        FormV2Config::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Konfigurasi dihapus.']);
    }

    public function getFieldDefinitionsList()
    {
        $list = FormFieldDefinition::orderBy('sort_order')->orderBy('nama_field')->get(['id', 'nama_field', 'label', 'tipe']);
        return response()->json($list);
    }

    /**
     * Rekap hasil submission per konfigurasi form (by judul/link).
     */
    public function rekap($id)
    {
        $config = FormV2Config::findOrFail($id);
        $submissions = FormV2Submission::where('link', $config->link)->orderByDesc('created_at')->get();
        $fieldNames = $config->field_names ?? [];
        $labels = FormFieldDefinition::whereIn('nama_field', $fieldNames)->get()->keyBy('nama_field');
        $tittle = 'Rekap - ' . $config->judul;
        $title = $tittle;
        return view('admin.form-v2.rekap', compact('config', 'submissions', 'fieldNames', 'labels', 'tittle', 'title'));
    }

    /**
     * Export rekap ke PDF (termasuk gambar TTD jika ada).
     */
    public function rekapPdf($id)
    {
        $config = FormV2Config::findOrFail($id);
        $submissions = FormV2Submission::where('link', $config->link)->orderByDesc('created_at')->get();
        $fieldNames = $config->field_names ?? [];
        $labels = FormFieldDefinition::whereIn('nama_field', $fieldNames)->get()->keyBy('nama_field');

        $rows = $submissions->map(function ($sub, $index) use ($fieldNames, $labels) {
            $payload = $sub->payload ?? [];
            $cells = [];
            foreach ($fieldNames as $name) {
                $val = $payload[$name] ?? null;
                if (is_array($val)) {
                    $val = implode(', ', $val);
                }
                $cells[$name] = $val === null || $val === '' ? '—' : (string) $val;
            }
            $signatureBase64 = null;
            if (!empty($sub->signature_path)) {
                $path = Storage::disk('public')->path($sub->signature_path);
                if (is_file($path)) {
                    $signatureBase64 = base64_encode(file_get_contents($path));
                }
            }
            return (object) [
                'no' => $index + 1,
                'cells' => $cells,
                'tanggal' => $sub->tanggal ?? ($sub->created_at ? $sub->created_at->format('d-m-Y H:i') : '—'),
                'signature_base64' => $signatureBase64,
            ];
        });

        $pdf = Pdf::loadView('admin.form-v2.rekap_pdf', [
            'config' => $config,
            'fieldNames' => $fieldNames,
            'labels' => $labels,
            'rows' => $rows,
        ])->setPaper('a4', 'landscape');

        $filename = 'rekap_form_v2_' . \Illuminate\Support\Str::slug($config->judul) . '_' . date('Y-m-d') . '.pdf';
        return $pdf->download($filename);
    }
}
