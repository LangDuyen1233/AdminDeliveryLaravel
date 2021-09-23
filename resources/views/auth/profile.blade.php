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
                                               placeholder="">
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

        </div>


    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('#datePicker').datepicker({
            format: 'mm-dd-yyyy'
        });
    </script>
@endsection
