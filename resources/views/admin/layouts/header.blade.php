<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme card" id="layout-navbar">
    <div class="container-fluid">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Style Switcher -->
            <li class="nav-item me-2 me-xl-0">
                <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                    <i class="bx bx-sm"></i>
                </a>
            </li>
            <!--/ Style Switcher -->
        </ul>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

            <ul class="navbar-nav flex-row align-items-center ms-auto">

                <!-- Quick links  -->
                {{-- <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                        data-bs-auto-close="outside" aria-expanded="false">
                        <i class="bx bx-grid-alt bx-sm"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end py-0">
                        <div class="dropdown-menu-header border-bottom">
                            <div class="dropdown-header d-flex align-items-center py-3">
                                <h5 class="text-body mb-0 me-auto secondary-font">میانبرها</h5>
                            </div>
                        </div>
                        <div class="dropdown-shortcuts-list scrollable-container">
                            <div class="row row-bordered overflow-visible g-0">
                                <div class="dropdown-shortcuts-item col {{  request()->is('admin/membership/user*') ? 'bg-label-secondary' : '' }}">
                                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                        <i class="bx bx-user fs-4"></i>
                                    </span>
                                    <a href="{{ route('admin.membership.user.index') }}" class="stretched-link">مدیران</a>
                                    <small class="text-muted mb-0">مدیریت مدیران</small>
                                </div>
                                <div class="dropdown-shortcuts-item col {{  request()->is('admin/membership/organization*') ? 'bg-label-secondary' : '' }}">
                                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                        <i class="bx bx-buildings fs-4"></i>
                                    </span>
                                    <a href="{{ route('admin.membership.organization.index') }}" class="stretched-link">سازمان ها</a>
                                    <small class="text-muted mb-0">مدیریت سازمان ها</small>
                                </div>
                            </div>
                            <div class="row row-bordered overflow-visible g-0">
                                <div class="dropdown-shortcuts-item col {{  request()->is('admin/membership/role*') ? 'bg-label-secondary' : '' }}">
                                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                        <i class="bx bx-check-shield fs-4"></i>
                                    </span>
                                    <a href="{{ route('admin.membership.role.index') }}" class="stretched-link">نقش ها</a>
                                    <small class="text-muted mb-0">مدیریت نقش ها</small>
                                </div>
                                <div class="dropdown-shortcuts-item col {{  request()->is('admin/membership/permission*') ? 'bg-label-secondary' : '' }}">
                                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                        <i class="bx bx-key fs-4"></i>
                                    </span>
                                    <a href="{{ route('admin.membership.permission.index') }}" class="stretched-link">مجوزها</a>
                                    <small class="text-muted mb-0">مدیریت مجوزها</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </li> --}}
                <!-- Quick links -->

                <!-- Notification -->
                {{-- <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                        data-bs-auto-close="outside" aria-expanded="false">
                        <i class="bx bx-bell bx-sm"></i>
                        <span class="badge bg-danger rounded-pill badge-notifications">5</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end py-0">
                        <li class="dropdown-menu-header border-bottom">
                            <div class="dropdown-header d-flex align-items-center py-3">
                                <h5 class="text-body mb-0 me-auto secondary-font">اعلان‌ها</h5>
                                <a href="javascript:void(0)" class="dropdown-notifications-all text-body"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="علامت خوانده شده به همه"><i
                                        class="bx fs-4 bx-envelope-open"></i></a>
                            </div>
                        </li>
                        <li class="dropdown-notifications-list scrollable-container">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar">
                                                <img src="../../assets/img/avatars/1.png" alt
                                                    class="w-px-40 h-auto rounded-circle">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">لورم ایپسوم متن ساختگی با</h6>
                                            <p class="mb-1">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</p>
                                            <small class="text-muted">1 ساعت قبل</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                    class="badge badge-dot"></span></a>
                                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                    class="bx bx-x"></span></a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-menu-footer border-top">
                            <a href="javascript:void(0);" class="dropdown-item d-flex justify-content-center p-3">
                                مشاهده همه اعلان‌ها
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <!--/ Notification -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                        data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="{{ asset('admin-assets/img/avatars/1.png') }}" alt class="rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="pages-account-settings-account.html">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online mt-1">
                                            <img src="{{ asset('admin-assets/img/avatars/1.png') }}" alt class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">{{ auth()->user()->fullName }}</span>
                                        <small>مدیر</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li class="@if(Route::currentRouteName() == 'admin.membership.profile') bg-light @endif">
                            <a class="dropdown-item" href="{{ route('admin.membership.profile') }}">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">پروفایل من</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="pages-account-settings-account.html">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">تنظیمات</span>
                            </a>
                        </li>

                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                            @csrf
                                <button class="dropdown-item" >
                                    <i class="bx bx-power-off me-2 text-danger"></i>
                                    <span class="align-middle text-danger">خروج</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </div>
</nav>
