<?php

namespace App\Http\Controllers;

use App\Models\FormFieldDefinition;
use App\Models\FormV2Config;
use App\Models\FormV2Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class FormV2Controller extends Controller
{
    /**
     * Show public form by link (structured fields from form_field_definitions).
     */
    public function show(Request $request, string $link)
    {
        $config = FormV2Config::where('link', $link)->where('is_active', true)->first();
        if (!$config) {
            abort(404, 'Form tidak ditemukan atau tidak aktif.');
        }

        $fields = $config->getOrderedFieldDefinitions();
        $judul = $config->judul;
        $kategori = $config->kategori;

        if ($request->ajax()) {
            $data = FormV2Submission::where('link', $link)->orderByDesc('created_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('payload_preview', function ($row) {
                    $p = $row->payload ?? [];
                    $parts = [];
                    foreach (array_slice($p, 0, 4) as $k => $v) {
                        if (is_string($v) && strlen($v) <= 30) {
                            $parts[] = $v;
                        }
                    }
                    return implode(' · ', $parts) ?: '—';
                })
                ->addColumn('created', function ($row) {
                    return $row->created_at ? $row->created_at->format('d-m-Y H:i') : '—';
                })
                ->rawColumns([])
                ->make(true);
        }

        $today = Carbon::now('Asia/Jakarta')->format('d-m-Y');

        return view('form-v2.show', [
            'config' => $config,
            'fields' => $fields,
            'judul' => $judul,
            'kategori' => $kategori,
            'link' => $link,
            'tittle' => $judul,
            'title' => $judul,
            'today' => $today,
        ]);
    }

    /**
     * Store form submission (payload + optional TTD).
     */
    public function store(Request $request, string $link)
    {
        $config = FormV2Config::where('link', $link)->where('is_active', true)->first();
        if (!$config) {
            return response()->json(['message' => 'Form tidak ditemukan.'], 404);
        }

        $fieldNames = $config->field_names ?? [];
        $rules = [];
        $payload = [];
        $defs = FormFieldDefinition::whereIn('nama_field', $fieldNames)->get()->keyBy('nama_field');

        foreach ($fieldNames as $name) {
            $def = $defs->get($name);
            if (!$def) {
                continue;
            }
            if ($def->tipe === 'checkbox') {
                $rules[$name] = $def->required ? 'required|array' : 'nullable|array';
                $rules[$name . '.*'] = 'nullable|string|max:500';
            } else {
                $rules[$name] = $def->required ? 'required|string|max:1000' : 'nullable|string|max:1000';
            }
            if ($request->has($name)) {
                $payload[$name] = $request->input($name);
            }
        }

        $signatureRule = ($config->signature_enabled ?? true) ? 'required|string' : 'nullable|string';
        $request->validate(array_merge($rules, [
            'kat_dh' => 'nullable|string|max:255',
            'signature' => $signatureRule,
        ]));

        $mytime = Carbon::now('Asia/Jakarta');
        $signaturePath = null;

        if (($config->signature_enabled ?? true) && $request->filled('signature')) {
            $signature = $request->signature;
            $signature = str_replace('data:image/png;base64,', '', $signature);
            $signature = str_replace(' ', '+', $signature);
            $decoded = base64_decode($signature);
            if ($decoded !== false) {
                $filename = 'ttd_v2/' . uniqid() . '.png';
                Storage::disk('public')->put($filename, $decoded);
                $signaturePath = $filename;
            }
        }

        $submission = FormV2Submission::create([
            'link' => $link,
            'kategori' => $request->input('kat_dh', $config->kategori),
            'tanggal' => $mytime->format('d-m-Y'),
            'payload' => $payload,
            'signature_path' => $signaturePath,
        ]);

        return response()->json($submission);
    }
}
