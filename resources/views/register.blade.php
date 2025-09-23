<!DOCTYPE html>
<html lang="en">


<!-- auth-register.html  21 Nov 2019 04:05:01 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ url('admin/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/assets/bundles/jquery-selectric/selectric.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ url('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('admin/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ url('admin/assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ url('admin/assets/img/favicon.ico') }}" />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-2 col-xl-6 offset-xl-2">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('registerSave') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="">Name</label>
                                            <input type="text" class="form-control" name="name" autofocus>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control" name="email">

                                        </div>
                                        <div class="form-group col-6">
                                            <label for="" class="d-block">Password</label>
                                            <input type="number" class="form-control" name="password">

                                        </div>
                                        <div class="form-group col-6">
                                            <label for="" class="d-block">Password Confirmation</label>
                                            <input type="number" class="form-control" name="password_confirmation">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="">select role</option>
                                                <option value="admin">Admin</option>
                                                <option value="editor">Editor</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="" class="d-block">Image</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Register
                                        </button>
                                    </div>

                                </form>
                            </div>
                            <div class="mb-4 text-muted text-center">
                                Already Registered? <a href="{{ route('login') }}">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ url('admin/assets/js/app.min.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ url('admin/assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ url('admin/assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ url('admin/assets/js/page/auth-register.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ url('admin/assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ url('admin/assets/js/custom.js') }}"></script>
</body>


<!-- auth-register.html  21 Nov 2019 04:05:02 GMT -->

</html>
