@extends('ad_layout.wrapper')
@push('css-custom')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
@endpush

@section('admin-container')
    <section>
        <div class="section-header">
            <h1>{{ $tittle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Home</a></div>
                <div class="breadcrumb-item">{{ $tittle }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h4>Home Page Contents</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.home.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add New Content
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="contents-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Section Key</th>
                                            <th>Section Name</th>
                                            <th>Content Preview</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Sort Order</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js-custom')
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#contents-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.home.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'section_key', name: 'section_key'},
                    {data: 'section_name', name: 'section_name'},
                    {data: 'content', name: 'content', 
                        render: function(data) {
                            if (data && data.length > 50) {
                                return data.substring(0, 50) + '...';
                            }
                            return data || '-';
                        }
                    },
                    {data: 'image_preview', name: 'image_preview', orderable: false, searchable: false},
                    {data: 'status', name: 'status'},
                    {data: 'sort_order', name: 'sort_order'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ]
            });
        });

        function deleteContent(id) {
            if (confirm('Are you sure you want to delete this content?')) {
                $.ajax({
                    url: "{{ url('admin/home') }}/" + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#contents-table').DataTable().ajax.reload();
                            alert('Content deleted successfully.');
                        }
                    },
                    error: function() {
                        alert('Error deleting content.');
                    }
                });
            }
        }
    </script>
@endpush
