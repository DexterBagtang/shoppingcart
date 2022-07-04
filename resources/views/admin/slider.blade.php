@extends('admin_layout.admin')

@section('link')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection

@section('content')
    {{Form::hidden('',$increment = 1)}}

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sliders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Sliders</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Sliders</h3>
                            </div>
                            @if(Session::has('status'))
                                <div class="alert alert-success">
                                    {{Session::get('status')}}
                                </div>
                            @endif
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Num.</th>
                                        <th>Picture</th>
                                        <th>Description one</th>
                                        <th>Description Two</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($slider as $sliders)
                                        <tr>
                                            <td>{{$increment}}</td>
                                            <td>
                                                <img src="{{asset('storage/slider_images/'.$sliders->sliderimage)}}" style="height: 50px; width: 50px;" class="img-circle elevation-2" alt="User Image">

                                            </td>
                                            <td>{{$sliders->description1}}</td>
                                            <td>{{$sliders->description2}}</td>

                                            <td>
                                                @if($sliders->status == 1)
                                                    <a href="{{url('/deactivateslider/'.$sliders->id)}}" class="btn btn-warning">Unactivate</a>
                                                @else
                                                    <a href="{{url('/activateslider/'.$sliders->id)}}" class="btn btn-success">Activate</a>
                                                @endif

                                                <a href="{{url('/editslider/'.$sliders->id)}}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                                                <a href="{{url('/destroyslider/'.$sliders->id)}}" id="delete" class="btn btn-danger" ><i class="nav-icon fas fa-trash"></i></a>
                                            </td>


                                        </tr>

                                        {{Form::hidden('',$increment = $increment + 1)}}

                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Num.</th>
                                        <th>Picture</th>
                                        <th>Description one</th>
                                        <th>Description Two</th>
                                        <th>Actions</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('backend/dist/js/bootbox.min.js')}}"></script>

    <script>
        $(document).on("click", "#delete", function(e){
            e.preventDefault();
            var link = $(this).attr("href");
            bootbox.confirm("Do you really want to delete this element ?", function(confirmed){
                if (confirmed){
                    window.location.href = link;
                };
            });
        });
    </script>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
