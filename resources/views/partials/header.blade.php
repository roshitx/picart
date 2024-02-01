<div class="header-wrapper">
    <!--start header -->
    <header>
        <div class="topbar d-flex align-items-center">
            <nav class="navbar navbar-expand">
                <div class="topbar-logo-header">
                    <div class="">
                        <img src="{{ asset('images/logo.png') }}" class="logo-icon" alt="logo icon">
                    </div>
                    <div class="">
                        <a class="logo-text" href="{{ route('home') }}">PicArt</a>
                    </div>
                </div>
                <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
                <div class="top-menu ms-auto">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item dropdown dropdown-large">
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:;">
                                    <div class="msg-header">
                                        <p class="msg-header-title">Notifications</p>
                                        <p class="msg-header-clear ms-auto">Marks all as read</p>
                                    </div>
                                </a>
                                <div class="header-notifications-list">
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">New Customers<span class="msg-time float-end">14
                                                        Sec
                                                        ago</span></h6>
                                                <p class="msg-info">5 new user registered</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-danger text-danger"><i class="bx bx-cart-alt"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
                                                        ago</span></h6>
                                                <p class="msg-info">You have recived new orders</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-success text-success"><i class="bx bx-file"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">24 PDF File<span class="msg-time float-end">19 min
                                                        ago</span></h6>
                                                <p class="msg-info">The pdf files generated</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-warning text-warning"><i class="bx bx-send"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Time Response <span class="msg-time float-end">28
                                                        min
                                                        ago</span></h6>
                                                <p class="msg-info">5.1 min avarage time response</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-info text-info"><i class="bx bx-home-circle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">New Product Approved <span class="msg-time float-end">2 hrs ago</span></h6>
                                                <p class="msg-info">Your new product has approved</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-danger text-danger"><i class="bx bx-message-detail"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">New Comments <span class="msg-time float-end">4
                                                        hrs
                                                        ago</span></h6>
                                                <p class="msg-info">New customer comments recived</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-success text-success"><i class='bx bx-check-square'></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs
                                                        ago</span></h6>
                                                <p class="msg-info">Successfully shipped your item</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-primary text-primary"><i class='bx bx-user-pin'></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">New 24 authors<span class="msg-time float-end">1
                                                        day
                                                        ago</span></h6>
                                                <p class="msg-info">24 new authors joined last week</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-warning text-warning"><i class='bx bx-door-open'></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Defense Alerts <span class="msg-time float-end">2
                                                        weeks
                                                        ago</span></h6>
                                                <p class="msg-info">45% less alerts last 4 weeks</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <a href="javascript:;">
                                    <div class="text-center msg-footer">View All Notifications</div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-large">
                            <button class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" role="button" id="buttonAddPost" data-bs-toggle="modal" data-bs-target="#modalUpload">
                                <i class='bx bxs-plus-square'></i>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="user-box dropdown">
                    <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Auth::check())
                        @php
                        $user = Auth::user();
                        $avatar = Avatar::create($user->fullname);
                        $profile = Auth::user()->profile;
                        @endphp
                        <img src="{{ @$user->profile->avatar ? asset('storage/avatar/' . @$user->profile->avatar) : $avatar }}" class="user-img" alt="user avatar">
                        <div class="user-info ps-3">
                            <p class="user-name mb-0">{{ Auth::user()->username ?? 'User' }}</p>
                            <p class="designattion mb-0">{{ $profile->bio ?? ' ' }}</p>
                        </div>
                        @else
                        <button class="btn btn-primary"><i class='bx bx-log-in'></i> Login</button>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if(Auth::check())
                        <li><a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="bx bx-user"></i>
                                <span>Profile</span></a>
                        </li>
                        <li>
                            <div class="dropdown-divider mb-0"></div>
                        </li>
                        <li><a class="dropdown-item" href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @else
                        <li><a class="dropdown-item" href="{{ route('login') }}">
                                <i class="bx bx-log-in-circle"></i>
                                <span>Login</span></a>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!--end header -->
    <!--navigation-->
    <div class="nav-container">
        <div class="mobile-topbar-header">
            <div>
                <img src="{{ asset('images/logo.png') }}" class="logo-icon" alt="logo icon">
            </div>
            <div>
                <h4 class="logo-text">PicArt</h4>
            </div>
            <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
            </div>
        </div>
        <nav class="topbar-nav">
            <ul class="metismenu" id="menu">
                <li class="justify-content-center align-items-center">
                    <a href="{{ route('home') }}">
                        <div class="parent-icon"><i class='bx bxs-home'></i>
                        </div>
                        <div class="menu-title">Home</div>
                    </a>
                </li>
                <li class="justify-content-center align-items-center">
                    <a href="javascript:;">
                        <div class="parent-icon"><i class='bx bxs-user-circle'></i>
                        </div>
                        <div class="menu-title">Profile</div>
                    </a>
                </li>
                @if(Auth::check() && Auth::user()->role === 'admin')
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class='bx bxs-data'></i>
                        </div>
                        <div class="menu-title">Master Data</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('users.index') }}"><i class='bx bxs-user'></i>User Management</a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
    </div>
    <!--end navigation-->
</div>
