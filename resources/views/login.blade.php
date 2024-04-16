@extends('auth.wrapper')
@push('tittle')
<title>Login &mdash; BAN-S/M JATIM</title>
<meta property="og:title" content="Login" />
{{-- <meta property="og:type" content="video.movie" /> --}}
<meta property="og:url" content="{{url()->current()}}" />
<meta property="og:image" content="/ban.png" />
<link rel="icon" type="image/x-icon" href="/ban.png">
@endpush
@section('form')
<section class="section">
    <div class="d-flex align-items-stretch flex-wrap">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
            <div class="m-3 p-4">
               {{-- @if(session()->has('success'))
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissable fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <img src="/ban.png" alt="logo" width="80"
                    class="shadow-light rounded-circle mb-5 mt-2">
                <h4 class="text-dark font-weight-normal">Selamat Datang Di <span class="font-weight-bold">BAN-S/M Provinsi Jawa Timur</span>
                </h4>
                <p class="text-muted"></p>
                <form method="post" action="/login" class="needs-validation" novalidate="">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="invalid-feedback">
                            Please fill in your email
                        </div>
                        <input id="username" type="email" class="form-control" name="username" tabindex="1"
                        value="{{ old('username') }}"    required autofocus>
                        
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                        </div>
                        <input id="password" type="password" class="form-control" name="password"
                            tabindex="2" required>
                        <div class="invalid-feedback">
                            please fill in your password
                        </div>
                    </div>

                     <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                id="remember-me">
                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                        </div>
                    </div> 
                    <div class="form-group text-right">
                        <a href="auth-forgot-password.html" class="float-left mt-3">
                            Forgot Password?
                        </a> 
                        <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right"
                            tabindex="4">
                            Login
                        </button>
                    </div>
                </form>--}}




<p>Join Group Telegram <a href="https://t.me/+4WYclCeQ_DQwYTVl">https://t.me/+4WYclCeQ_DQwYTVl</a>

Link Sispena <a href="https://bansm.kemdikbud.go.id/sispena2020/login"> https://bansm.kemdikbud.go.id/sispena2020/login </a> 

Petunjuk Pengajuan
<a href="https://youtu.be/NjhrwYBsWx0">https://youtu.be/NjhrwYBsWx0</a>


Tips Unggah Dokumen
<a href="https://www.youtube.com/watch?v=4ln-LiEdrko">https://www.youtube.com/watch?v=4ln-LiEdrko</a>



Petunjuk Pengisian DIA
<a href="https://www.youtube.com/watch?v=Q0ZhM3tQraE&t=220s">https://www.youtube.com/watch?v=Q0ZhM3tQraE&t=220s</a>
</p>


            </div>
        </div>
        @include('auth.bg')
    </div>
</section>
@endsection

@push('jsform-custom')


@endpush