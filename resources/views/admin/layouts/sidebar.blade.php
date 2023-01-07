<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
     <img src="{{ asset('admin-assets/file/avatar/main-fava.png') }}" alt="" width="40px" height="40px">
        <span class="app-brand demo fw-bold text-secondary  ms-2">فاواگستر سپهر</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
        <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
     
      <li class="menu-item @if(Route::currentRouteName() == 'admin.dashboard') active @endif">
        <a href="{{ route('admin.dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div>داشبورد</div>
        </a>
      </li>
      
    </ul>
  </aside>