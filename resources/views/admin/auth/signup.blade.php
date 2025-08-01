<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sign Up</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="{{asset('ntpc-gel/images/NTPC-Green-Logo.png')}}">

  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css"> -->
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="public/plugins/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <style>
    @media(max-width: 1300px){
      .formbg 
      {
      background-image: url(public/images/cms.jpg) !important;
      background-repeat: no-repeat;
      background-size: cover;
      height: auto !important;
      }

      .cntnt{
        padding-top: 18px !important;
      }
    }

    @media(max-width: 1600px)
    {
      .formbg 
      {
        background-image: url(public/images/cms.jpg) !important;
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        height: 500px;
      }

      .cntnt
      {
        padding-top: 30px ;
        padding-bottom:10px;
      }
    }
    .content-wrapper 
    {
      min-height: 550px !important;
    }

    div#captcha 
    {
      margin-bottom: 10px;
    }
    .form-group 
    {
      margin-bottom: 10px;
    }

    label:not(.form-check-label):not(.custom-file-label) 
    {
      font-weight: 700;
      font-size: 14px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="container-fluid">
      <div class="row">
        <div style="padding:5px 0;background: #009a3d;" class="col-sm-12">
        </div>
      </div>
    </div>
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: 0px; background: none;min-height: auto !important;">
      <!-- Content Header (Page header) -->
      <section class="content-header" style="padding: 8px .5rem; background: #ffffff8c;">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <center><img src="{{asset('ntpc-gel/images/NTPC-Green-Logo.png')}}" style="width: 200px;"></center>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>   
        </div>
        <br>
      @endif
      @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>   
        </div>
        <br>
      @endif
      <!-- Main content -->
    <section class="content formbg">
      <div class="container">
        <div class="row cntnt">
          <!-- left column -->
          <div class="col-md-5" style="opacity: 0.95;border-radius: 5px;background: #ffffff33;">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header" style="background-color: #007bff;">
                  <h3 class="card-title">User Registration</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             <form action="{{route('registration')}}" method="post" enctype="multipart/form-data"> 
              @csrf
                <div class="card-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input autocomplete="off" class="form-control" data-val="true"data-val-length-max="20" id="email" name="email" placeholder="Enter Email Here" type="email" value="" />
                      <span class="field-validation-valid text-danger" data-valmsg-for="email" data-valmsg-replace="true"></span>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input autocomplete="off" class="form-control" data-val="true" data-val-required="Password is Required!!" id="password" name="password" placeholder="password" type="password" />
                      <span class="field-validation-valid text-danger" data-valmsg-for="password" data-valmsg-replace="true"></span>
                  </div>
                  <div class="row">
                      <div style="margin-bottom: 15px;" class="col-md-12">
                          <center>
                              <button type="submit" class="btn btn-success btn-sm">Signup</button>
                          </center>
                      </div>
                  </div>
                </div>
              </form>             
            </div>
            <!-- /.card -->
          </div>

          <div class="col-md-7">
            <div style="padding: 8px .5rem; background: #ffffff4d;height: 260px;width: 100%;margin-top: 16%; margin-left: 45px;">
              <h3 style="font-family: verdana;text-align: center;font-size: 68px;font-weight: 600;letter-spacing: 2px;color: #1b3783;text-shadow: 2px 2px 8px #1e7e34;-webkit-text-stroke: 1px #fdfdfd;">NTPC <br>Green</h3>
              <!-- <p style="font-family: verdana;text-align: center;font-weight: 600;color: #303030;font-size: 26px;-webkit-text-stroke: 0.2px #e7e7e7;">(Branch Wise Report)</p> -->
            </div>
          </div>
            <!--/.col (left) -->
            <!-- right column -->
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <div class="container-fluid">
      <div class="row">
        <div style="padding: 0;" class="col-sm-12">
          <p class="formfooter">Copyright © 2023 all rights reserved by NTPC</p>
        </div>
      </div>
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
<!-- ./wrapper -->

<!-- jQuery -->
<!-- <script src="public/plugins/jquery/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<!-- <script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- bs-custom-file-input -->
<!-- <script src="public/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script> -->
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
</body>
</html>
