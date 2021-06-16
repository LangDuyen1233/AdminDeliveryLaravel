@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">

        <div class="ms-profile-overview">
            <div class="ms-profile-cover">
                <img class="ms-profile-img" src="../../assets/img/costic/customer-5.jpg" alt="people">
                <div class="ms-profile-user-info">
                    <h4 class="ms-profile-username text-white">Chihoo Hwang</h4>
                    <h2 class="ms-profile-role">Professional Cheff</h2>
                </div>
                <div class="ms-profile-user-buttons">
                    <a href="#" class="btn btn-primary"> <i class="material-icons">person_add</i> Follow</a>
                    <a href="#" class="btn btn-light"> <i class="material-icons">file_download</i> Download Resume</a>
                </div>
            </div>
            <ul class="ms-profile-navigation nav nav-tabs tabs-bordered" role="tablist">
                <li role="presentation"><a href="#tab1" aria-controls="tab1" class="active show" role="tab"
                                           data-toggle="tab"> Overview </a></li>
                <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"> Professional
                        Skills </a></li>
                <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">
                        Portfolio </a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="tab1">

                </div>
                <div class="tab-pane" id="tab2">

                </div>
                <div class="tab-pane" id="tab3">

                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xl-7 col-md-12">
                <div class="ms-panel ms-panel-fh">
                    <div class="ms-panel-body">
                        <h2 class="section-title">About Me</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non elit nisl. Class aptent
                            taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                            Aenean luctus, justo id pellentesque imperdiet, augue metus ornare quam, in pulvinar massa
                            erat nec dui. Nam at facilisis nulla.
                        </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non elit nisl. Class aptent
                            taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                            Aenean luctus, justo id pellentesque imperdiet, augue metus ornare quam, in pulvinar massa
                            erat nec dui. Nam at facilisis nulla.
                        </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non elit nisl. Class aptent
                            taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                            Aenean luctus, justo id pellentesque imperdiet, augue metus ornare quam, in pulvinar massa
                            erat nec dui. Nam at facilisis nulla.
                        </p>

                        <div class="ms-profile-skills">
                            <h2 class="section-title">Professional Skills</h2>
                            <ul class="ms-skill-list">
                                <li class="ms-skill">Web Design</li>
                                <li class="ms-skill">Development</li>
                                <li class="ms-skill">Interface Design</li>
                                <li class="ms-skill">Illustration</li>
                                <li class="ms-skill">Brand Design</li>
                                <li class="ms-skill">Adobe</li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-xl-5 col-md-12">
                <div class="ms-panel ms-panel-fh">
                    <div class="ms-panel-body">
                        <ul class="ms-profile-stats">
                            <li>
                                <h3 class="ms-count">5790</h3>
                                <span>Followers</span>
                            </li>
                            <li>
                                <h3 class="ms-count">4.8</h3>
                                <span>User Rating</span>
                            </li>
                        </ul>
                        <h2 class="section-title">Basic Information</h2>
                        <table class="table ms-profile-information">
                            <tbody>
                            <tr>
                                <th scope="row">Full Name</th>
                                <td>Chihoo Hwang</td>
                            </tr>
                            <tr>
                                <th scope="row">Birthday</th>
                                <td>January 25th, 1996</td>
                            </tr>
                            <tr>
                                <th scope="row">Language</th>
                                <td>English (US)</td>
                            </tr>
                            <tr>
                                <th scope="row">Website</th>
                                <td>www.example.com</td>
                            </tr>
                            <tr>
                                <th scope="row">Phone Number</th>
                                <td>+123 456 789</td>
                            </tr>
                            <tr>
                                <th scope="row">Email Address</th>
                                <td>example@mail.com</td>
                            </tr>
                            <tr>
                                <th scope="row">Location</th>
                                <td>New York, USA</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-body">
                        <h2 class="section-title">Cheffs on Dutty</h2>
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                <div class="media ms-profile-experience">
                                    <div class="mr-2 align-self-center">
                                        <img src="../../assets/img/costic/customer-1.jpg"
                                             class="ms-img-round ms-img-small" alt="people">
                                    </div>
                                    <div class="media-body">
                                        <h4>Mike Labinstine</h4>
                                        <p>January 2019 to Present</p>
                                        <p>Veg Cook</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                <div class="media ms-profile-experience">
                                    <div class="mr-2 align-self-center">
                                        <img src="../../assets/img/costic/customer-2.jpg"
                                             class="ms-img-round ms-img-small" alt="people">
                                    </div>
                                    <div class="media-body">
                                        <h4>George Labinstin</h4>
                                        <p>January 2013 to Present</p>
                                        <p>Meat Cook</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                <div class="media ms-profile-experience">
                                    <div class="mr-2 align-self-center">
                                        <img src="../../assets/img/costic/customer-3.jpg"
                                             class="ms-img-round ms-img-small" alt="people">
                                    </div>
                                    <div class="media-body">
                                        <h4>Jessy Doe</h4>
                                        <p>January 2019 to Present</p>
                                        <p>Top Cheff</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                <div class="media ms-profile-experience">
                                    <div class="mr-2 align-self-center">
                                        <img src="../../assets/img/costic/customer-4.jpg"
                                             class="ms-img-round ms-img-small" alt="people">
                                    </div>
                                    <div class="media-body">
                                        <h4>Jessica Doe</h4>
                                        <p>January 2013 to Present</p>
                                        <p>Night Cheff</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                <div class="media ms-profile-experience">
                                    <div class="mr-2 align-self-center">
                                        <img src="../../assets/img/costic/customer-5.jpg"
                                             class="ms-img-round ms-img-small" alt="people">
                                    </div>
                                    <div class="media-body">
                                        <h4>Jhone Doe</h4>
                                        <p>January 2019 to Present</p>
                                        <p>The Cheff</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                <div class="media ms-profile-experience">
                                    <div class="mr-2 align-self-center">
                                        <img src="../../assets/img/costic/customer-6.jpg"
                                             class="ms-img-round ms-img-small" alt="people">
                                    </div>
                                    <div class="media-body">
                                        <h4>Manti Jhoe</h4>
                                        <p>January 2019 to Present</p>
                                        <p>Quality Control</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-12">
                <div class="ms-panel ms-panel-fh">
                    <div class="ms-panel-body">
                        <h2 class="section-title">Skill level</h2>
                        <span class="progress-label">Web Design</span><span class="progress-status">83%</span>
                        <div class="progress progress-tiny">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 83%"
                                 aria-valuenow="83" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="progress-label">Development</span><span class="progress-status">50%</span>
                        <div class="progress progress-tiny">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%"
                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="progress-label">Interface Design</span><span class="progress-status">75%</span>
                        <div class="progress progress-tiny">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"
                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="progress-label">Illustration</span><span class="progress-status">92%</span>
                        <div class="progress progress-tiny">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 92%"
                                 aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="progress-label">Brand Design</span><span class="progress-status">97%</span>
                        <div class="progress progress-tiny">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 97%"
                                 aria-valuenow="97" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="progress-label">Adobe</span><span class="progress-status">90%</span>
                        <div class="progress progress-tiny">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 90%"
                                 aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-body">
                        <h2 class="section-title">My Timeline</h2>
                        <ul class="ms-activity-log">
                            <li>
                                <div class="ms-btn-icon btn-pill icon btn-success">
                                    <i class="flaticon-tick-inside-circle"></i>
                                </div>
                                <h6>Computer Science Degree</h6>
                                <span> <i class="material-icons">event</i>1 January, 2018</span>
                                <p class="fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque
                                    scelerisque diam non nisi semper, ula in sodales vehicula....</p>
                            </li>
                            <li>
                                <div class="ms-btn-icon btn-pill icon btn-info">
                                    <i class="flaticon-information"></i>
                                </div>
                                <h6>Landed first Job</h6>
                                <span> <i class="material-icons">event</i>4 March, 2018</span>
                                <p class="fs-14">Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam
                                    pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>
                            </li>
                            <li>
                                <div class="ms-btn-icon btn-pill icon btn-success">
                                    <i class="flaticon-tick-inside-circle"></i>
                                </div>
                                <h6>Started my own Company</h6>
                                <span> <i class="material-icons">event</i>1 March, 2020</span>
                                <p class="fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque
                                    scelerisque diam non nisi semper, ula in sodales vehicula....</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-body">
                        <h2 class="section-title">Your Latest Posts</h2>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="ms-card">
                                    <div class="ms-card-body">
                                        <div class="media fs-14">
                                            <div class="mr-2 align-self-center">
                                                <img src="../../assets/img/costic/customer-1.jpg" class="ms-img-round"
                                                     alt="people">
                                            </div>
                                            <div class="media-body">
                                                <h6>John Doe </h6>
                                                <div class="dropdown float-right">
                                                    <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li class="ms-dropdown-list">
                                                            <a class="media p-2" href="#">
                                                                <div class="media-body">
                                                                    <span>Comment</span>
                                                                </div>
                                                            </a>
                                                            <a class="media p-2" href="#">
                                                                <div class="media-body">
                                                                    <span>Share</span>
                                                                </div>
                                                            </a>
                                                            <a class="media p-2" href="#">
                                                                <div class="media-body">
                                                                    <span>Favorite</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <p class="fs-12 my-1 text-disabled">30 seconds ago</p>
                                            </div>

                                        </div>
                                        <h6 class="fw-6">This is a card Title</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc
                                            velit, dictum eget nulla a, sollicitudin rhoncus orci. Vivamus nec commodo
                                            turpis.</p>
                                    </div>
                                    <div class="ms-card-img">
                                        <img src="../../assets/img/costic/food-3.jpg" alt="card_img">
                                    </div>
                                    <div class="ms-card-footer text-disabled d-flex">
                                        <div class="ms-card-options">
                                            <i class="material-icons">favorite</i> 982
                                        </div>
                                        <div class="ms-card-options">
                                            <i class="material-icons">comment</i> 785
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="ms-card">
                                    <div class="ms-card-body">
                                        <div class="media fs-14">
                                            <div class="mr-2 align-self-center">
                                                <img src="../../assets/img/costic/customer-2.jpg" class="ms-img-round"
                                                     alt="people">
                                            </div>
                                            <div class="media-body">
                                                <h6>John Doe </h6>
                                                <div class="dropdown float-right">
                                                    <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li class="ms-dropdown-list">
                                                            <a class="media p-2" href="#">
                                                                <div class="media-body">
                                                                    <span>Comment</span>
                                                                </div>
                                                            </a>
                                                            <a class="media p-2" href="#">
                                                                <div class="media-body">
                                                                    <span>Share</span>
                                                                </div>
                                                            </a>
                                                            <a class="media p-2" href="#">
                                                                <div class="media-body">
                                                                    <span>Favorite</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <p class="fs-12 my-1 text-disabled">30 seconds ago</p>
                                            </div>

                                        </div>
                                        <h6 class="fw-6">This is a card Title</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc
                                            velit, dictum eget nulla a, sollicitudin rhoncus orci. Vivamus nec commodo
                                            turpis.</p>
                                    </div>
                                    <div class="ms-card-img">
                                        <img src="../../assets/img/costic/food-6.jpg" alt="card_img">
                                    </div>
                                    <div class="ms-card-footer text-disabled d-flex">
                                        <div class="ms-card-options">
                                            <i class="material-icons">favorite</i> 982
                                        </div>
                                        <div class="ms-card-options">
                                            <i class="material-icons">comment</i> 785
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="ms-card">
                                    <div class="ms-card-body">
                                        <div class="media fs-14">
                                            <div class="mr-2 align-self-center">
                                                <img src="../../assets/img/costic/customer-6.jpg" class="ms-img-round"
                                                     alt="people">
                                            </div>
                                            <div class="media-body">
                                                <h6>John Doe </h6>
                                                <div class="dropdown float-right">
                                                    <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li class="ms-dropdown-list">
                                                            <a class="media p-2" href="#">
                                                                <div class="media-body">
                                                                    <span>Comment</span>
                                                                </div>
                                                            </a>
                                                            <a class="media p-2" href="#">
                                                                <div class="media-body">
                                                                    <span>Share</span>
                                                                </div>
                                                            </a>
                                                            <a class="media p-2" href="#">
                                                                <div class="media-body">
                                                                    <span>Favorite</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <p class="fs-12 my-1 text-disabled">30 seconds ago</p>
                                            </div>

                                        </div>
                                        <h6 class="fw-6">This is a card Title</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc
                                            velit, dictum eget nulla a, sollicitudin rhoncus orci. Vivamus nec commodo
                                            turpis.</p>
                                    </div>
                                    <div class="ms-card-img">
                                        <img src="../../assets/img/costic/food-1.jpg" alt="card_img">
                                    </div>
                                    <div class="ms-card-footer text-disabled d-flex">
                                        <div class="ms-card-options">
                                            <i class="material-icons">favorite</i> 982
                                        </div>
                                        <div class="ms-card-options">
                                            <i class="material-icons">comment</i> 785
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
@endsection
