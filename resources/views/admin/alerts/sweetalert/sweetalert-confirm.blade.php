<script> 
    $(function () {
        'use strict'; 
     
        var deleteConfirm = $('.delete-confirm');
        var active = $('#active');
        var deactive = $('#deactive');
     
        //--------------- Confirm Options ---------------
       
        //delete confirm
        if (deleteConfirm.length) {
            deleteConfirm.on('click', function () {
                Swal.fire({
                    title: 'آیا از حذف موارد انتخابی مطمئن هستید؟',
                    text: "شما میتوانید درخواست خود را لغو نمایید",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله حذف شود.',
                    cancelButtonText: 'خیر درخواست لغو شود.',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-outline-danger ms-1'
                    },
                buttonsStyling: false
                }).then((result) => { 
                if (result.value == true) {
                    $('#form').submit();
                } 
                else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'لغو درخواست',
                        text: "درخواست شما لغو شد.",
                        icon: 'error', 
                        confirmButtonText: 'تایید.',
                        customClass: {
                        confirmButton: 'btn btn-success', 
                        }
                    });
                    }
                });
            });
        }
        
        //avtive confirm
        if (active.length) {
            active.on('click', function () {
                Swal.fire({
                    title: 'آیا از فعالسازی موارد انتخابی مطمئن هستید؟',
                    text: "شما میتوانید درخواست خود را لغو نمایید",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله فعال شود.',
                    cancelButtonText: 'خیر درخواست لغو شود.',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-outline-danger ms-1'
                    },
                buttonsStyling: false
                }).then((result) => { 
                if (result.value == true) {
                    let form = document.getElementById('form');
                    form.action = this.value;
                    document.getElementById('status').value = 1;
                    form.submit();
                } 
                else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'لغو درخواست',
                        text: "درخواست شما لغو شد.",
                        icon: 'error', 
                        confirmButtonText: 'تایید.',
                        customClass: {
                        confirmButton: 'btn btn-success', 
                        }
                    });
                    }
                });
            });
        }


        //deactive confirm
        if (deactive.length) {
            deactive.on('click', function () {
                Swal.fire({
                    title: 'آیا از غیرفعالسازی موارد انتخابی مطمئن هستید؟',
                    text: "شما میتوانید درخواست خود را لغو نمایید",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله غیرفعال شود.',
                    cancelButtonText: 'خیر درخواست لغو شود.',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-outline-danger ms-1'
                    },
                buttonsStyling: false
                }).then((result) => { 
                if (result.value == true) {
                    let form = document.getElementById('form');
                    form.action = this.value;
                    document.getElementById('status').value = 0;
                    form.submit();
                } 
                else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'لغو درخواست',
                        text: "درخواست شما لغو شد.",
                        icon: 'error', 
                        confirmButtonText: 'تایید.',
                        customClass: {
                        confirmButton: 'btn btn-success', 
                        }
                    });
                    }
                });
            });
        }
    });
</script>

