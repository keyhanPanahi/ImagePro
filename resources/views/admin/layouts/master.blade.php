<!DOCTYPE html>
<html lang="fa" class="light-style layout-navbar-fixed layout-menu-fixed" dir="rtl" data-theme="theme-default" data-assets-path="{{ asset('admin-assets').'/' }}" data-template="vertical-menu-template">

    <head>
        @include('admin.layouts.head-tag')
    </head>

  <body>

    <div class="spinner-wrapper">
      <div class="sk-chase">
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
      </div>
    </div>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        @include('admin.layouts.sidebar')

        <!-- Layout container -->
        <div class="layout-page">

          @include('admin.layouts.header')

          <div class="content-wrapper">

            <div class="container-xxl flex-grow-1 container-p-y">
              @yield('content')
            </div>

            @include('admin.layouts.footer')

            <div class="content-backdrop fade"></div>
          </div>
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
      <div class="drag-target"></div>
      
    </div>
    <!-- / Layout wrapper -->

    @include('admin.layouts.script')

    <!-- sweet alert confirm-->
    @include('admin.alerts.sweetalert.sweetalert-confirm')

    <!-- toast-->
    @include('admin.alerts.toast.session')
    </body>
</html>
