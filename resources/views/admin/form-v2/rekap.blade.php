@extends('ad_layout.wrapper')

@php use Illuminate\Support\Facades\Storage; @endphp
@section('admin-container')
    <div class="mb-8">
        <h1 class="text-4xl font-ubuntu font-bold text-admin-text-primary mb-2">Rekap Hasil - {{ $config->judul }}</h1>
        <nav class="flex items-center space-x-2 text-sm text-admin-text-secondary">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-admin-primary transition-colors">Dashboard</a>
            <span>/</span>
            <a href="{{ route('admin.form-v2.index') }}" class="hover:text-admin-primary transition-colors">Form V2</a>
            <span>/</span>
            <span class="text-admin-primary font-medium">Rekap</span>
        </nav>
    </div>

    <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
        <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6 flex flex-wrap items-center justify-between gap-4">
            <h2 class="text-xl font-semibold text-white">{{ $config->judul }}</h2>
            <a href="{{ route('admin.form-v2.configs.rekap.pdf', $config->id) }}" target="_blank" class="inline-flex items-center gap-2 bg-white text-admin-primary px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all font-medium">
                <i class="fas fa-file-pdf admin-icon"></i>
                <span>Export PDF</span>
            </a>
        </div>
        <div class="p-6 overflow-x-auto">
            <table class="min-w-full divide-y divide-admin-border">
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-800">No.</th>
                        @foreach($fieldNames as $name)
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-800">{{ optional($labels->get($name))->label ?? $name }}</th>
                        @endforeach
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-800">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-800">TTD</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($submissions as $index => $sub)
                        @php $payload = $sub->payload ?? []; @endphp
                        <tr class="border-b border-admin-border hover:bg-slate-50">
                            <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                            @foreach($fieldNames as $name)
                                @php
                                    $v = $payload[$name] ?? null;
                                    if (is_array($v)) $v = implode(', ', $v);
                                @endphp
                                <td class="px-4 py-3 text-sm">{{ $v !== null && $v !== '' ? $v : '—' }}</td>
                            @endforeach
                            <td class="px-4 py-3 text-sm">{{ $sub->tanggal ?? ($sub->created_at ? $sub->created_at->format('d-m-Y H:i') : '—') }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if(!empty($sub->signature_path))
                                    <img src="{{ Storage::disk('public')->url($sub->signature_path) }}" alt="TTD" class="max-h-12 object-contain" />
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($fieldNames) + 3 }}" class="px-4 py-8 text-center text-admin-text-secondary">Belum ada data submission.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
