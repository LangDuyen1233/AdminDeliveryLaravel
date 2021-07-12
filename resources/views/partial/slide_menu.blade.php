<aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">
    <!-- Logo -->
    <div class="logo-sn ms-d-block-lg">
        <a class="pl-0 ml-0 text-center" href="{{route('home')}}">
            <img src="{{asset('assets/img/costic/costic-logo-216x62.png')}}" alt="logo">
        </a>
    </div>
    <!-- Navigation -->
    <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
        <!-- Dashboard -->
        <li class="menu-item">

            <a href="{{route('home')}}" class="{{(request()->routeIs('home')?'active':'')}}"> <span><i
                        class="material-icons fs-16">dashboard</i>Trang chủ</span>
            </a>

        </li>
        <li class="menu-item">

            <a href="{{route('admin-user.index')}}" class="{{(Route::is('admin-user.*')?'active':'')}}">
                <span><i class="fas fa-user-friends fs-16"></i>Người dùng</span></a>

        </li>
        <li class="menu-item">

            <a href="{{route('admin-category.index')}}" class="{{(Route::is('admin-category.*')?'active':'')}}">
                <span><i class="fas fa-list-alt  fs-16"></i>Danh mục</span></a>
        </li>

        <li class="menu-item">

            <a href="{{route('admin-restaurant.index')}}" class="{{(Route::is('admin-restaurant.*')?'active':'')}}">
                <span><i class="fas fa-utensils"></i>Quán ăn</span></a>
        </li>

        <li class="menu-item">

            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#restaurant" aria-expanded="false"
               aria-controls="restaurant"> <span><i class="fa fa-archive fs-16"></i>Menu</span>
            </a>
            <ul id="restaurant" class="collapse" aria-labelledby="restaurant" data-parent="#side-nav-accordion"
                style="">
                {{--                <li></li>--}}
                <li><a href="{{route('admin-food.index')}}" class="{{(Route::is('admin-food.*')?'active':'')}}"
                       style="padding-left: 5px">
                        <span><i class="fa fa-archive fs-16"></i>Menu</span></a>
                </li>
                <li><a href="{{route('admin-topping.index')}}" class="{{(Route::is('admin-topping.*')?'active':'')}}"
                       style="padding-left: 5px">
                        <span><i class="fas fa-spa"></i>Topping</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#order" aria-expanded="false"
               aria-controls="order"> <span><i class="nav-icon fa fa-shopping-basket"></i>Đơn hàng </span>
            </a>
            <ul id="order" class="collapse" aria-labelledby="order" data-parent="#side-nav-accordion">
                <li><a href="{{route('admin-order.index')}}" class="{{(Route::is('admin-order.*')?'active':'')}}"
                       style="padding-left: 5px">
                        <span><i class="nav-icon fa fa-shopping-basket"></i>Đơn hàng</span></a>
                </li>
                <li><a href="{{route('admin-statusOrder.index')}}" class="{{(Route::is('admin-statusOrder.*')?'active':'')}}"
                       style="padding-left: 5px"><span><i class="nav-icon fa fa-server">
                            </i>Trạng thái đơn hàng</span></a>
                </li>
                </li>
            </ul>
        </li>

        <li class="menu-item">

            <a href="{{route('admin-discount.index')}}" class="{{(Route::is('admin-discount.*')?'active':'')}}">
                <span><i class="fas fa-tags"></i>QL khuyến mãi</span></a>
        </li>
        <li class="menu-item">
            <a href="{{route('admin-review.index')}}" class="{{(Route::is('admin-review.*')?'active':'')}}">
                <span><i class="fa fa-comment fs-16"></i>Đánh giá</span>
            </a>
        </li>

        <!-- /Apps -->
    </ul>
</aside>
