<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from slidesigma.com/themes/html/costic/pages/prebuilt-pages/default-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 01 Feb 2020 13:14:06 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Food Delivery</title>
    <!-- Iconic Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendors/iconic-fonts/flat-icons/flaticon.css')}}">
    <link href="{{asset('vendors/iconic-fonts/font-awesome/css/all.min.css')}}" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- jQuery UI -->
    <link href="{{asset('assets/css/jquery-ui.min.css')}}" rel="stylesheet">
    <!-- Costic styles -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <!-- Favicon -->
{{--    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}../../favicon.ico">--}}
</head>

<body class="ms-body ms-primary-theme ms-logged-out">

<!-- Preloader -->
<div id="preloader-wrap">
    <div class="spinner spinner-8">
        <div class="ms-circle1 ms-child"></div>
        <div class="ms-circle2 ms-child"></div>
        <div class="ms-circle3 ms-child"></div>
        <div class="ms-circle4 ms-child"></div>
        <div class="ms-circle5 ms-child"></div>
        <div class="ms-circle6 ms-child"></div>
        <div class="ms-circle7 ms-child"></div>
        <div class="ms-circle8 ms-child"></div>
        <div class="ms-circle9 ms-child"></div>
        <div class="ms-circle10 ms-child"></div>
        <div class="ms-circle11 ms-child"></div>
        <div class="ms-circle12 ms-child"></div>
    </div>
</div>
<!-- Overlays -->
<div class="ms-aside-overlay ms-overlay-left ms-toggler" data-target="#ms-side-nav" data-toggle="slideLeft"></div>
<div class="ms-aside-overlay ms-overlay-right ms-toggler" data-target="#ms-recent-activity"
     data-toggle="slideRight"></div>
<!-- Sidebar Navigation Left -->
<!-- Main Content -->
<main class="body-content">
    <!-- Navigation Bar -->
    <!-- Body Content Wrapper -->
    <div class="ms-content-wrapper ms-auth">
        <div class="ms-auth-container">
            <div class="ms-auth-col">
                <div class="ms-auth-form">
                    <form class="needs-validation" novalidate="" method="POST" action="{{route('login')}}" style=" border: 0.5px solid lightgray;
    padding: 25px;">
                        @csrf
                        <h3>????ng nh????p</h3>
                        @error('mes')
                        <small class="form-text text-danger"><p style="color: red">{{ $message }}</p></small>
                        @enderror
                        <div class="mb-3">
                            <label for="validationCustom08">Email</label>
                            <div class="input-group">
                                <input type="email" name="email" class="form-control" id="validationCustom08"
                                       placeholder="Email" required="">
                                <div class="invalid-feedback">Vui lo??ng cung c????p Email.</div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="validationCustom09">M????t kh????u</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="validationCustom09"
                                       placeholder="M????t kh????u" required="">
                                <div class="invalid-feedback">Vui lo??ng cung c????p m????t kh????u.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="d-block mt-3"><a href="{{route('forgotpass')}}" class="btn-link"
                                >Qu??n m????t kh????u?</a>
                            </label>
                        </div>
                        <button class="btn btn-primary mt-4 d-block w-100" type="submit">????ng nh????p</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- SCRIPTS -->
<!-- Global Required Scripts Start -->
<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/perfect-scrollbar.js')}}">
</script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}">
</script>
<!-- Global Required Scripts End -->
<!-- Costic core JavaScript -->
<script src="{{asset('assets/js/framework.js')}}"></script>
<!-- Settings -->
<script src="{{asset('assets/js/settings.js')}}"></script>
</body>


<!-- Mirrored from slidesigma.com/themes/html/costic/pages/prebuilt-pages/default-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 01 Feb 2020 13:14:06 GMT -->
</html>
