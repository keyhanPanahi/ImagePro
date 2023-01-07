@extends('admin.layouts.master')

@section('title','ویرایش کاربر')

@section('vendor-css')
    <!-- form-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/bs-stepper/bs-stepper.css') }}">

    <!-- select2-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/select2/select2.css') }}">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
        <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.membership.user.index') }}">فهرست کاربران</a></li>
        <li class="breadcrumb-item active">ویرایش کاربر</li>
    </ol>
</nav>

<div class="row mt-3">
    <div class="col-12 mb-4">
        <div class="bs-stepper wizard-numbered mt-2">
            <div class="bs-stepper-header">
                <div class="step active" data-target="#account-details">
                    <button type="button" class="step-trigger" aria-selected="true">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">جزئیات حساب</span>
                        <span class="bs-stepper-subtitle">تنظیم جزئیات حساب</span>
                      </span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#personal-info">
                    <button type="button" class="step-trigger" aria-selected="false">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">اطلاعات شخصی</span>
                        <span class="bs-stepper-subtitle">افزودن اطلاعات شخصی</span>
                      </span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#avatar">
                    <button type="button" class="step-trigger" aria-selected="false">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">سازمان و آواتار</span>
                        <span class="bs-stepper-subtitle">افزودن سازمان و آواتار</span>
                      </span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#roles">
                    <button type="button" class="step-trigger" aria-selected="false">
                        <span class="bs-stepper-circle">4</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">نقش ها و مجوز ها</span>
                        <span class="bs-stepper-subtitle">افزودن نقش ها و مجوز ها</span>
                      </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <form action="{{ route('admin.membership.user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <!-- Account Details -->
                    <div id="account-details" class="content active dstepper-block">
                        <div class="content-header mb-3">
                            <h6 class="mb-1">جزئیات حساب</h6>
                            <small>جزئیات حساب وارد کنید.</small>
                        </div>
                        <div class="row g-3">

                            <div class="col-sm-6">
                                <label class="form-label" for="username">نام کاربری</label>
                                <input type="text" name="username" id="username" value="{{ old('username',$user->username) }}" class="form-control text-start" dir="ltr" placeholder="0640832145">
                                <div class="mt-1">
                                    @error('username')
                                    <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="email">ایمیل</label>
                                <input type="text" name="email" id="email" value="{{ old('email',$user->email) }}" class="form-control text-start" dir="ltr" placeholder="ahmad@gmail.com">
                                <div class="mt-1">
                                    @error('email')
                                    <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 form-password-toggle">
                                <label class="form-label" for="password">رمز عبور</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" name="password" id="password" class="form-control text-start" dir="ltr" placeholder="············">
                                    <span class="input-group-text cursor-pointer" id="password2"><i class="bx bx-hide"></i></span>
                                </div>
                                <div class="mt-1">
                                    @error('password')
                                    <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 form-password-toggle">
                                <label class="form-label" for="password_confirmation">تایید رمز عبور</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" name="password_confirmation" id="password_confirmation-password" class="form-control text-start" dir="ltr" placeholder="············" aria-describedby="confirm-password2">
                                    <span class="input-group-text cursor-pointer" id="confirm-password2"><i class="bx bx-hide"></i></span>
                                    <div class="mt-1">
                                        @error('password_confirmation')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
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
                            <h6 class="mb-1">اطلاعات شخصی</h6>
                            <small>اطلاعات شخصی را وارد کنید.</small>
                        </div>
                        <div class="row g-3">

                            <div class="col-sm-6">
                                <label class="form-label" for="first_name">نام</label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name',$user->first_name) }}" class="form-control" placeholder="محمد">
                                <div class="mt-1">
                                    @error('first_name')
                                    <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="last_name">نام خانوادگی</label>
                                <input type="text" id="last_name" name="last_name" value="{{ old('last_name',$user->last_name) }}" class="form-control" placeholder="خسروی">
                                <div class="mt-1">
                                    @error('last_name')
                                    <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="sex_id" class="form-label">جنسیت</label>
                                <select name="sex_id" id="sex_id" class="select2">
                                    @foreach ($sexes as $sex)
                                        <option value="{{ $sex->id }}" @if(old('sex_id',$user->sex_id) == $sex->id) selected @endif>{{ $sex->name }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-1">
                                    @error('sex_id')
                                        <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="mobile">موبایل</label>
                                <input type="text" name="mobile" id="mobile" value="{{ old('mobile',$user->mobile) }}" class="form-control" placeholder="09151234567">
                                <div class="mt-1">
                                    @error('mobile')
                                    <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="address">آدرس</label>
                                <input type="text" name="address" id="address" value="{{ old('address',$user->address) }}" class="form-control" placeholder="بیرجند، خیابان مدرس 13">
                                <div class="mt-1">
                                    @error('address')
                                    <span class="text-danger">* {{ $message }}</span>
                                    @enderror
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

                    <!-- Organizatin and Avatar-->
                    <div id="avatar" class="content">
                        <div class="content-header mb-3">
                            <h6 class="mb-1">سازمان و آواتار</h6>
                            <small>سازمان و آواتار را انتخاب کنید.</small>
                        </div>

                        <div class="row g-3">
                            
                            <div class="col-md-6 mb-3" data-select2-id="45">
                                <label for="organization_id" class="form-label">نام سازمان (جستجو بر اساس نام سازمان)</label>
                                <div class="position-relative" data-select2-id="44">
                                    @php
                                        $organization = \App\Models\Membership\Organization::select('id','name')->where('id',old('organization_id',$user->organization_id))->first();
                                    @endphp
                                    <select name="organization_id" id="organization_id" class="select2 form-select form-select-lg " data-allow-clear="true" data-select2-id="select2Basic" tabindex="-1" aria-hidden="true">
                                        @if (old('organization_id')) <option value="{{ $organization->id }}" selected>{{ $organization->name }}</option>
                                        @else <option value="{{ $organization->id }}" selected>{{ $organization->name }}</option> @endif
                                    </select>
                                </div>
                                <div class="mt-1">
                                    @error('organization_id')
                                    <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 text-center">
                                <img src="{{ asset($user->avatar ? env('AVATAR_PATH').$user->avatar : env('AVATAR_MAN')) }}" alt="user-avatar" class="d-block mx-auto rounded mb-3" height="100" width="100" id="uploadedAvatar">
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-sm btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">بارگذاری تصویر</span><i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" name="avatar" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg">
                                    </label>
                                    <button type="button" class="btn btn-sm btn-label-secondary account-image-reset mb-4"><i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">بازنشانی</span>
                                    </button> 
                                </div>
                                <div class="mb-1">
                                    @error('avatar')
                                    <span class="text-danger"> * {{ $message }}</span>
                                    @enderror
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

                    <div id="roles" class="content">
                        <div class="content-header mb-3">
                            <h6 class="mb-1">نقش ها و مجوز ها</h6>
                            <small>نقش ها و دسترسی های کاربر را انتخاب کنید.</small>
                        </div>
                        <div class="row g-3">
                            @foreach ($role->children as $key => $child)
                            <div class="col-md-3 col-6">
                                <label class="form-check-label d-inline" for="{{ $child->id }}">{{ $child->title }}</label>
                                <input type="checkbox" class="form-check-input" name="role[]" id="{{ $child->id }}" value="{{ $child->id }}"
                                @if(is_array(old('role')) && in_array($child->id, old('role'))) checked @endif
                                @if (in_array($child->id, $user->roles->pluck('id')->toArray()))
                                    checked
                                @endif>
                                <div class="mt-2">
                                @error('role.'.$key)
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                                </div>
                            </div>
                            @endforeach
                            <div class="col-12 d-flex justify-content-between" style="margin-top: 40px">
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
    <!-- select2 -->
    <script src="{{ asset('admin-assets/js/forms-selects.js') }}"></script>

    <!-- select2 select organization ajax-->
    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $( "#organization_id" ).select2({
                placeholder: 'سازمان را انتخاب کنید',
                ajax: {
                    url: "{{ route('admin.select.selectOrganization') }}",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term
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

    <!-- Avatar -->
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