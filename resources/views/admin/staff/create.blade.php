@extends('ad_layout.wrapper')

@section('admin-container')
    <!-- Section Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-ubuntu font-bold text-admin-text-primary mb-2">{{ $tittle }}</h1>
        <nav class="flex items-center space-x-2 text-sm text-admin-text-secondary">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-admin-primary transition-colors">Dashboard</a>
            <span>/</span>
            <a href="{{ route('admin.staff.index') }}" class="hover:text-admin-primary transition-colors">Staff</a>
            <span>/</span>
            <span class="text-admin-primary font-medium">{{ $tittle }}</span>
        </nav>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-2xl shadow-admin overflow-hidden">
        <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
            <h2 class="text-xl font-semibold text-white">Create New Staff</h2>
        </div>
        <div class="p-6">
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700">
                    <p class="font-semibold mb-2">Please fix the following errors:</p>
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label for="nama" class="form-label">Nama <span class="text-red-500">*</span></label>
                    <input type="text" id="nama" name="nama" class="form-input" value="{{ old('nama') }}" required placeholder="Nama lengkap">
                </div>

                <div class="mb-6">
                    <label for="unit" class="form-label">Unit</label>
                    <select id="unit" name="unit" class="form-select">
                        <option value="">-- Select Unit --</option>
                        <option value="Ketua" {{ old('unit') == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                        <option value="Sekretaris" {{ old('unit') == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                        <option value="Anggota" {{ old('unit') == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                        <option value="KPKK" {{ old('unit') == 'KPKK' ? 'selected' : '' }}>KPKK</option>
                        <option value="Staff Administrasi" {{ old('unit') == 'Staff Administrasi' ? 'selected' : '' }}>Staff Administrasi</option>
                        <option value="Staff Keuangan" {{ old('unit') == 'Staff Keuangan' ? 'selected' : '' }}>Staff Keuangan</option>
                        <option value="Staff Data dan IT" {{ old('unit') == 'Staff Data dan IT' ? 'selected' : '' }}>Staff Data dan IT</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" id="photo" name="photo" class="form-input" accept="image/*">
                    <p class="text-sm text-admin-text-secondary mt-1">Max size: 2MB. Formats: jpeg, png, jpg, gif</p>
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-admin-border">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save admin-icon mr-2"></i>Save Staff
                    </button>
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
