<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Trouble Logs </title>

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
                            <h2>Details</h2>
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
                                        <div class="row">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div><br/>
                                        @endif

                                        <div class="col-sm-9">

                                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                                <!-- Indicators -->
                                                <ol class="carousel-indicators">
                                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                                </ol>

                                                <!-- Wrapper for slides -->
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="item active">
                                                        <img src="https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png" alt="NO UPLOADED IMAGE">
                                                        <div class="carousel-caption">
                                                            ...
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <img src="https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png" alt="NO UPLOADED IMAGE">
                                                        <div class="carousel-caption">
                                                            ...
                                                        </div>
                                                    </div>
                                                    ...
                                                </div>

                                                <!-- Controls -->
                                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        </div>

                                            @foreach($trouble as $troubles)

                                                <div class="col-sm-3" >
                                                    <h5 class="my-3 text-bold">Problem</h5>
                                                    <p>{{$troubles->problem}}</p>
                                                    <h5 class="my-3 text-bold">Solution</h5>
                                                    <p>{{$troubles->solution}}</p>

                                                    <h6 class="my-3  text-bold text-right">Requested by: {{$troubles->request_by}}</h6>
                                                    <h6 class="my-3  text-bold text-right">Assisted by: {{$troubles->assist_by}}</h6>
                                                    <h6 class="my-3  text-bold text-right">Date Created: {{$troubles->created_at->diffForHumans()}}</h6>

                                                    @if($troubles->updated_at != null)
                                                        <h6 class="my-3 text-bold text-right">Date Completed: {{$troubles->updated_at->diffForHumans()}}</h6>
                                                    @endif

                                                    @if($troubles->updated_at != null)

                                                        <h6 class="my-3 btn btn-block btn-success text-bold text-center">Completed !</h6>
                                                    @else
                                                        <h6 class="my-3 btn btn-block btn-danger text-bold text-center">Pending !</h6>
                                                    @endif
                                                </div>
                                            @endforeach

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
