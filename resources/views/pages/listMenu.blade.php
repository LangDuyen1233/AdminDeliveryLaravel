@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pl-0">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i> Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Menu</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Menu List</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Product List</h6>
                            </div>
                            <button type="button" class="btn btn-outline-primary ms-graph-metrics" name="button"><a
                                    href="{{route('addMenu')}}">Add New Menu</a>
                            </button>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <div id="data-table-5_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="data-table-5_length"><label>Show <select
                                                name="data-table-5_length" aria-controls="data-table-5"
                                                class="custom-select custom-select-sm form-control form-control-sm">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> </label></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="data-table-5_filter" class="dataTables_filter"><label><input
                                                type="search" class="form-control form-control-sm"
                                                placeholder="Search Data..." aria-controls="data-table-5"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                            <div class="ms-card">
                                                <div class="ms-card-img">
                                                    <img src="../../assets/img/costic/food-1.jpg" alt="card_img">
                                                </div>
                                                <div class="ms-card-body">

                                                    <div class="new">
                                                        <h6 class="mb-0">Veggies </h6>
                                                        <h6 class="ms-text-primary mb-0">$45.50</h6>
                                                    </div>
                                                    <div class="new meta">
                                                        <p>Qty:1467 </p>
                                                        <span class="badge badge-success">In Stock</span>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                        dolor sit amet, consectetur adipiscing</p>
                                                    <div class="new mb-0">
                                                        <button type="button" data-toggle="modal" data-target="#modal-delete"
                                                                class="btn grid-btn mt-0 btn-sm btn-primary color">Remove
                                                        </button>
                                                        <button type="button"
                                                                class="btn grid-btn mt-0 btn-sm btn-secondary color">Edit
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                            <div class="ms-card">
                                                <div class="ms-card-img">
                                                    <img src="../../assets/img/costic/food-2.jpg" alt="card_img">
                                                </div>
                                                <div class="ms-card-body">
                                                    <div class="new">
                                                        <h6 class="mb-0">Garlic Bread </h6>
                                                        <h6 class="ms-text-primary mb-0">$45.50</h6>
                                                    </div>
                                                    <div class="new meta">
                                                        <p>Qty:6224 </p>
                                                        <span class="badge badge-primary">Out of Stock</span>
                                                    </div>

                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                        dolor sit amet, consectetur adipiscing</p>
                                                    <div class="new mb-0">
                                                        <button type="button"data-toggle="modal" data-target="#modal-delete"
                                                                class="btn grid-btn mt-0 btn-sm btn-primary">Remove
                                                        </button>
                                                        <button type="button"
                                                                class="btn grid-btn mt-0 btn-sm btn-secondary">Edit
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                            <div class="ms-card">
                                                <div class="ms-card-img">
                                                    <img src="../../assets/img/costic/food-3.jpg" alt="card_img">
                                                </div>
                                                <div class="ms-card-body">
                                                    <div class="new">
                                                        <h6 class="mb-0">Veg Sandwich </h6>
                                                        <h6 class="ms-text-primary mb-0">$45.50</h6>
                                                    </div>
                                                    <div class="new meta">
                                                        <p>Qty:1467 </p>
                                                        <span class="badge badge-success">In Stock</span>
                                                    </div>

                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                        dolor sit amet, consectetur adipiscing</p>
                                                    <div class="new mb-0">
                                                        <button type="button"
                                                                class="btn grid-btn mt-0 btn-sm btn-primary">Remove
                                                        </button>
                                                        <button type="button"
                                                                class="btn  grid-btn mt-0 btn-sm btn-secondary">Edit
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                            <div class="ms-card">
                                                <div class="ms-card-img">
                                                    <img src="../../assets/img/costic/food-4.jpg" alt="card_img">
                                                </div>
                                                <div class="ms-card-body">
                                                    <div class="new">
                                                        <h6 class="mb-0">Roast Sandwich</h6>
                                                        <h6 class="ms-text-primary mb-0">$45.50</h6>
                                                    </div>
                                                    <div class="new meta">
                                                        <p>Qty:6224 </p>
                                                        <span class="badge badge-primary">Out of Stock</span>
                                                    </div>


                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                        dolor sit amet, consectetur adipiscing</p>
                                                    <div class="new mb-0">
                                                        <button type="button"
                                                                class="btn grid-btn mt-0 btn-sm btn-primary">Remove
                                                        </button>
                                                        <button type="button"
                                                                class="btn grid-btn mt-0 btn-sm btn-secondary">Edit
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                            <div class="ms-card">
                                                <div class="ms-card-img">
                                                    <img src="../../assets/img/costic/food-5.jpg" alt="card_img">
                                                </div>
                                                <div class="ms-card-body">
                                                    <div class="new">
                                                        <h6 class="mb-0">Burger</h6>
                                                        <h6 class="ms-text-primary mb-0">$45.50</h6>
                                                    </div>
                                                    <div class="new meta">
                                                        <p>Qty:1467 </p>
                                                        <span class="badge badge-success">In Stock</span>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                        dolor sit amet, consectetur adipiscing</p>
                                                    <div class="new mb-0">
                                                        <button type="button"
                                                                class="btn grid-btn mt-0 btn-sm btn-primary">Remove
                                                        </button>
                                                        <button type="button"
                                                                class="btn grid-btn mt-0 btn-sm btn-secondary">Edit
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                            <div class="ms-card">
                                                <div class="ms-card-img">
                                                    <img src="../../assets/img/costic/food-6.jpg" alt="card_img">
                                                </div>
                                                <div class="ms-card-body">
                                                    <div class="new">
                                                        <h6 class="mb-0">Veggies </h6>
                                                        <h6 class="ms-text-primary mb-0">$45.50</h6>
                                                    </div>
                                                    <div class="new meta">
                                                        <p>Qty:1467 </p>
                                                        <span class="badge badge-success">In Stock</span>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                        dolor sit amet, consectetur adipiscing</p>
                                                    <div class="new mb-0">
                                                        <button type="button"
                                                                class="btn grid-btn mt-0 btn-sm btn-primary">Remove
                                                        </button>
                                                        <button type="button"
                                                                class="btn grid-btn mt-0 btn-sm btn-secondary">Edit
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                            <div class="ms-card">
                                                <div class="ms-card-img">
                                                    <img src="../../assets/img/costic/food-7.jpg" alt="card_img">
                                                </div>
                                                <div class="ms-card-body">
                                                    <div class="new">
                                                        <h6 class="mb-0">Pepperoni Pizza </h6>
                                                        <h6 class="ms-text-primary mb-0">$45.50</h6>
                                                    </div>
                                                    <div class="new meta">
                                                        <p>Qty:6224 </p>
                                                        <span class="badge badge-primary">Out of Stock</span>
                                                    </div>

                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                        dolor sit amet, consectetur adipiscing</p>
                                                    <div class="new mb-0">
                                                        <button type="button"
                                                                class="btn grid-btn mt-0 btn-sm btn-primary">Remove
                                                        </button>
                                                        <button type="button"
                                                                class="btn grid-btn mt-0 btn-sm btn-secondary">Edit
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                            <div class="ms-card">
                                                <div class="ms-card-img">
                                                    <img src="../../assets/img/costic/food-8.jpg" alt="card_img">
                                                </div>
                                                <div class="ms-card-body">
                                                    <div class="new">
                                                        <h6 class="mb-0">Egg McMuffin </h6>
                                                        <h6 class="ms-text-primary mb-0">$45.50</h6>
                                                    </div>
                                                    <div class="new meta">
                                                        <p>Qty:1467 </p>
                                                        <span class="badge badge-success">In Stock</span>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                        dolor sit amet, consectetur adipiscing</p>
                                                    <div class="new mb-0">
                                                        <button type="button"
                                                                class="btn grid-btn mt-0 btn-sm btn-primary">Remove
                                                        </button>
                                                        <button type="button"
                                                                class="btn grid-btn mt-0 btn-sm btn-secondary">Edit
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="data-table-5_info" role="status"
                                         aria-live="polite">Showing 1 to 10 of 36 entries
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers"
                                         id="data-table-5_paginate">
                                        <ul class="pagination has-gap">
                                            <li class="paginate_button page-item previous disabled"
                                                id="data-table-5_previous"><a href="#" aria-controls="data-table-5"
                                                                              data-dt-idx="0" tabindex="0"
                                                                              class="page-link">Previous</a></li>
                                            <li class="paginate_button page-item active"><a href="#"
                                                                                            aria-controls="data-table-5"
                                                                                            data-dt-idx="1"
                                                                                            tabindex="0"
                                                                                            class="page-link">1</a>
                                            </li>
                                            <li class="paginate_button page-item "><a href="#"
                                                                                      aria-controls="data-table-5"
                                                                                      data-dt-idx="2" tabindex="0"
                                                                                      class="page-link">2</a></li>
                                            <li class="paginate_button page-item "><a href="#"
                                                                                      aria-controls="data-table-5"
                                                                                      data-dt-idx="3" tabindex="0"
                                                                                      class="page-link">3</a></li>
                                            <li class="paginate_button page-item "><a href="#"
                                                                                      aria-controls="data-table-5"
                                                                                      data-dt-idx="4" tabindex="0"
                                                                                      class="page-link">4</a></li>
                                            <li class="paginate_button page-item next" id="data-table-5_next"><a
                                                    href="#" aria-controls="data-table-5" data-dt-idx="5"
                                                    tabindex="0" class="page-link">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-delete"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-min" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span>
                    </button>
                    <i class="flaticon-secure-shield d-block"></i>
                    <h1>Delete User</h1>
                    <p>Are you sure want delete user?</p>
                    <button type="button" class="btn btn-secondary btn-lg mr-2 rounded-lg" data-dismiss="modal">Cancel
                    </button>
                    <button type="button" class="btn btn-danger btn-lg rounded-lg">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
