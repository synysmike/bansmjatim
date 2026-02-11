<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Report Daftar Hadir - {{ $tittle }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; margin: 15px; }
        h1 { font-size: 14px; text-align: center; margin-bottom: 4px; }
        .meta { text-align: center; color: #555; margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background-color: #e2e8f0; font-weight: bold; }
        tr:nth-child(even) { background-color: #f8fafc; }
        .no { width: 8%; text-align: center; }
        .nama { width: 22%; }
        .tanggal { width: 15%; }
        .kegiatan { width: 25%; }
        .ttd-cell { width: 30%; text-align: center; }
        .ttd-cell img { max-width: 120px; max-height: 70px; object-fit: contain; }
    </style>
</head>
<body>
    <h1>Daftar Hadir - {{ $tittle }}</h1>
    <p class="meta">Tanggal kegiatan: {{ $tanggal }}</p>
    <p class="meta">Export: {{ date('d-m-Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th class="no">No.</th>
                <th class="nama">Nama</th>
                <th class="tanggal">Tanggal</th>
                <th class="kegiatan">Kegiatan</th>
                <th class="ttd-cell">TTD</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
            <tr>
                <td class="no">{{ $row->no }}</td>
                <td class="nama">{{ $row->nama }}</td>
                <td class="tanggal">{{ $row->tanggal }}</td>
                <td class="kegiatan">{{ $row->nama_judul }}</td>
                <td class="ttd-cell">
                    @if ($row->ttd_base64)
                        <img src="data:image/png;base64,{{ $row->ttd_base64 }}" alt="TTD" />
                    @else
                        —
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
