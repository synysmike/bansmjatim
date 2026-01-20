@extends('ad_layout.wrapper')

@section('admin-container')
    <section>
        <div class="section-header">
            <h1>{{ $tittle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">{{ $tittle }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <!-- Welcome Card -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Welcome, {{ $user->name ?? 'Super Admin' }}!</h4>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">Manage all aspects of the website from this dashboard.</p>
                        </div>
                    </div>
                </div>

                <!-- Home Page Management -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Home Page</h4>
                            </div>
                            <div class="card-body">
                                Manage Content
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.home.index') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-arrow-right"></i> Manage
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Berita Management -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Berita</h4>
                            </div>
                            <div class="card-body">
                                Manage News
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-success btn-block">
                                <i class="fas fa-arrow-right"></i> Manage
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Staff/Sekretariat Management -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Staff</h4>
                            </div>
                            <div class="card-body">
                                Manage Staff
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.staff.index') }}" class="btn btn-info btn-block">
                                <i class="fas fa-arrow-right"></i> Manage
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Config Management -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Config</h4>
                            </div>
                            <div class="card-body">
                                Manage Config
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.config.index') }}" class="btn btn-warning btn-block">
                                <i class="fas fa-arrow-right"></i> Manage
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Quick Access</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{ route('admin.home.index') }}" class="btn btn-outline-primary btn-lg btn-block mb-3">
                                        <i class="fas fa-home"></i><br>
                                        Home Page Content
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-success btn-lg btn-block mb-3">
                                        <i class="fas fa-newspaper"></i><br>
                                        Berita Management
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('admin.staff.index') }}" class="btn btn-outline-info btn-lg btn-block mb-3">
                                        <i class="fas fa-users"></i><br>
                                        Staff Management
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('admin.config.index') }}" class="btn btn-outline-warning btn-lg btn-block mb-3">
                                        <i class="fas fa-cog"></i><br>
                                        Configuration
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
