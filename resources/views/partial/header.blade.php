<nav class="navbar ms-navbar">
    <div class="ms-aside-toggler ms-toggler pl-0" data-target="#ms-side-nav" data-toggle="slideLeft"><span
            class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
    </div>
    <div class="logo-sn logo-sm ms-d-block-sm">
        <a class="pl-0 ml-0 text-center navbar-brand mr-0" href="index.html"><img
                src="assets/img/costic/costic-logo-84x41.png" alt="logo"> </a>
    </div>
    <ul class="ms-nav-list ms-inline mb-0" id="ms-nav-options">
        <li class="ms-nav-item ms-nav-user dropdown" style="display: flex">
            <span
                style="padding-right: 1rem; margin-top: 0.5rem; color: #0095ff; font-size: 18px">{{$user->username}}</span>
            <a href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="ms-user-img ms-img-round float-right"
                     src="{{$user->avatar}}"
                     alt="avatar">
            </a>
            <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="userDropdown">
                <li class="dropdown-menu-header">
                    <h6 class="dropdown-header ms-inline m-0"><span
                            class="text-disabled">Xin chào,{{$user->username}}
                        </span></h6>
                </li>
                <li class="dropdown-divider"></li>
                <li class="ms-dropdown-list">
                    <a class="media fs-14 p-2" href="{{route('profile')}}"> <span><i
                                class="flaticon-user mr-2"></i>Thông tin cá nhân</span>
                    </a>
                <li class="dropdown-menu-footer">
                    <a class="media fs-14 p-2" href="{{route('changePass')}}"> <span><i
                                class="flaticon-layers mr-2"></i>Đổi mật khẩu</span>
                    </a>
                </li>
                <li class="dropdown-menu-footer">
                    <a class="media fs-14 p-2" href="{{route('logout')}}"> <span><i
                                class="flaticon-shut-down mr-2"></i>Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="ms-toggler ms-d-block-sm pr-0 ms-nav-toggler" data-toggle="slideDown" data-target="#ms-nav-options">
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
    </div>
</nav>
