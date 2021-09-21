<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from slidesigma.com/themes/html/costic/pages/prebuilt-pages/default-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 01 Feb 2020 13:14:06 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Costic Dashboard</title>
    <!-- Iconic Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../vendors/iconic-fonts/flat-icons/flaticon.css">
    <link href="../../vendors/iconic-fonts/font-awesome/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery UI -->
    <link href="../../assets/css/jquery-ui.min.css" rel="stylesheet">
    <!-- Costic styles -->
    <link href="../../assets/css/style.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="../../favicon.ico">
</head>
<body>

<main class="body-content">
    <div class="ms-content-wrapper ms-auth">
        <div class="ms-auth-container">

            <div class="ms-auth-col">
                <div class="ms-auth-form">

                    <div class="row h-100 justify-content-center align-items-center">
                        @error('mes')
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">SUCCESS!</h4>
                            <p>
                                {{$message}}
                            </p>
                            <hr/>
                            {{--            <p class="mb-0">--}}
                            {{--                <button type="button" class="btn btn-primary border-0">--}}
                            {{--                    Home Page--}}
                            {{--                </button>--}}
                            {{--            </p>--}}
                        </div>
                        @enderror

                        {{--        @if(Session::has('ok'))--}}
                        {{--        <div class="alert alert-success" role="alert">--}}
                        {{--            <h4 class="alert-heading">Notification!</h4>--}}
                        {{--            <p>--}}
                        {{--                {{Session::get('ok')}}--}}
                        {{--            </p>--}}
                        {{--            <hr/>--}}
                        {{--            <p class="mb-0">--}}
                        {{--                <a href="{{route('home')}}" type="button" class="btn btn-primary border-0">--}}
                        {{--                    Home Page--}}
                        {{--                </a>--}}
                        {{--            </p>--}}
                        {{--        </div>--}}
                        {{--        @endif--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- SCRIPTS -->
<!-- Global Required Scripts Start -->
<script src="../../assets/js/jquery-3.3.1.min.js"></script>
<script src="../../assets/js/popper.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/perfect-scrollbar.js">
</script>
<script src="../../assets/js/jquery-ui.min.js">
</script>
<!-- Global Required Scripts End -->
<!-- Costic core JavaScript -->
<script src="../../assets/js/framework.js"></script>
<!-- Settings -->
<script src="../../assets/js/settings.js"></script>
</body>
</html>
