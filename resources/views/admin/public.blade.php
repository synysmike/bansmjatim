@extends('ad_layout.wrapper')

@section('admin-container')
    <div class="mb-8">
        <h1 class="text-4xl font-ubuntu font-bold text-admin-text-primary mb-2">{{ $tittle ?? 'Public Page' }}</h1>
        <nav class="flex items-center space-x-2 text-sm text-admin-text-secondary">
            <span class="text-admin-primary font-medium">{{ $tittle ?? 'Public Page' }}</span>
        </nav>
    </div>

    <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
        <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
            <h2 class="text-xl font-semibold text-white">Welcome</h2>
        </div>
        <div class="p-6">
            <p class="text-admin-text-primary mb-4">This page uses the admin layout and does not require login to access.</p>
            <a href="{{ route('login') }}" class="inline-flex items-center space-x-2 btn btn-primary">
                <i class="fas fa-sign-in-alt admin-icon"></i>
                <span>Go to Login</span>
            </a>
        </div>
    </div>
@endsection
