@extends('ad_layout.wrapper')
@push('css-custom')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.3.1/css/buttons.dataTables.css">
    <link rel="stylesheet" href="/admin_theme/library/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.css">
@endpush
@section('admin-container')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            @foreach ($theads as $tbh)
                                                <th class="text-center">{{ $tbh }}</th>
                                            @endforeach
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
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="/admin_theme/library/jquery-ui-dist/jquery-ui.min.js"></script>
    <script src="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/admin_theme/library/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/admin_theme/library/summernote/dist/summernote-bs4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
    <!-- Page Specific JS File -->
    {{-- <script src="admin_theme/js/page/bootstrap-modal.js"></script> --}}
    <script>
        $(document).ready(function() {

            var label = [];
            '@foreach ($unit as $unt)';
            label.push('{!! $unt !!}');
            '@endforeach';
            // console.log(label);
            var columns = [];
            $.each(label, function(key, value) {
                var my_item = {};
                my_item.name = value;
                my_item.data = value;
                columns.push(my_item);
            });
            //datatable yajra
            var dt = $('#table-1').dataTable({
                layout: {
                    topStart: {
                        buttons: [{
                            text: 'My button',
                            action: function(e, dt, node, config) {
                                alert('Button activated');
                            }
                        }]
                    }
                },
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: '{{ $link }}', // ambil data
                    type: 'GET'
                },
                layout: {
                    topStart: {
                        buttons: [{
                            text: 'My button',
                            className: 'red',
                            action: function(e, dt, node, config) {
                                alert('Button activated');
                            }
                        }]
                    }
                },

                columns: columns,
                aLengthMenu: [
                    [10, 50, 100, 200, -1],
                    [10, 50, 100, 200, "All"]
                ],
                iDisplayLength: -1,

            });


        });
    </script>
@endpush
