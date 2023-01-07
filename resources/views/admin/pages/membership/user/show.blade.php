@extends('admin.layouts.master')

@section('title','مشاهده کاربر')

@section('vendor-css')
    <!-- form-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/bs-stepper/bs-stepper.css') }}">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
        <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.membership.user.index') }}">فهرست کاربران</a></li>
        <li class="breadcrumb-item active">مشاهده کاربر</li>
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
                      </span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#personal-info">
                    <button type="button" class="step-trigger" aria-selected="false">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">اطلاعات شخصی</span>
                      </span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#avatar">
                    <button type="button" class="step-trigger" aria-selected="false">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">سازمان و آواتار</span>
                      </span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#roles">
                    <button type="button" class="step-trigger" aria-selected="false">
                        <span class="bs-stepper-circle">4</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">نقش ها و مجوز ها</span>
                      </span>
                    </button>
                </div>
            </div>

            <div class="bs-stepper-content">

                <!-- Account Details -->
                <div id="account-details" class="content active dstepper-block">
                    <div class="content-header mb-3">
                        <h6 class="mb-1">جزئیات حساب</h6>
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label" for="username">نام کاربری</label>
                            <input type="text" name="username" id="username" value="{{ $user->username ?? '' }}" class="form-control" disabled>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="email">ایمیل</label>
                            <input type="text" name="email" id="email" value="{{ $user->email ?? '' }}" class="form-control" disabled>
                        </div>

                        <div class="col-12 d-flex justify-content-between">
                            <button type="button" class="btn btn-label-secondary btn-prev" disabled>
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
                    </div>

                    <div class="row g-3">

                        <div class="col-sm-6">
                            <label class="form-label" for="first_name">نام</label>
                            <input type="text" name="first_name" id="first_name" value="{{ $user->first_name ?? '' }}" class="form-control" disabled>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="last_name">نام خانوادگی</label>
                            <input type="text" id="last_name" name="last_name" value="{{ $user->last_name ?? '' }}" class="form-control" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="sex_id" class="form-label">جنسیت</label>
                            <input type="text" name="sex_id" id="sex_id" class="form-control" value="{{ $user->sex->name ?? '' }}" disabled>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="mobile">موبایل</label>
                            <input type="text" name="mobile" id="mobile" value="{{ $user->mobile ?? '' }}" class="form-control" disabled>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="address">آدرس</label>
                            <input type="text" name="address" id="address" value="{{ $user->address ?? '' }}" class="form-control" disabled>
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
                    </div>

                    <div class="row g-3">
                        
                        <div class="col-md-6 mb-3">
                            <label for="organization_id" class="form-label">نام سازمان (جستجو بر اساس نام سازمان)</label>
                            <input type="text" name="organization_id" id="organization_id" value="{{ $user->organization->name ?? '' }}" class="form-control" disabled>
                        </div>

                        <div class="col-md-6 text-center">
                            <label class="form-label">آواتار</label>
                            <img src="{{ asset($user->avatar ? env('AVATAR_PATH').$user->avatar : env('AVATAR_MAN')) }}" alt="user-avatar" class="d-block mx-auto rounded" height="100" width="100" id="uploadedAvatar">
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

                <!-- Roles-->
                <div id="roles" class="content">
                    <div class="content-header mb-3">
                        <h6 class="mb-1">نقش ها و مجوز ها</h6>
                    </div>

                    <div class="row g-3">

                        <div class="col-12 d-flex justify-content-between" style="margin-top: 40px">
                            <button type="button" class="btn btn-primary btn-prev">
                                <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                <span class="d-sm-inline-block d-none">قبلی</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('vendor-js')
    <!-- form-->
    <script src="{{ asset('admin-assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('admin-assets/js/form-wizard-numbered.js') }}"></script>
@endsection