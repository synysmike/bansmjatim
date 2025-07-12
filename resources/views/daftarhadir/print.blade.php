@foreach ($data as $row)
    <div style="page-break-after: always;">
        {{-- Include Header --}}
        @include('daftarhadir.print_head')

        {{-- Body Content --}}
        <h2 style="text-align:center;">BIODATA NARASUMBER</h2>
        <table>
            <tr>
                <td width="30%">Nama</td>
                <td width="3%">:</td>
                <td>{{ $row->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>:</td>
                <td>{{ $row->nip ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tempat/Tgl Lahir</td>
                <td>:</td>
                <td>{{ $row->tgl_lahir ?? '-' }}</td>
            </tr>
            <tr>
                <td>Pangkat/Golongan</td>
                <td>:</td>
                <td>{{ $row->pangkat ?? '-' }}</td>
            </tr>
            <tr>
                <td>Unit Kerja</td>
                <td>:</td>
                <td>{{ $row->unit ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $row->jabatan ?? '-' }}</td>
            </tr>
            <tr>
                <td>Unsur</td>
                <td>:</td>
                <td>{{ $row->unsur ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat Kantor</td>
                <td>:</td>
                <td>{{ $row->alamat_kantor ?? '-' }}</td>
            </tr>
            {{-- <tr><td>Nama Bank</td><td>:</td><td>{{ $row->bank ?? '-' }}</td></tr> --}}
            <tr>
                <td>Nomor Rekening (BRI)</td>
                <td>:</td>
                <td>{{ $row->norek ?? '-' }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $row->nik ?? '-' }}</td>
            </tr>
            <tr>
                <td>NPWP</td>
                <td>:</td>
                <td>{{ $row->npwp ?? '-' }}</td>
            </tr>
        </table>

        {{-- Signature or Additional Block --}}
        <p>Demikian pernyataan ini saya buat dengan sebenarnya.</p>
        {{-- ...signature table... --}}
        <table>
            <tr>
                <td width="40%"></td>
                <td style="padding-left:7em">
                    <p>Surabaya, {{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('d F Y') }}</p>
                    <p>Yang menyatakan,</p>
                    @if (!empty($row->ttd) && file_exists(public_path($row->ttd)))
                        <img src="{{ public_path($row->ttd) }}" alt="QR Signature" width="100">
                    @else
                        <span style="font-size:12px; color:#888;">No signature available</span>
                    @endif

                    <p style="font-weight:bold;">{{ $row->nama ?? '-' }}</p>
                </td>
            </tr>
        </table>
        {{-- Include Footer --}}
        @include('daftarhadir.print_foot', ['record_id' => $row->id])
    </div>
@endforeach
