@extends('auth.layouts.master')

@section('title')
    <title>ورود</title>
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="#" class="app-brand-link gap-2">
                                <h4 class="mt-2 fw-bold">فاوا گستر سپهر</h4>
                                {{-- <img src="{{ asset(env('AVATAR_FAVA')) }}" alt="" width="75" height="50"> --}}
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">خوش آمدید! 👋</h4>
                        <p class="mb-4">لطفا نام کاربری و رمز عبور خود را وارد کنید.</p>
                        <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">نام کاربری</label>
                                <input type="text" class="form-control text-start" dir="ltr" id="username" name="username" value="{{ old('username') }}" placeholder="نام کاربری خود را وارد کنید" autofocus>
                                @error('username')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">رمز عبور</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control text-start" dir="ltr" name="password" placeholder="············" aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">بخاطر بسپار.</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">ورود</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection