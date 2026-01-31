@extends('auth.wrapper')
@push('tittle')
<title>Login &mdash; BAN-PDM JATIM</title>
<meta property="og:title" content="Login" />
<!-- <meta property="og:type" content="video.movie" />  -->
<meta property="og:url" content="{{url()->current()}}" />
<meta property="og:image" content="/ban.png" />
<link rel="icon" type="image/x-icon" href="/ban.png">
@endpush
@section('form')
<section class="section">
    <div class="d-flex align-items-stretch flex-wrap">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
            <div class="m-3 p-4">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('loginError') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                
                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <img src="/ban.png" alt="logo" width="80"
                    class="shadow-light rounded-circle mb-5 mt-2">
                <h4 class="text-dark font-weight-normal">Selamat Datang Di <span class="font-weight-bold">BAN-PDM Provinsi Jawa Timur</span>
                </h4>
                <p class="text-muted"></p>
                <form method="POST" action="{{ route('authenticate') }}" class="needs-validation" novalidate="">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        @error('username')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" 
                               name="username" tabindex="1" value="{{ old('username') }}" required autofocus
                               placeholder="Masukkan username Anda">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                        </div>
                        @error('password')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                               name="password" tabindex="2" required placeholder="Masukkan password Anda">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>  
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                id="remember-me">
                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                        </div>
                    </div> 
                    <div class="form-group text-right">
                        <!-- <a href="auth-forgot-password.html" class="float-left mt-3">
                            Forgot Password?
                        </a>  -->
                        <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right"
                            tabindex="4">
                            Login
                        </button>
                    </div>
                </form>




            </div>
        </div>
        @include('auth.bg')
    </div>
</section>
@endsection

@push('jsform-custom')


@endpush