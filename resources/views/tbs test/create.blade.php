<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Inventory </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="/home" class="site_title"> <img src="../img/company_logo.png" width = '70%' height = '80%'></a>

                </div>
                <br />
                <!-- sidebar menu -->

                @include('side_menu')

                <!-- /sidebar menu -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            @include('top_header')
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Add TroubleLogs</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <div class="container">
                                <div class="card upper">

                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div><br/>
                                        @endif



                                        <form method="POST" action="{{url('trouble/save')}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                            {{ csrf_field() }}


                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="multiple_user">Trouble with:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select name='' class="form-control" >
                                                        <option value="1" >Hardware</option>
                                                        <option value="2" >Software</option>
                                                    </select>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Department:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" name="department" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Problem:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <textarea type="text" class="form-control" name="problem" required></textarea>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Solution:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <textarea type="text" class="form-control" name="solution" required></textarea>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Request By:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" name="request_by" required/>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Assist By:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" name="assist_by" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Upload Screenshot:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="file" class="form-control" name="trouble_image" multiple>
                                                    <input type="file" name="trouble_image2" class="form-control" multiple>
                                                    <input type="file" name="trouble_image3" class="form-control" multiple>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <button class="btn btn-success" type="submit">Submit</button>
                                                    <button onclick="window.location.href='/trouble'" class="btn btn-primary ">Cancel</button>
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

    </div>
</div>

<script type="text/javascript">
    document.getElementById('service').style.display = 'none';
    document.getElementById('pc_module').style.display = 'none';
    document.getElementById('mac_module').style.display = 'none';

    function yesnoCheck() {
        if (document.getElementById('component_type').value == '1') {
            document.getElementById('service').style.display = 'block';
            document.getElementById('pc_module').style.display = 'block';
            document.getElementById('mac_module').style.display = 'none';
        }
        else if(document.getElementById('component_type').value == '2') {
            document.getElementById('service').style.display = 'none';
            document.getElementById('pc_module').style.display = 'block';
            document.getElementById('mac_module').style.display = 'block';
        }
        else {
            document.getElementById('service').style.display = 'none';
            document.getElementById('pc_module').style.display = 'none';
            document.getElementById('mac_module').style.display = 'none';
        }

    }

</script>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DateJS -->
<script src="../vendors/DateJS/build/date.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>

