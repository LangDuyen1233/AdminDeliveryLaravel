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
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="ms-card">
                                                <div class="ms-card-body">
                                                    <div class="media fs-14">
                                                        <div class="mr-2 align-self-center">
                                                            <img src="../../assets/img/costic/customer-1.jpg"
                                                                 class="ms-img-round" alt="people">
                                                        </div>
                                                        <div class="media-body">
                                                            <h6>John Doe </h6>
                                                            <div class="dropdown float-right">
                                                                <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                                                   aria-expanded="false">
                                                                    <i class="material-icons">more_vert</i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-right"
                                                                    x-placement="top-end"
                                                                    style="position: absolute; will-change: top, left; top: -130px; left: -142px;">
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                        Phasellus nunc velit, dictum eget nulla a, sollicitudin rhoncus
                                                        orci. Vivamus nec commodo turpis.</p>
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
                                                            <img src="../../assets/img/costic/customer-2.jpg"
                                                                 class="ms-img-round" alt="people">
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                        Phasellus nunc velit, dictum eget nulla a, sollicitudin rhoncus
                                                        orci. Vivamus nec commodo turpis.</p>
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
                                                            <img src="../../assets/img/costic/customer-6.jpg"
                                                                 class="ms-img-round" alt="people">
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                        Phasellus nunc velit, dictum eget nulla a, sollicitudin rhoncus
                                                        orci. Vivamus nec commodo turpis.</p>
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
@endsection
