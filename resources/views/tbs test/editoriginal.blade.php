<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Create Trouble Log</title>
</head>
<body>
<div class="conatainer">
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="shadow p-3">
                <h3 style="text-align:center;">Edit Trouble Log</h3>


                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <div class="container">
                    <div class="card uper">

                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif
                            @if(session()->get('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div><br />
                            @endif


                            @foreach($trouble as $troubles)

                                {{ csrf_field() }}

                                <form method="post" action="{{ route('trouble.update',$troubles->id)}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                    @method('PATCH')
                                    @csrf


                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="department">Department:</label>
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" name="department" value="{{$troubles->department}}" required/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="problem">Problem:</label>
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" name="problem" value="{{$troubles->problem}}" required/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="solution">Solution:</label>
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" name="solution" value="{{$troubles->solution}}" required/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="request_by">Request By:</label>
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" name="request_by" value="{{$troubles->request_by}}" required/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="assist_by">Assist By:</label>
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" name="assist_by" value="{{$troubles->assist_by}}" required/>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3" >
                                            <button onclick="window.location='https://ims.philcom.com/trouble', myFunction()"  type="submit" class="btn btn-success">Update</button>
                                            <!-- <button onclick="myFunction()"  type="submit" class="btn btn-success">Update</button> -->

                                            <a href="{{ action('TroubleController@index') }}"><button type="button" class="btn btn-primary">Cancel</button></a>
                                        </div>
                                    </div>
                                </form>



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

<script>
    function myFunction() {
        alert("Updating Log Successful!");

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

