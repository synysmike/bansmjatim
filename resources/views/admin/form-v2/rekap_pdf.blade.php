<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Form - {{ $config->judul }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 9px; margin: 12px; }
        h1 { font-size: 14px; text-align: center; margin-bottom: 4px; }
        .meta { text-align: center; color: #555; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 6px; }
        th, td { border: 1px solid #333; padding: 4px 6px; text-align: left; }
        th { background-color: #e2e8f0; font-weight: bold; }
        tr:nth-child(even) { background-color: #f8fafc; }
        .no { width: 5%; text-align: center; }
        .ttd-cell { width: 12%; text-align: center; }
        .ttd-cell img { max-width: 80px; max-height: 45px; object-fit: contain; }
    </style>
</head>
<body>
    <h1>Rekap Hasil - {{ $config->judul }}</h1>
    <p class="meta">Export: {{ date('d-m-Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th class="no">No.</th>
                @foreach($fieldNames as $name)
                    <th>{{ optional($labels->get($name))->label ?? $name }}</th>
                @endforeach
                <th>Tanggal</th>
                <th class="ttd-cell">TTD</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $row)
            <tr>
                <td class="no">{{ $row->no }}</td>
                @foreach($fieldNames as $name)
                    <td>{{ $row->cells[$name] ?? '—' }}</td>
                @endforeach
                <td>{{ $row->tanggal }}</td>
                <td class="ttd-cell">
                    @if($row->signature_base64)
                        <img src="data:image/png;base64,{{ $row->signature_base64 }}" alt="TTD" />
                    @else
                        —
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="{{ count($fieldNames) + 3 }}" style="text-align: center;">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
