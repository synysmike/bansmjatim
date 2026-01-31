@extends('ad_layout.wrapper')
@push('css-custom')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
@endpush

@section('admin-container')
    <!-- Section Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-ubuntu font-bold text-admin-text-primary mb-2">{{ $tittle ?? 'Daftar Hadir' }}</h1>
        <nav class="flex items-center space-x-2 text-sm text-admin-text-secondary">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-admin-primary transition-colors">Dashboard</a>
            <span>/</span>
            <span class="text-admin-primary font-medium">{{ $tittle ?? 'Daftar Hadir' }}</span>
        </nav>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
        <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl font-semibold text-white">{{ $tittle ?? 'Daftar Hadir' }}</h2>
                <a href="{{ url('export-dh/' . ($link ?? '')) }}" target="_blank" class="inline-flex items-center space-x-2 bg-white text-admin-primary px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all font-medium">
                    <i class="fas fa-print admin-icon"></i>
                    <span>Cetak</span>
                </a>
            </div>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="table-1" class="min-w-full divide-y divide-admin-border">
                    <thead class="bg-gradient-to-r from-admin-primary to-admin-secondary">
                        <tr>
                            @foreach ($theads ?? [] as $tbh)
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">{{ $tbh }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-admin-border">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js-custom')
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            var label = @json($unit ?? []);
            var columns = [];
            $.each(label, function(key, value) {
                var col = {
                    name: value,
                    data: value,
                    orderable: (value === 'tand' || value === 'DT_RowIndex') ? false : true,
                    searchable: (value === 'tand' || value === 'DT_RowIndex') ? false : true
                };
                if (value === 'tand') {
                    col.render = function(data) { return data || '—'; };
                }
                columns.push(col);
            });

            $('#table-1').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ $link ?? "" }}',
                    type: 'GET'
                },
                columns: columns,
                order: [[0, 'asc']],
                pageLength: 10,
                lengthMenu: [[10, 50, 100, 200, -1], [10, 50, 100, 200, "All"]],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                    zeroRecords: "Tidak ada data yang cocok",
                    processing: "Memproses..."
                }
            });
        });
    </script>
@endpush
