@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">

            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pl-0">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Orders</li>

                    </ol>
                </nav>
                <div class="col-md-12">
                    <div class="ms-panel ms-panel-fh">
                        <div class="ms-panel-header">
                            <h6>Favourite Orders</h6>
                        </div>
                        <div class="ms-panel-body order-circle">
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-6">
                                    <h6 class="text-center">Pizza</h6>
                                    <div class="progress-rounded progress-round-tiny">

                                        <div class="progress-value">12%</div>
                                        <svg>
                                            <circle class="progress-cicle bg-success animated" cx="65" cy="65" r="57"
                                                    stroke-width="4" fill="none" aria-valuenow="12"
                                                    aria-orientation="vertical" aria-valuemin="0" aria-valuemax="100"
                                                    role="slider" style="stroke-dashoffset: 315.165px;">
                                            </circle>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6">
                                    <h6 class="text-center">Mexican Noodels</h6>
                                    <div class="progress-rounded progress-round-tiny">
                                        <div class="progress-value">38.8%</div>
                                        <svg>
                                            <circle class="progress-cicle bg-primary animated" cx="65" cy="65" r="57"
                                                    stroke-width="4" fill="none" aria-valuenow="38.8"
                                                    aria-orientation="vertical" aria-valuemin="0" aria-valuemax="100"
                                                    role="slider" style="stroke-dashoffset: 219.183px;">
                                            </circle>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6">
                                    <h6 class="text-center">Spicy Salad</h6>
                                    <div class="progress-rounded progress-round-tiny">
                                        <div class="progress-value">78.8%</div>
                                        <svg>
                                            <circle class="progress-cicle bg-secondary animated" cx="65" cy="65" r="57"
                                                    stroke-width="4" fill="none" aria-valuenow="78.8"
                                                    aria-orientation="vertical" aria-valuemin="0" aria-valuemax="100"
                                                    role="slider" style="stroke-dashoffset: 75.926px;">
                                            </circle>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6">
                                    <h6 class="text-center">French Fries</h6>
                                    <div class="progress-rounded progress-round-tiny">
                                        <div class="progress-value">100%</div>
                                        <svg>
                                            <circle class="progress-cicle bg-dark animated" cx="65" cy="65" r="57"
                                                    stroke-width="4" fill="none" aria-valuenow="100"
                                                    aria-orientation="vertical" aria-valuemin="0" aria-valuemax="100"
                                                    role="slider" style="stroke-dashoffset: 0px;">
                                            </circle>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ms-panel">
                        <div class="ms-panel-header">
                            <div class="d-flex justify-content-between">
                                <div class="ms-header-text">
                                    <h6> Order List</h6>
                                </div>
                                <button type="button" class="btn btn-outline-primary ms-graph-metrics" name="button"><a
                                        href="">Add New Order</a>
                                </button>
                            </div>
                        </div>
                        <div class="ms-panel-body">

                            <div class="table-responsive">
                                <table class="table table-hover thead-primary">
                                    <thead>
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Order Name</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Order Status</th>
                                        <th scope="col">Delivered Time</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>French Fries</td>
                                        <td> Jhon Leo</td>
                                        <td> New Town</td>
                                        <td><span class="badge badge-primary">Pending</span></td>
                                        <td>10:05</td>
                                        <td>$10</td>
                                        <td>
                                            <a class="edit hvicon" style="color: green"
                                               href="{{route('editUser')}}"><i
                                                    class="material-icons">&#xE254;</i></a>
                                            <a class="delete hvicon" data-toggle="modal"
                                               data-target="#modal-delete"
                                               style="color: red"><i class=" material-icons">&#xE872;</i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Mango Pie</td>
                                        <td>Kristien</td>
                                        <td> Old Town</td>
                                        <td><span class="badge badge-dark">Cancelled</span></td>
                                        <td>14:05</td>
                                        <td>$9</td>
                                        <td>
                                            <a class="edit hvicon" style="color: green"
                                               href="{{route('editUser')}}"><i
                                                    class="material-icons">&#xE254;</i></a>
                                            <a class="delete hvicon" data-toggle="modal"
                                               data-target="#modal-delete"
                                               style="color: red"><i class=" material-icons">&#xE872;</i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>FrieD Egg Sandwich</td>
                                        <td>Jack Suit</td>
                                        <td> Oxford Street</td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td>12:05</td>
                                        <td>$19</td>
                                        <td>
                                            <a class="edit hvicon" style="color: green"
                                               href="{{route('editUser')}}"><i
                                                    class="material-icons">&#xE254;</i></a>
                                            <a class="delete hvicon" data-toggle="modal"
                                               data-target="#modal-delete"
                                               style="color: red"><i class=" material-icons">&#xE872;</i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Lemon Yogurt Parfait</td>
                                        <td>Alesdro Guitto</td>
                                        <td> Church hill</td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td>12:05</td>
                                        <td>$18</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>Spicy Grill Sandwich</td>
                                        <td>Jacob Sahwny</td>
                                        <td> palace Road</td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td>12:05</td>
                                        <td>$21</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6</th>
                                        <td>Chicken Sandwich</td>
                                        <td>Peter Gill</td>
                                        <td> Street 21</td>
                                        <td><span class="badge badge-primary">Pending</span></td>
                                        <td>12:05</td>
                                        <td>$15</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">7</th>
                                        <td> Sandwich</td>
                                        <td>Jack Suit</td>
                                        <td> 40, Street</td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td>11:05</td>
                                        <td>$19</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">8</th>
                                        <td>Spaghetti</td>
                                        <td>Jack Suit</td>
                                        <td> Oxford Street</td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td>12:05</td>
                                        <td>$19</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">9</th>
                                        <td>Fried Rice</td>
                                        <td>Jack Suit</td>
                                        <td> Hilltown Street</td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td>12:05</td>
                                        <td>$19</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">10</th>
                                        <td>Noodels</td>
                                        <td>Jack Suit</td>
                                        <td> Oxford Street</td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td>12:05</td>
                                        <td>$19</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
