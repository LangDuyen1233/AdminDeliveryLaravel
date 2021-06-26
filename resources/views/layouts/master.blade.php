<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from slidesigma.com/themes/html/costic/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 01 Feb 2020 13:03:18 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> @yield('title')</title>

    <!-- Iconic Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @yield('css')

    <link href="{{asset('vendors/iconic-fonts/font-awesome/css/all.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendors/iconic-fonts/flat-icons/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/iconic-fonts/cryptocoins/cryptocoins.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/iconic-fonts/cryptocoins/cryptocoins-colors.css')}}">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    {{--    <link rel="stylesheet prefetch" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">--}}
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- jQuery UI -->
    {{--    <link href="{{asset('assets/css/jquery-ui.min.css')}}" rel="stylesheet">--}}
<!-- Page Specific CSS (Slick Slider.css) -->
    {{--    <link href="{{asset('assets/css/slick.css')}}" rel="stylesheet">--}}
    <link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet">
    <!-- Costic styles -->

    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <link href="{{asset('assets/css/rating.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/datatb-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css//datatables.min.css')}}">
    <!-- Favicon -->
    {{--    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon.ico')}}">--}}
    {{--    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet">--}}
</head>

<body class="ms-body ms-aside-left-open ms-primary-theme ms-has-quickbar">
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
@include("partial.slide_menu")
<!-- Sidebar Right -->
{{--<aside id="ms-recent-activity" class="side-nav fixed ms-aside-right ms-scrollable">--}}
{{--    <div class="ms-aside-header">--}}
{{--        <ul class="nav nav-tabs tabs-bordered d-flex nav-justified mb-3" role="tablist">--}}
{{--            <li role="presentation" class="fs-12"><a href="#activityLog" aria-controls="activityLog" class="active"--}}
{{--                                                     role="tab" data-toggle="tab"> Activity Log</a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <button type="button" class="close ms-toggler text-center" data-target="#ms-recent-activity"--}}
{{--                        data-toggle="slideRight"><span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--    <div class="ms-aside-body">--}}
{{--        <div class="tab-content">--}}
{{--            <div role="tabpanel" class="tab-pane active fade show" id="activityLog">--}}
{{--                <ul class="ms-activity-log">--}}
{{--                    <li>--}}
{{--                        <div class="ms-btn-icon btn-pill icon btn-light"><i class="flaticon-gear"></i>--}}
{{--                        </div>--}}
{{--                        <h6>Update 1.0.0 Pushed</h6>--}}
{{--                        <span> <i class="material-icons">event</i>1 January, 2019</span>--}}
{{--                        <p class="fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque--}}
{{--                            diam non nisi semper, ula in sodales vehicula....</p>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <div class="ms-btn-icon btn-pill icon btn-success"><i class="flaticon-tick-inside-circle"></i>--}}
{{--                        </div>--}}
{{--                        <h6>Profile Updated</h6>--}}
{{--                        <span> <i class="material-icons">event</i>4 March, 2018</span>--}}
{{--                        <p class="fs-14">Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam--}}
{{--                            pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <div class="ms-btn-icon btn-pill icon btn-warning"><i class="flaticon-alert-1"></i>--}}
{{--                        </div>--}}
{{--                        <h6>Your payment is due</h6>--}}
{{--                        <span> <i class="material-icons">event</i>1 January, 2019</span>--}}
{{--                        <p class="fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque--}}
{{--                            diam non nisi semper, ula in sodales vehicula....</p>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <div class="ms-btn-icon btn-pill icon btn-danger"><i class="flaticon-alert"></i>--}}
{{--                        </div>--}}
{{--                        <h6>Database Error</h6>--}}
{{--                        <span> <i class="material-icons">event</i>4 March, 2018</span>--}}
{{--                        <p class="fs-14">Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam--}}
{{--                            pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <div class="ms-btn-icon btn-pill icon btn-info"><i class="flaticon-information"></i>--}}
{{--                        </div>--}}
{{--                        <h6>Checkout what's Trending</h6>--}}
{{--                        <span> <i class="material-icons">event</i>1 January, 2019</span>--}}
{{--                        <p class="fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque--}}
{{--                            diam non nisi semper, ula in sodales vehicula....</p>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <div class="ms-btn-icon btn-pill icon btn-secondary"><i class="flaticon-diamond"></i>--}}
{{--                        </div>--}}
{{--                        <h6>Your Dashboard is ready</h6>--}}
{{--                        <span> <i class="material-icons">event</i>4 March, 2018</span>--}}
{{--                        <p class="fs-14">Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam--}}
{{--                            pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                <a href="#" class="btn btn-primary d-block"> View All </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</aside>/--}}
<!-- Main Content -->
<main class="body-content">
    <!-- Navigation Bar -->
    @include("partial.header")

    @yield('content')
</main>
<!-- MODALS -->
<!-- Quick bar -->
{{--//////--}}
<!-- Reminder Modal -->
<div class="modal fade" id="reminder-modal" tabindex="-1" role="dialog" aria-labelledby="reminder-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title has-icon text-white"> New Reminder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="ms-form-group">
                        <label>Remind me about</label>
                        <textarea class="form-control" name="reminder"></textarea>
                    </div>
                    <div class="ms-form-group"><span class="ms-option-name fs-14">Repeat Daily</span>
                        <label class="ms-switch float-right">
                            <input type="checkbox"> <span class="ms-switch-slider round"></span>
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="ms-form-group">
                                <input type="text" class="form-control datepicker" name="reminder-date" value=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="ms-form-group">
                                <select class="form-control" name="reminder-time">
                                    <option value="">12:00 pm</option>
                                    <option value="">1:00 pm</option>
                                    <option value="">2:00 pm</option>
                                    <option value="">3:00 pm</option>
                                    <option value="">4:00 pm</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-secondary shadow-none" data-dismiss="modal">Add Reminder
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Notes Modal -->
<div class="modal fade" id="notes-modal" tabindex="-1" role="dialog" aria-labelledby="notes-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title has-icon text-white" id="NoteModal">New Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="ms-form-group">
                        <label>Note Title</label>
                        <input type="text" class="form-control" name="note-title" value="">
                    </div>
                    <div class="ms-form-group">
                        <label>Note Description</label>
                        <textarea class="form-control" name="note-description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-secondary shadow-none" data-dismiss="modal">Add Note</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- SCRIPTS -->
<!-- Global Required Scripts Start -->
{{--<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>--}}

{{--<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>--}}
{{----}}
<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<!-- Global Required Scripts End -->
<!-- Page Specific Scripts Start -->
{{--<script src="{{asset('assets/js/Chart.bundle.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/js/widgets.js')}}"></script>--}}
{{--<script src="{{asset('assets/js/clients.js')}}"></script>--}}
{{--<script src="{{asset('assets/js/Chart.Financial.js')}}"></script>--}}
<script src="{{asset('assets/js/d3.v3.min.js')}}"></script>
<script src="{{asset('assets/js/topojson.v1.min.js')}}"></script>
{{--<script src="{{asset('assets/js/datatables.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/js/data-tables.js')}}"></script>--}}
<!-- Page Specific Scripts Finish -->
<!-- Costic core JavaScript -->
<script src="{{asset('assets/js/framework.js')}}"></script>
<!-- Settings -->
<script src="{{asset('assets/js/settings.js')}}"></script>
@yield('script')
{{--<script src="{{asset('assets/js/select2.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/js/fullcalendar.min.js')}}"></script>--}}
</body>


<!-- Mirrored from slidesigma.com/themes/html/costic/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 01 Feb 2020 13:05:48 GMT -->
</html>
