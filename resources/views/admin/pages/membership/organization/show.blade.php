@extends('admin.layouts.master')
@section('title', 'مدیریت - مشاهده سازمان')


@section('vendor-css')
    <!-- form-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/bs-stepper/bs-stepper.css') }}"> 
    <!-- select2-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/select2/select2.css') }}">
@endsection

@section('content') 
{{-- breadcrumb --}}
<nav aria-label="breadcrumb mb-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
      <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.membership.organization.index') }}">فهرست سازمان ها</a></li>
      <li class="breadcrumb-item active" aria-current="page">مشاهده سازمان {{ $organization->name }}</li>
    </ol>
</nav>

    <div class="row mt-3">
        <div class="col-12 mb-4">
            {{-- <a href="{{ route('admin.organization.index') }}" class="btn btn-primary mb-2"><i class="bx bx-arrow-from-left"></i> بازگشت</a> --}}
            <div class="bs-stepper wizard-numbered mt-2">
                <div class="bs-stepper-header">
                    <div class="step active" data-target="#account-details">
                        <button type="button" class="step-trigger" aria-selected="true">
                            <span class="bs-stepper-circle">1</span>
                            <span class="bs-stepper-label">
                            <span class="bs-stepper-title">جزئیات سازمان</span>
                            <span class="bs-stepper-subtitle">تنظیم جزئیات سازمان</span>
                          </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#personal-info">
                        <button type="button" class="step-trigger" aria-selected="false">
                            <span class="bs-stepper-circle">2</span>
                            <span class="bs-stepper-label">
                            <span class="bs-stepper-title">اطلاعات تماس</span>
                            <span class="bs-stepper-subtitle">ایجاد اطلاعات تماس سازمان</span>
                          </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#avatar">
                        <button type="button" class="step-trigger" aria-selected="false">
                            <span class="bs-stepper-circle">3</span>
                            <span class="bs-stepper-label">
                            <span class="bs-stepper-title">مدیر و لوگوی سازمان</span>
                            <span class="bs-stepper-subtitle">ایجاد مدیر و لوگوی سازمان</span>
                          </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#role-info">
                       <button type="button" class="step-trigger">
                       <span class="bs-stepper-circle">4</span>
                       <span class="bs-stepper-label">
                       <span class="bs-stepper-title">نقش ها</span>
                       <span class="bs-stepper-subtitle">ایجاد نقش ها</span>
                       </span>
                       </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <form action="{{ route('admin.membership.organization.update',$organization->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Account Details -->
                        <div id="account-details" class="content active dstepper-block">
                            <div class="content-header mb-3">
                                <h6 class="mb-1">جزئیات سازمان</h6> 
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="name">نام سازمان</label>
                                    <input type="text" name="name" id="name" value="{{ old('name',$organization->name) }}" class="form-control text-start"  placeholder="امور شعب بانک ملی" disabled>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="national_code">کد سازمان</label>
                                    <input type="text" name="national_code" id="national_code" value="{{ old('national_code',$organization->national_code) }}" class="form-control text-start"  placeholder="0245633285" disabled>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="parent_id" class="form-label">سازمان والد</label>
                                    <div class="position-relative"">  
                                        <select id='parent_id' class="select2" name="parent_id" disabled> 
                                            <option selected>{{ $organization->parent_id == 0 ? 'بدون والد' : $organization->parent->name }}</option> 
                                        </select>                 
                                     </div> 
                                </div>
                                <div class="col-sm-6 form-password-toggle"> 
                                    <label for="parent_id" class="form-label">وابستگی به ارگان والد</label>
                                    <select id="inderpent" name="inderpent" class="form-select select2" disabled> 
                                        <option selected>{{$organization->inderpent == 1 ? 'وابسته' : 'مستقل'}}</option> 
                                    </select>   
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button type="button" class="btn btn-label-secondary btn-prev" disabled="">
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="d-sm-inline-block d-none">قبلی</span>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-next">
                                        <span class="d-sm-inline-block d-none">بعدی</span>
                                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Info -->
                        <div id="personal-info" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-1">اطلاعات تماس</h6> 
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="email">ایمیل</label>
                                    <input type="text" name="email" id="email" value="{{ old('email',$organization->email) }}" class="form-control" placeholder="meli-bank@gmail.com" disabled>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="phone">تلفن</label>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone',$organization->phone) }}" class="form-control" placeholder="با کد منطقه" disabled>
                               </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="fax">فکس (دورنگار)</label>
                                    <input type="text" name="fax" id="fax" value="{{ old('fax',$organization->fax) }}" class="form-control" placeholder="با کد منطقه" disabled>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="website">وبسایت</label>
                                    <input type="text" name="website" id="website" value="{{ old('address',$organization->address) }}" class="form-control" placeholder="www.bmi.ir" disabled>
                                </div>
                                <div class="col-sm-12">
                                    <label class="form-label" for="address">آدرس</label>
                                    <textarea name="address" id="address" rows="3" class="form-control" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 107px;"
                                              placeholder="بیرجند، خیابان غفاری ، میدان دانشگاه آزاد" disabled>{{ old('address',$organization->address) }}</textarea>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button type="button" class="btn btn-primary btn-prev">
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="d-sm-inline-block d-none">قبلی</span>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-next">
                                        <span class="d-sm-inline-block d-none">بعدی</span>
                                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Organizatin and Avatar-->
                        <div id="avatar" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-1">مدیر و لوگو سازمان</h6> 
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6 mt-5">
                                    <label for="manager_id" class="form-label">نام مدیر سازمان</label>
                                    <div class="position-relative">  
                                        <select id='manager_id' name="manager_id" style='width: 200px;' disabled> 
                                            @if ($organization->manager)
                                                <option selected>{{ $organization->manager->full_name. ' - ' . $organization->manager->username }}</option> 
                                            @else 
                                            <option selected> بدون مدیر </option>
                                            @endif
                                        </select>                 
                                     </div>
                                    </div>
                                <div class="col-md-6 mb-4 text-center">
                                    <div class="button-wrapper">      
                                        <div class="mb-2">
                                            <img src="{{ $organization->logo ? asset(env('AVATAR_PATH').$organization->logo) : asset(env('AVATAR_ORG'))}}"  alt="user-avatar" class="d-block rounded mx-auto" height="150" width="150" id="uploadedAvatar">
                                        </div>          
                                    </div>
                                 </div> 
                                
                                <div class="col-12 d-flex justify-content-between">
                                    <button type="button" class="btn btn-primary btn-prev">
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="d-sm-inline-block d-none">قبلی</span>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-next">
                                        <span class="d-sm-inline-block d-none">بعدی</span>
                                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
 
                        <!-- role -->
                        <div id="role-info" class="content">
                            <div class="content-header mb-3">
                            <h6 class="mb-1">نقش  ها  </h6>
                            </div>
                            <div class="row g-3">
                            <div class="row row-bordered g-0">
                                <div class="col-md p-3">
                                    @foreach ($organizationRoles->children as $role)
                                    <div class="form-check form-check-info">
                                        <input class="form-check-input" type="checkbox" disabled
                                        @if (in_array($role->id, $organization->roles->pluck('id')->toArray()))
                                            checked
                                        @endif> 
                                        <label class="form-check-label" for="{{ $role->id }}"> {{ $role->title }} </label>
                                    </div>
                                    @endforeach 
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button type="button" class="btn btn-primary btn-prev">
                                <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                <span class="d-sm-inline-block d-none">قبلی</span>
                                </button>
                                <button type="submit" class="btn btn-success">ثبت</button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-js')
    <!-- form-->
    <script src="{{ asset('admin-assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('admin-assets/js/form-wizard-numbered.js') }}"></script> 

    <!-- select2-->
    <script src="{{ asset('admin-assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/select2/i18n/fa.js') }}"></script>
