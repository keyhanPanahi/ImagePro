@extends('admin.layouts.master')

@section('title','مدیریت - فهرست سازمان ها')

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}"> 
<link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">  
@endsection

@section('content')

{{-- breadcrumb --}}
<nav aria-label="breadcrumb mb-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
      <li class="breadcrumb-item active" aria-current="page">فهرست سازمان ها</li>
    </ol>
</nav>

<form action="{{ route('admin.membership.organization.destroy') }}" id="form" method="POST">
   @csrf 
   <input type="hidden" name="status" id="status"> 

   <div class="d-flex justify-content-between bd-highlight">
      <div class="p-2 bd-highlight">  
         <!-- Organization List Table --> 
         <a class="dt-button add-new btn btn-primary text-white" href="{{ route('admin.membership.organization.create') }}">
            <span> <i class="bx bx-plus me-0"></i> 
            ایجاد  
            </span> 
         </a> 
      </div>
      <div class="p-2 bd-highlight"> 
      </div>
      <div class="p-2 bd-highlight"> 
         <button type="button" class="btn btn-label-danger delete-confirm float-end ms-2"  data-bs-toggle="tooltip"  data-bs-placement="top" data-color="danger" title="حذف">
            <i class="tf-icons bx bx-trash"></i> 
         </button>
         <button type="button" class="btn btn-label-secondary float-end  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bx bx-toggle-right"></i>
         </button>
         <ul class="dropdown-menu">
            <li><button type="button" value="{{ route('admin.membership.organization.status') }}" class="dropdown-item" id="active">فعالسازی</button></li>
            <li><button type="button" value="{{ route('admin.membership.organization.status') }}" class="dropdown-item" id="deactive">غیرفعالسازی</button></li>
         </ul>
      </div>
   </div> 
   <div class="card mt-3">
      <div class="card-datatable table-responsive">
         <table class="table table-hover text-center" id="getOrganizations">
            <thead>
               <tr> 
                  <th>لوگو</th> 
                  <th>نام سازمان</th> 
                  <th>مدیر سازمان</th>
                  <th>سازمان والد</th> 
                  <th>وضعیت</th>
                  <th>عملیات</th> 
                  <th>
                     <label class="form-check-label m-1" for="checkAll">
                        <input class="form-check-input" type="checkbox" id="checkAll" data-bs-toggle="tooltip"  data-bs-placement="top" data-color="primary" title="انتخاب همه">
                     </label>
                  </th>
               </tr>
            </thead>
         </table>
      </div>
   </div>
</form>
@endsection
 

@section('vendor-js')
    <script src="{{ asset('admin-assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script> 
    <script src="{{ asset('admin-assets/vendor/libs/datatables/i18n/fa.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
@endsection

@section('page-js') 
{{-- organization datatable --}}
<script>
   var oTable = $('#getOrganizations').DataTable({ 
       "columnDefs": [
         { "orderable": false, "targets": [6]  },  
      ],
       pageLength: 10,
       processing: true,
       serverSide: true,
      //  responsive: true,
       ajax: "{{ route('admin.membership.organization.index') }}",
       columns: [ 
           { data: 'logo', name: 'logo'}, 
           { data: 'name', name: 'name'}, 
           { data: 'manager_id', name: 'manager_id'}, 
           { data: 'parent_id', name: 'parent_id'}, 
           { data: 'status', name: 'status'}, 
           { data: 'action', name: 'action'}, 
           { data: 'select', name: 'select'}, 
       ],
   });
</script>  

<!-- check all-->
<script>
   $(document).ready(function() {
       $('#checkAll').click(function(event) {  
           if(this.checked) { 
               $('.checkbox').each(function() { 
                   this.checked = true;     
               });
           }
           else{
               $('.checkbox').each(function() {
                   this.checked = false; 
               });        
           }
       }); 
   });
</script> 
@endsection