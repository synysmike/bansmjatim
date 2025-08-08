<div style="page-break-after: always;">
    {{-- Include Header --}}
    @include('daftarhadir.export_head')

    {{-- Body Content --}}
    <h2 style="text-align:center;">Rekap {{ $tittle }}</h2>
    <table class="table-bordered ">
        <thead>
            <tr class="bg-gray-100">
                @foreach ($theads as $thead)
                    <th class="head-isi ">
                        {{ $thead }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody style="text-align: center; font-size: 12px;">
            {!! $tbl !!}
        </tbody>
    </table>


    {{-- Signature or Additional Block --}}
    {{-- <p>Demikian pernyataan ini saya buat dengan sebenarnya.</p> --}}
    {{-- ...signature table... --}}

    {{-- Include Footer --}}
    @include('daftarhadir.export_foot')
</div>
