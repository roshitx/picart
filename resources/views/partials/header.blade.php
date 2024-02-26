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
                            <button class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" role="button" id="buttonAddPost" data-bs-toggle="modal" data-bs-target="#modalUpload" data-bs-hover="tooltip" data-bs-title="Upload your photo!" data-bs-placement="bottom">
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
                                <p class="user-name mb-0">{{ Auth::user()->username }}</p>
                                <p class="designattion mb-0">{{ $profile->bio ?? ' ' }}</p>
                            </div>
                        @else
                            <a href="{{ route('login') }}" role="button" class="fs-4 text-dark">
                                <i class='bx bx-log-in'></i>
                            </a>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if(Auth::check())
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bx bx-user"></i>
                                <span>Profile Edit</span></a>
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
                <li>
                    <a href="{{ route('home') }}" class="d-flex justify-content-center {{ Request::is('/') ? 'active' : '' }}">
                        <div class="parent-icon"><i class='bx bxs-home'></i>
                        </div>
                        <div class="menu-title">Home</div>
                    </a>
                </li>
                @if(Auth::check())
                <li>
                    <a href="{{ route('profile', ['username' => Auth::user()->username]) }}" class="d-flex justify-content-center {{ Request::is('/profile') ? 'active' : '' }}">
                        <div class="parent-icon"><i class='bx bxs-user-circle'></i>
                        </div>
                        <div class="menu-title d-flex">Profile</div>
                    </a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role === 'admin')
                <li>
                    <a class="has-arrow d-flex justify-content-center" href="javascript:;">
                        <div class="parent-icon"><i class='bx bxs-data'></i>
                        </div>
                        <div class="menu-title">Master Data</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('users.index') }}"><i class='bx bxs-user'></i>User Management</a>
                        </li>
                        <li><a href="{{ route('gallery.index') }}"><i class='bx bxs-photo-album' ></i>Post Management</a>
                        </li>
                        <li><a href="{{ route('traffic') }}"><i class='bx bx-stats'></i>Traffic & Generate Report</a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
    </div>
    <!--end navigation-->
</div>
