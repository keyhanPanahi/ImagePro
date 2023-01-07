<script>
    $(function() {
        'use strict';
        var isRtl = $('html').attr('data-textdirection') === 'rtl',
            typeSuccess = $('#type-success'),
            typeInfo = $('#type-info'),
            typeWarning = $('#type-warning'),
            typeError = $('#type-error'),
            clearToastObj;
        // Success Type  
        @if (session('LoginSuccessfull'))
            setTimeout(() => {
                toastr['success'](' روز خوبی رو برای شما آرزومندیم 🎉! <br> (شرکت فاواگسترسپهر)', '{{ session('LoginSuccessfull') }}👋', {
                closeButton: true,
                progressBar: true,
                showMethod: 'fadeIn',
                hideMethod: 'fadeOut',
                timeOut: 5000,
                tapToDismiss: false,
                rtl: isRtl
                });
            }, 2000);
        @endif 
        // Success Type  
        @if (session('toast-success'))
            toastr['success']('{{ session('toast-success') }}', 'عملیات با موفقیت انجام شد!', {
            closeButton: true,
            progressBar: true,
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut',
            // timeOut: 5000,
            tapToDismiss: false,
            rtl: isRtl
            });
        @endif
        // error Type  
        @if (session('toast-error'))
            toastr['error']('{{ session('toast-error') }}',  'خطا!', {
            closeButton: true,
            progressBar: true,
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut',
            // timeOut: 5000,
            tapToDismiss: false,
            rtl: isRtl
            });
        @endif
        @if (session('toast-revert')) 
        // Success Type   
            toastr['success']
            ('<hr><div class="text-center"><form action="{{ route("admin.membership.user.revert",session("toast-revert")) }}" method="POST"> @csrf <label for="revert"> برگرداندن </label> <button id="revert" class="btn btn-sm btn-secondary text-white btn-icon" title="برگرداندن"><i class="bx bx-reset"></i></button></form></div>',
             ' مقدار مورد نظر حذف گردید', {
            closeButton: true,
            progressBar: true,
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut',
            // timeOut: 5000,
            tapToDismiss: false,
            rtl: isRtl
            }); 
        @endif

        // Info Type
        @if (session('toast-success'))
            typeInfo.on('click', function() {
            toastr['info']('{{ session('toast-info') }}', 'عملیات با موفقیت انجام شد!', {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
            });
            });
        @endif
        // Warning Type
        @if (session('toast-success'))
            typeWarning.on('click', function() {
            toastr['warning']('{{ session('toast-warning') }}', 'هشدار!', {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
            });
            });
        @endif
        // Error Type
        @if (session('toast-success'))
            typeError.on('click', function() {
            toastr['error']('{{ session('toast-error') }}', 'خطا!', {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
            });
            });
        @endif
    });
</script>  