@endsection

@section('page-js')
    <!-- select2  ORGANIZATIONS-->
    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){ 
          $( "#parent_id" ).select2({ 
            placeholder: "سازمان والد را انتخاب کنید",
             ajax: { 
               url: "{{route('admin.select.selectOrganization')}}",
               type: "post",
               dataType: 'json',
               delay: 250,
               data: function (params) {
                 return {
                    _token: CSRF_TOKEN,
                    search: params.term // search term
                 };
               },
               processResults: function (response) {
                 return {
                   results: response
                 };
               },
               cache: true
             }    
            
          }); 
       });  
    </script>
    
    <!-- select2 USERS-->
    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
          $( "#manager_id" ).select2({ 
            placeholder: "مدیر سازمان را انتخاب کنید", 
             ajax: { 
               url: "{{route('admin.select.selectUser')}}",
               type: "post",
               dataType: 'json',
               delay: 250,
               data: function (params) {
                 return {
                    _token: CSRF_TOKEN,
                    search: params.term // search term
                 };
               },
               processResults: function (response) {
                 return {
                   results: response
                 };
               },
               cache: true
             }
     
          });
     
       });
    </script>

    {{-- select 2 inputs --}}
    <script>
        $(function() {
            const select2 = $('#select2');
            // Default
            if (select2.length) {
                select2.each(function() {
                    var $this = $(this);
                    $this.wrap('<div class="position-relative"></div>').select2({
                        // placeholder: 'انتخاب',
                        placeholder: " انتخاب کنید",
                        dropdownParent: $this.parent()
                    });
                });
            }
        });
    </script>

    {{-- avatar --}}
    <script>  
        document.addEventListener('DOMContentLoaded', function (e) {
          (function () { 
            // Update/reset user image of account page
            let accountUserImage = document.getElementById('uploadedAvatar');
            const fileInput = document.querySelector('.account-file-input'),
              resetFileInput = document.querySelector('.account-image-reset');
        
            if (accountUserImage) {
              const resetImage = accountUserImage.src;
              fileInput.onchange = () => {
                if (fileInput.files[0]) {
                  accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
                }
              };
              resetFileInput.onclick = () => {
                fileInput.value = '';
                accountUserImage.src = resetImage;
              };
            }
          })();
        }); 
    </script>  
@endsection