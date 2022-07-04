<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Philcom</title>
    <link rel="icon" href="images/philcom_logo.png" type="image/ico" />
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->


    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="/home" class="site_title"> <img src="img/company_logo.png" width = '70%' height = '80%'></a>

                </div>


                <!-- sidebar menu -->
                @include('side_menu')
                <!-- /sidebar menu -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                @include('top_header')
            </div>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">

            <div class="page-title">
                <div class="title_left">
                    <h3>Troubleshooting Logs</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">

                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>


                            <a href="{{ action('TroubleController@create') }}"><input type="submit" name="btn_add" value="ADD NEW RECORD" class="btn btn-round btn-primary"></a>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @if(session()->get('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div><br />
                            @endif


                            <div class="table-responsive">
                                <table id="datatable-responsive" class="table table-striped jambo_table table-bordered bulk_action dt-responsive" cellspacing="0" width="100%">
                                    <thead>
                                    <tr class="headings">

                                        <!--  <th class="column-title">Id</th> -->
                                        <th class="column-title">Department</th>
                                        <th class="column-title">Problem</th>
                                        <th class="column-title">Solution</th>
                                        <!--  <th class="column-title">History</th> -->
                                        <th class="column-title">RequestBy</th>
                                        <th class="column-title">AssistBy</th>
                                        <th class="column-title">CreatedAt</th>
                                        <th class="column-title">UpdateAt</th>
                                        <!--  <th class="column-title">TroubleImage</th> -->
                                        <th class="column-title">Actions</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($troubles as $trouble)
                                        @method('DELETE')
                                        @csrf

                                        <tr>
                                            <!--   <td>{{ $trouble->id }}</td> -->
                                            <td>{{ $trouble->department }}</td>
                                            <td>{{ $trouble->problem }}</td>
                                            <td>{{ $trouble->solution }}</td>
                                            <td>{{ $trouble->request_by }}</td>
                                            <td>{{ $trouble->assist_by }}</td>
                                            <td>{{ $trouble->created_at->diffForHumans() }}</td>
                                            <td>{{ $trouble->updated_at }}</td>

                                            <td>
                                                <a href="{{ action('TroubleController@edit', ['id'=>$trouble->id]) }}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                                                <a href="{{ action('TroubleController@edit', ['id'=>$trouble->id]) }}" class="btn btn-success"><i class="nav-icon fas fa-eye"></i></a>



                                                <!--  <a href="{{ action('TroubleController@destroy',$trouble->id)}}" class="col-md-7 mb-1 text-left btn btn-primary" style="text-align:center;">Delete</a> -->


                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>






                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="x_panel">
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul>
                <!--    <div class="x_title"> -->
                <div class="x_content">

                    <div class="form-group">
                        <!-- <div class="col-md-7 col-sm-4 col-xs-12 col-md-offset-0"> -->

                        <form action="{{ action('TroubleController@search') }}" method="GET">
                            <b>Trouble Details / Keywords:</b></br></br>

                            <input type="text" class="col-sm-2" name="search"></br></br>

                            <button type="submit" class=" btn btn-primary">Search</button>
                            <a href="https://ims.philcom.com/trouble"><button type="button" class="btn btn-primary">Cancel</button></a>
                        </form>
                        </br>
                    </div>


                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if(session()->get('success'))

                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div><br />
                    @endif


                    <div class="table-responsive">
                        <table id="datatable-responsive" class="table table-striped jambo_table table-bordered bulk_action dt-responsive " cellspacing="" width="100%">
                            <thead>
                            <tr class="headings">
                                <th>Problem</th>
                                <th>Solution</th>
                                <th>RequestBy</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($troubles as $trouble)

                                <tr>
                                    <td>{{ $trouble->problem }}</td>
                                    <td>{{ $trouble->solution }}</td>
                                    <td>{{ $trouble->request_by }}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>


                    <!-- start of x panel -->


                    <!-- end of x panel -->
                </div>
            </div>
        </div>





        <!-- jQuery -->

        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="vendors/nprogress/nprogress.js"></script>
        <!-- iCheck -->
        <script src="vendors/iCheck/icheck.min.js"></script>
        <!-- Datatables -->
        <?php require_once 'vendors/datatables.net/js/borrower.js';?>
        <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript">
            $('.modal-global').click(function(event) {
                event.preventDefault();

                var url = $(this).attr('href');

                $("#modal-global").modal('show');

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html',
                })
                    .done(function(response) {
                        $("#modal-global").find('.modal-body').html(response);
                    });

            });

            $('.modal-global2').click(function(event) {
                event.preventDefault();

                var url = $(this).attr('href');

                $("#modal-global2").modal('show');

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html',
                })
                    .done(function(response) {
                        $("#modal-global2").find('.modal-body2').html(response);
                    });

            });
        </script>

        <div class="modal fade" id="modal-global">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="fa fa-3x fa-refresh fa-spin"></i>
                            <div>Please wait...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-global2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body2">
                        <div class="text-center">
                            <i class="fa fa-3x fa-refresh fa-spin"></i>
                            <div>Please wait...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
        <script src="vendors/jszip/dist/jszip.min.js"></script>
        <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="build/js/custom.min.js"></script>

</body>
</html>
