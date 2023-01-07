<!-- Core JS -->
<script src="{{ asset('admin-assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('admin-assets/vendor/libs/hammer/hammer.js') }}"></script>

<script src="{{ asset('admin-assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

<script src="{{ asset('admin-assets/vendor/js/menu.js') }}"></script>

<!-- Vendors JS -->
<script src="{{ asset('admin-assets/js/custom.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/libs/toastr/toastr.js') }}"></script>

@yield('vendor-js')

<!-- Main JS -->
<script src="{{ asset('admin-assets/js/main.js') }}"></script>

<!-- Page JS --> 
@yield('page-js')


<!-- counter-->
<script>
    const counters = document.querySelectorAll('#counter');
    for(let n of counters) {
        const updateCount = () => {
            const target = + n.getAttribute('data-target');
            const count = + n.innerText;
            const speed = 400;
            const inc = target / speed;
            if(count < target) {
                n.innerText = Math.ceil(count + inc);
                setTimeout(updateCount, 1);
            } else {
                n.innerText = target;
            }
        }
        updateCount();
    }
</script>