@extends('admin.layouts.master')

@section('title','مدیریت - داشبورد')

@section('content')

    {{-- breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
            {{-- <li class="breadcrumb-item active" aria-current="page">کاربران</li> --}}
        </ol>
    </nav>
    <div class="col-md-12 row">
        <div class="col-md-6 text-center">
            <form action="{{ route('admin.membership.image') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="button-wrapper">
                    <img src="{{ asset(env('AVATAR_MAN')) }}" alt="user-avatar" class="d-block mx-auto rounded mb-3"
                         height="400" width="400" id="uploadedAvatar">
                    <label for="upload" class="btn btn-lg btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">بارگذاری تصویر</span><i
                            class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" name="image" id="upload" class="account-file-input" hidden
                               accept="image/png, image/jpeg">
                    </label>
                    <button type="button" class="btn btn-lg btn-label-secondary account-image-reset mb-4"><i
                            class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">بازنشانی</span>
                    </button>
                </div>
                <div class="mb-1">
                    @error('avatar')
                    <span class="text-danger"> * {{ $message }}</span>
                    @enderror
                </div>
                <div class="row mt-3">
                    <div class="d-grid gap-2 col-lg-6 mx-auto">
                        <button class="btn btn-primary" type="submit">ذخیره تصویر</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-center">
            @if (session('msg'))
{{--                {{dd(implode(session('msg')))}}--}}
                @foreach(session('msg') as $param)
{{--                    {{dd($param[2])}}--}}
                    @if(!$param[1] )

{{--                    @foreach($param[0] as $color)--}}
                    <div class="mt-1" style="background-color:{{$param[0]}};">
                        {{$param[0]}}
                    </div>
{{--                    @endforeach--}}
                    @elseif($param[1] )
                        <div class="mt-5" style="background-color:white;">{{$param[1]}}</div>
                   @endif
                @endforeach
            @endif

        </div>
    </div>

@endsection


@section('vendor-js')
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
