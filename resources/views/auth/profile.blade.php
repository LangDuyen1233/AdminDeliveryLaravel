@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">

        {{--        <div class="ms-profile-overview">--}}
        <div class="ms-profile-cover">
            <img class="ms-profile-img" src="{{$userAdmin->avatar}}" alt="people">
            <div class="ms-profile-user-info">
                <h4 class="ms-profile-username text-white">{{$userAdmin->username}}</h4>
            </div>

        </div>

        <div class="row" style="padding-top: 4rem">

            <div class="col-xl-7 col-md-12">
                <div class="ms-panel ms-panel-fh">
                    <div class="ms-panel-body">
                        <h2 class="section-title">Tiểu sử</h2>
                        <p>{{$userAdmin->bio}}
                        </p>
                    </div>

                </div>
            </div>
            <div class="col-xl-5 col-md-12">
                <div class="ms-panel ms-panel-fh">
                    <div class="ms-panel-body">
                        <div class="" style="display: flex;justify-content: space-between;">
                            <h2 class="section-title">Thông tin cơ bản</h2>
                            <a data-target="#modal-edit{{$userAdmin->id}}" data-toggle="modal"
                               class="btn btn-primary btn-lg rounded-lg"
                               style="color:white;margin-top: 0!important; margin-bottom: 0.5rem">
                                <i class="material-icons">&#xE254;</i> Sửa thông tin</a>
                        </div>


                        <table class="table ms-profile-information">
                            <tbody>
                            <tr>
                                <th scope="row">Họ tên</th>
                                <td>{{$userAdmin->username}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Số điện thoại</th>
                                <td>{{$userAdmin->phone}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td>{{$userAdmin->email}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Ngày sinh</th>
                                <td>{{$userAdmin->dob}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Giới tính</th>
                                <td>{{$userAdmin->gender}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Địa chỉ</th>
                                <td>{{$userAdmin->address[0]->detail}},{{$userAdmin->address[0]->address}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-edit{{$userAdmin->id}}" tabindex="-1"
                 role="dialog" aria-labelledby="modal-edit"
                 style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-min"
                     role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <form method="post"
                                  action="{{route('updateProfile',['id'=>$userAdmin->id])}}">
                                {{ method_field('POST') }}
                                {{ csrf_field() }}
                                <h4>Sửa thông tin</h4>
                                <div class="mb-3 row">
                                    <label>Họ Tên<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="username" class="form-control" id="validationCustom08"
                                               value="{{$userAdmin->username}}"
                                               placeholder="" required="">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label>Số điện thoại<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" name="phone" class="form-control" id="validationCustom08"
                                               value="{{$userAdmin->phone}}"
                                               placeholder="" required="">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label>Giới tính<span class="text-danger">*</span></label>
                                    <select class="custom-select select select2-hidden-accessible"
                                            tabindex="-1" aria-hidden="true" name="gender"
                                            id="gender">
                                        <option
                                            value="1"{{($userAdmin->gender) == 'Nam' ? 'selected' : '' }} >
                                            Nam
                                        </option>
                                        <option
                                            value="2"{{($userAdmin->gender) == 'Nữ' ? 'selected' : '' }} >
                                            Nữ
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3 row">
                                    <label>Ngày sinh<span class="text-danger">*</span></label>
                                    <div class="cal-icon input-group date"
                                         data-date-format="dd/mm/yyyy">
                                        <input id="datePicker" class="form-control datepicker"
                                               placeholder="dd/mm/yyyy" type="text" name="dob"
                                               value="{{$userAdmin->dob}}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label>Tiểu sử</label>
                                    <div class="input-group">
                                        <input type="text" name="bio" class="form-control" id="validationCustom08"
                                               value="{{$userAdmin->bio}}"
                                               placeholder="" required="">
                                    </div>
                                </div>
                                <button type="submit"
                                        class="btn btn-danger btn-lg mr-2 rounded-lg"
                                        data-dismiss="modal">
                                    Hủy
                                </button>
                                <button type="submit"
                                        class="btn btn-primary btn-lg rounded-lg">
                                    Sửa thông tin
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{--            <div class="col-md-12">--}}
            {{--                <div class="ms-panel">--}}
            {{--                    <div class="ms-panel-body">--}}
            {{--                        <h2 class="section-title">Cheffs on Dutty</h2>--}}
            {{--                        <div class="row">--}}
            {{--                            <div class="col-xl-4 col-md-6 col-sm-12">--}}
            {{--                                <div class="media ms-profile-experience">--}}
            {{--                                    <div class="mr-2 align-self-center">--}}
            {{--                                        <img src="../../assets/img/costic/customer-1.jpg"--}}
            {{--                                             class="ms-img-round ms-img-small" alt="people">--}}
            {{--                                    </div>--}}
            {{--                                    <div class="media-body">--}}
            {{--                                        <h4>Mike Labinstine</h4>--}}
            {{--                                        <p>January 2019 to Present</p>--}}
            {{--                                        <p>Veg Cook</p>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-xl-4 col-md-6 col-sm-12">--}}
            {{--                                <div class="media ms-profile-experience">--}}
            {{--                                    <div class="mr-2 align-self-center">--}}
            {{--                                        <img src="../../assets/img/costic/customer-2.jpg"--}}
            {{--                                             class="ms-img-round ms-img-small" alt="people">--}}
            {{--                                    </div>--}}
            {{--                                    <div class="media-body">--}}
            {{--                                        <h4>George Labinstin</h4>--}}
            {{--                                        <p>January 2013 to Present</p>--}}
            {{--                                        <p>Meat Cook</p>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-xl-4 col-md-6 col-sm-12">--}}
            {{--                                <div class="media ms-profile-experience">--}}
            {{--                                    <div class="mr-2 align-self-center">--}}
            {{--                                        <img src="../../assets/img/costic/customer-3.jpg"--}}
            {{--                                             class="ms-img-round ms-img-small" alt="people">--}}
            {{--                                    </div>--}}
            {{--                                    <div class="media-body">--}}
            {{--                                        <h4>Jessy Doe</h4>--}}
            {{--                                        <p>January 2019 to Present</p>--}}
            {{--                                        <p>Top Cheff</p>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-xl-4 col-md-6 col-sm-12">--}}
            {{--                                <div class="media ms-profile-experience">--}}
            {{--                                    <div class="mr-2 align-self-center">--}}
            {{--                                        <img src="../../assets/img/costic/customer-4.jpg"--}}
            {{--                                             class="ms-img-round ms-img-small" alt="people">--}}
            {{--                                    </div>--}}
            {{--                                    <div class="media-body">--}}
            {{--                                        <h4>Jessica Doe</h4>--}}
            {{--                                        <p>January 2013 to Present</p>--}}
            {{--                                        <p>Night Cheff</p>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-xl-4 col-md-6 col-sm-12">--}}
            {{--                                <div class="media ms-profile-experience">--}}
            {{--                                    <div class="mr-2 align-self-center">--}}
            {{--                                        <img src="../../assets/img/costic/customer-5.jpg"--}}
            {{--                                             class="ms-img-round ms-img-small" alt="people">--}}
            {{--                                    </div>--}}
            {{--                                    <div class="media-body">--}}
            {{--                                        <h4>Jhone Doe</h4>--}}
            {{--                                        <p>January 2019 to Present</p>--}}
            {{--                                        <p>The Cheff</p>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-xl-4 col-md-6 col-sm-12">--}}
            {{--                                <div class="media ms-profile-experience">--}}
            {{--                                    <div class="mr-2 align-self-center">--}}
            {{--                                        <img src="../../assets/img/costic/customer-6.jpg"--}}
            {{--                                             class="ms-img-round ms-img-small" alt="people">--}}
            {{--                                    </div>--}}
            {{--                                    <div class="media-body">--}}
            {{--                                        <h4>Manti Jhoe</h4>--}}
            {{--                                        <p>January 2019 to Present</p>--}}
            {{--                                        <p>Quality Control</p>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            {{--            <div class="col-xl-6 col-md-12">--}}
            {{--                <div class="ms-panel ms-panel-fh">--}}
            {{--                    <div class="ms-panel-body">--}}
            {{--                        <h2 class="section-title">Skill level</h2>--}}
            {{--                        <span class="progress-label">Web Design</span><span class="progress-status">83%</span>--}}
            {{--                        <div class="progress progress-tiny">--}}
            {{--                            <div class="progress-bar bg-primary" role="progressbar" style="width: 83%"--}}
            {{--                                 aria-valuenow="83" aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--                        </div>--}}
            {{--                        <span class="progress-label">Development</span><span class="progress-status">50%</span>--}}
            {{--                        <div class="progress progress-tiny">--}}
            {{--                            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%"--}}
            {{--                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--                        </div>--}}
            {{--                        <span class="progress-label">Interface Design</span><span class="progress-status">75%</span>--}}
            {{--                        <div class="progress progress-tiny">--}}
            {{--                            <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"--}}
            {{--                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--                        </div>--}}
            {{--                        <span class="progress-label">Illustration</span><span class="progress-status">92%</span>--}}
            {{--                        <div class="progress progress-tiny">--}}
            {{--                            <div class="progress-bar bg-primary" role="progressbar" style="width: 92%"--}}
            {{--                                 aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--                        </div>--}}
            {{--                        <span class="progress-label">Brand Design</span><span class="progress-status">97%</span>--}}
            {{--                        <div class="progress progress-tiny">--}}
            {{--                            <div class="progress-bar bg-primary" role="progressbar" style="width: 97%"--}}
            {{--                                 aria-valuenow="97" aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--                        </div>--}}
            {{--                        <span class="progress-label">Adobe</span><span class="progress-status">90%</span>--}}
            {{--                        <div class="progress progress-tiny">--}}
            {{--                            <div class="progress-bar bg-primary" role="progressbar" style="width: 90%"--}}
            {{--                                 aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <div class="col-xl-6 col-md-12">--}}
            {{--                <div class="ms-panel">--}}
            {{--                    <div class="ms-panel-body">--}}
            {{--                        <h2 class="section-title">My Timeline</h2>--}}
            {{--                        <ul class="ms-activity-log">--}}
            {{--                            <li>--}}
            {{--                                <div class="ms-btn-icon btn-pill icon btn-success">--}}
            {{--                                    <i class="flaticon-tick-inside-circle"></i>--}}
            {{--                                </div>--}}
            {{--                                <h6>Computer Science Degree</h6>--}}
            {{--                                <span> <i class="material-icons">event</i>1 January, 2018</span>--}}
            {{--                                <p class="fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque--}}
            {{--                                    scelerisque diam non nisi semper, ula in sodales vehicula....</p>--}}
            {{--                            </li>--}}
            {{--                            <li>--}}
            {{--                                <div class="ms-btn-icon btn-pill icon btn-info">--}}
            {{--                                    <i class="flaticon-information"></i>--}}
            {{--                                </div>--}}
            {{--                                <h6>Landed first Job</h6>--}}
            {{--                                <span> <i class="material-icons">event</i>4 March, 2018</span>--}}
            {{--                                <p class="fs-14">Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam--}}
            {{--                                    pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>--}}
            {{--                            </li>--}}
            {{--                            <li>--}}
            {{--                                <div class="ms-btn-icon btn-pill icon btn-success">--}}
            {{--                                    <i class="flaticon-tick-inside-circle"></i>--}}
            {{--                                </div>--}}
            {{--                                <h6>Started my own Company</h6>--}}
            {{--                                <span> <i class="material-icons">event</i>1 March, 2020</span>--}}
            {{--                                <p class="fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque--}}
            {{--                                    scelerisque diam non nisi semper, ula in sodales vehicula....</p>--}}
            {{--                            </li>--}}
            {{--                        </ul>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            {{--            <div class="col-md-12">--}}
            {{--                <div class="ms-panel">--}}
            {{--                    <div class="ms-panel-body">--}}
            {{--                        <h2 class="section-title">Your Latest Posts</h2>--}}
            {{--                        <div class="row">--}}
            {{--                            <div class="col-lg-4 col-md-6 col-sm-6">--}}
            {{--                                <div class="ms-card">--}}
            {{--                                    <div class="ms-card-body">--}}
            {{--                                        <div class="media fs-14">--}}
            {{--                                            <div class="mr-2 align-self-center">--}}
            {{--                                                <img src="../../assets/img/costic/customer-1.jpg" class="ms-img-round"--}}
            {{--                                                     alt="people">--}}
            {{--                                            </div>--}}
            {{--                                            <div class="media-body">--}}
            {{--                                                <h6>John Doe </h6>--}}
            {{--                                                <div class="dropdown float-right">--}}
            {{--                                                    <a href="#" data-toggle="dropdown" aria-haspopup="true"--}}
            {{--                                                       aria-expanded="false">--}}
            {{--                                                        <i class="material-icons">more_vert</i>--}}
            {{--                                                    </a>--}}
            {{--                                                    <ul class="dropdown-menu dropdown-menu-right">--}}
            {{--                                                        <li class="ms-dropdown-list">--}}
            {{--                                                            <a class="media p-2" href="#">--}}
            {{--                                                                <div class="media-body">--}}
            {{--                                                                    <span>Comment</span>--}}
            {{--                                                                </div>--}}
            {{--                                                            </a>--}}
            {{--                                                            <a class="media p-2" href="#">--}}
            {{--                                                                <div class="media-body">--}}
            {{--                                                                    <span>Share</span>--}}
            {{--                                                                </div>--}}
            {{--                                                            </a>--}}
            {{--                                                            <a class="media p-2" href="#">--}}
            {{--                                                                <div class="media-body">--}}
            {{--                                                                    <span>Favorite</span>--}}
            {{--                                                                </div>--}}
            {{--                                                            </a>--}}
            {{--                                                        </li>--}}
            {{--                                                    </ul>--}}
            {{--                                                </div>--}}
            {{--                                                <p class="fs-12 my-1 text-disabled">30 seconds ago</p>--}}
            {{--                                            </div>--}}

            {{--                                        </div>--}}
            {{--                                        <h6 class="fw-6">This is a card Title</h6>--}}
            {{--                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc--}}
            {{--                                            velit, dictum eget nulla a, sollicitudin rhoncus orci. Vivamus nec commodo--}}
            {{--                                            turpis.</p>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="ms-card-img">--}}
            {{--                                        <img src="../../assets/img/costic/food-3.jpg" alt="card_img">--}}
            {{--                                    </div>--}}
            {{--                                    <div class="ms-card-footer text-disabled d-flex">--}}
            {{--                                        <div class="ms-card-options">--}}
            {{--                                            <i class="material-icons">favorite</i> 982--}}
            {{--                                        </div>--}}
            {{--                                        <div class="ms-card-options">--}}
            {{--                                            <i class="material-icons">comment</i> 785--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-lg-4 col-md-6 col-sm-6">--}}
            {{--                                <div class="ms-card">--}}
            {{--                                    <div class="ms-card-body">--}}
            {{--                                        <div class="media fs-14">--}}
            {{--                                            <div class="mr-2 align-self-center">--}}
            {{--                                                <img src="../../assets/img/costic/customer-2.jpg" class="ms-img-round"--}}
            {{--                                                     alt="people">--}}
            {{--                                            </div>--}}
            {{--                                            <div class="media-body">--}}
            {{--                                                <h6>John Doe </h6>--}}
            {{--                                                <div class="dropdown float-right">--}}
            {{--                                                    <a href="#" data-toggle="dropdown" aria-haspopup="true"--}}
            {{--                                                       aria-expanded="false">--}}
            {{--                                                        <i class="material-icons">more_vert</i>--}}
            {{--                                                    </a>--}}
            {{--                                                    <ul class="dropdown-menu dropdown-menu-right">--}}
            {{--                                                        <li class="ms-dropdown-list">--}}
            {{--                                                            <a class="media p-2" href="#">--}}
            {{--                                                                <div class="media-body">--}}
            {{--                                                                    <span>Comment</span>--}}
            {{--                                                                </div>--}}
            {{--                                                            </a>--}}
            {{--                                                            <a class="media p-2" href="#">--}}
            {{--                                                                <div class="media-body">--}}
            {{--                                                                    <span>Share</span>--}}
            {{--                                                                </div>--}}
            {{--                                                            </a>--}}
            {{--                                                            <a class="media p-2" href="#">--}}
            {{--                                                                <div class="media-body">--}}
            {{--                                                                    <span>Favorite</span>--}}
            {{--                                                                </div>--}}
            {{--                                                            </a>--}}
            {{--                                                        </li>--}}
            {{--                                                    </ul>--}}
            {{--                                                </div>--}}
            {{--                                                <p class="fs-12 my-1 text-disabled">30 seconds ago</p>--}}
            {{--                                            </div>--}}

            {{--                                        </div>--}}
            {{--                                        <h6 class="fw-6">This is a card Title</h6>--}}
            {{--                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc--}}
            {{--                                            velit, dictum eget nulla a, sollicitudin rhoncus orci. Vivamus nec commodo--}}
            {{--                                            turpis.</p>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="ms-card-img">--}}
            {{--                                        <img src="../../assets/img/costic/food-6.jpg" alt="card_img">--}}
            {{--                                    </div>--}}
            {{--                                    <div class="ms-card-footer text-disabled d-flex">--}}
            {{--                                        <div class="ms-card-options">--}}
            {{--                                            <i class="material-icons">favorite</i> 982--}}
            {{--                                        </div>--}}
            {{--                                        <div class="ms-card-options">--}}
            {{--                                            <i class="material-icons">comment</i> 785--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-lg-4 col-md-6 col-sm-6">--}}
            {{--                                <div class="ms-card">--}}
            {{--                                    <div class="ms-card-body">--}}
            {{--                                        <div class="media fs-14">--}}
            {{--                                            <div class="mr-2 align-self-center">--}}
            {{--                                                <img src="../../assets/img/costic/customer-6.jpg" class="ms-img-round"--}}
            {{--                                                     alt="people">--}}
            {{--                                            </div>--}}
            {{--                                            <div class="media-body">--}}
            {{--                                                <h6>John Doe </h6>--}}
            {{--                                                <div class="dropdown float-right">--}}
            {{--                                                    <a href="#" data-toggle="dropdown" aria-haspopup="true"--}}
            {{--                                                       aria-expanded="false">--}}
            {{--                                                        <i class="material-icons">more_vert</i>--}}
            {{--                                                    </a>--}}
            {{--                                                    <ul class="dropdown-menu dropdown-menu-right">--}}
            {{--                                                        <li class="ms-dropdown-list">--}}
            {{--                                                            <a class="media p-2" href="#">--}}
            {{--                                                                <div class="media-body">--}}
            {{--                                                                    <span>Comment</span>--}}
            {{--                                                                </div>--}}
            {{--                                                            </a>--}}
            {{--                                                            <a class="media p-2" href="#">--}}
            {{--                                                                <div class="media-body">--}}
            {{--                                                                    <span>Share</span>--}}
            {{--                                                                </div>--}}
            {{--                                                            </a>--}}
            {{--                                                            <a class="media p-2" href="#">--}}
            {{--                                                                <div class="media-body">--}}
            {{--                                                                    <span>Favorite</span>--}}
            {{--                                                                </div>--}}
            {{--                                                            </a>--}}
            {{--                                                        </li>--}}
            {{--                                                    </ul>--}}
            {{--                                                </div>--}}
            {{--                                                <p class="fs-12 my-1 text-disabled">30 seconds ago</p>--}}
            {{--                                            </div>--}}

            {{--                                        </div>--}}
            {{--                                        <h6 class="fw-6">This is a card Title</h6>--}}
            {{--                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc--}}
            {{--                                            velit, dictum eget nulla a, sollicitudin rhoncus orci. Vivamus nec commodo--}}
            {{--                                            turpis.</p>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="ms-card-img">--}}
            {{--                                        <img src="../../assets/img/costic/food-1.jpg" alt="card_img">--}}
            {{--                                    </div>--}}
            {{--                                    <div class="ms-card-footer text-disabled d-flex">--}}
            {{--                                        <div class="ms-card-options">--}}
            {{--                                            <i class="material-icons">favorite</i> 982--}}
            {{--                                        </div>--}}
            {{--                                        <div class="ms-card-options">--}}
            {{--                                            <i class="material-icons">comment</i> 785--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

        </div>


    </div>
@endsection
