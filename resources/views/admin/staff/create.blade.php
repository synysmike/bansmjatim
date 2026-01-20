@extends('ad_layout.wrapper')

@section('admin-container')
    <section>
        <div class="section-header">
            <h1>{{ $tittle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.staff.index') }}">Staff</a></div>
                <div class="breadcrumb-item">{{ $tittle }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create New Staff</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                               name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Unit</label>
                                    <div class="col-sm-9">
                                        <select class="form-control @error('unit') is-invalid @enderror" 
                                                name="unit">
                                            <option value="">-- Select Unit --</option>
                                            <option value="Ketua" {{ old('unit') == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                                            <option value="Sekretaris" {{ old('unit') == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                                            <option value="Anggota" {{ old('unit') == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                                            <option value="KPKK" {{ old('unit') == 'KPKK' ? 'selected' : '' }}>KPKK</option>
                                            <option value="Staff Administrasi" {{ old('unit') == 'Staff Administrasi' ? 'selected' : '' }}>Staff Administrasi</option>
                                            <option value="Staff Keuangan" {{ old('unit') == 'Staff Keuangan' ? 'selected' : '' }}>Staff Keuangan</option>
                                            <option value="Staff Data dan IT" {{ old('unit') == 'Staff Data dan IT' ? 'selected' : '' }}>Staff Data dan IT</option>
                                        </select>
                                        @error('unit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Photo</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                                               name="photo" accept="image/*">
                                        <small class="form-text text-muted">Max size: 2MB, Formats: jpeg, png, jpg, gif</small>
                                        @error('photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-primary">Save Staff</button>
                                        <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
