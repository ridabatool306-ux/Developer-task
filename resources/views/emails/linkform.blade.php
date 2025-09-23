<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Otika - Admin Dashboard Template</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{url('admin/assets/css/app.min.css')}}">
  <link rel="stylesheet" href="{{url('admin/assets/bundles/bootstrap-social/bootstrap-social.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{url('admin/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{url('admin/assets/css/components.css')}}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{url('admin/assets/css/custom.css')}}">
  <link rel='shortcut icon' type='image/x-icon' href="{{url('admin/assets/img/favicon.ico')}}" />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Reset Password</h4>
              </div>
              <div class="card-body">
                <form method="POST" class="needs-validation" action="{{route('resetpassword')}}">
                  @csrf
                  <input type="hidden" name="token" value="{{$token}}">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email"> 
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password"  class="control-label">Password</label>
                    </div>
                    <input  type="number" class="form-control" name="password">
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password"  class="control-label">Confirm Password</label>
                    </div>
                    <input  type="password" class="form-control" name="password_confirmation">
                  </div>
                  <div class="form-group mt-2">
                   <input type="submit" name="Reset" value="Reset"  class="btn btn-primary">
                  </div>
                </form>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="{{url('admin/assets/js/app.min.js')}}"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="{{url('admin/assets/js/scripts.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{url('admin/assets/js/custom.js')}}"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>