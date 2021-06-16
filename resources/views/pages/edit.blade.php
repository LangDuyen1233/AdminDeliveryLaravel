@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pl-0">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Customer</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">New Customer</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Add new customer</h6>
                            </div>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <div class="table-responsive">
                            <div id="data-table-4_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-lg-8 offset-lg-2">
                                        <form>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>First Name <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Username <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Email <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="email">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input class="form-control" type="password">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Confirm Password</label>
                                                        <input class="form-control" type="password">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Employee ID <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Joining Date <span class="text-danger">*</span></label>
                                                        <div  class="cal-icon input-group date"
                                                             data-date-format="dd-mm-yyyy">
                                                            <input id="datePicker" class="form-control datepicker"
                                                                   placeholder="mm/dd/yyyy" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Phone </label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Role</label>
                                                        <select class="custom-select select select2-hidden-accessible"
                                                                tabindex="-1" aria-hidden="true">
                                                            <option>Admin</option>
                                                            <option>Saler</option>
                                                            <option>User</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="display-block">Status</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="employee_active"
                                                           value="option1" checked="">
                                                    <label class="form-check-label" for="employee_active">
                                                        Active
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="employee_inactive"
                                                           value="option2">
                                                    <label class="form-check-label" for="employee_inactive">
                                                        Inactive
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="m-t-20 text-center">
                                                <button type="button" class="btn btn-outline-primary ms-graph-metrics"
                                                        name="button">Create Employee
                                                </button>
                                            </div>
                                        </form>
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
