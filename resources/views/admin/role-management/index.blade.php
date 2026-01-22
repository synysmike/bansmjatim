@extends('ad_layout.wrapper')

@section('admin-container')
    <section>
        <div class="section-header">
            <h1>{{ $tittle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">{{ $tittle }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <!-- Welcome Card -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Welcome, {{ $user->name ?? 'Admin' }}!</h4>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">Manage users, roles, and permissions from this dashboard.</p>
                        </div>
                    </div>
                </div>

                <!-- Users Management -->
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-wrap">
                            <div class="card-header">
                                <i class="fas fa-users me-2"></i>
                                <h4 class="mb-0">Users</h4>
                            </div>
                            <div class="card-body">
                                {{ $usersCount }}
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.role-management.users') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-arrow-right"></i> Manage Users
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Roles Management -->
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-wrap">
                            <div class="card-header">
                                <i class="fas fa-user-tag me-2"></i>
                                <h4 class="mb-0">Roles</h4>
                            </div>
                            <div class="card-body">
                                {{ $rolesCount }}
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.role-management.roles') }}" class="btn btn-success btn-block">
                                <i class="fas fa-arrow-right"></i> Manage Roles
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Permissions Management -->
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-wrap">
                            <div class="card-header">
                                <i class="fas fa-key me-2"></i>
                                <h4 class="mb-0">Permissions</h4>
                            </div>
                            <div class="card-body">
                                {{ $permissionsCount }}
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.role-management.permissions') }}" class="btn btn-info btn-block">
                                <i class="fas fa-arrow-right"></i> Manage Permissions
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Access -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Quick Access</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('admin.role-management.users') }}" class="btn btn-outline-primary btn-lg btn-block mb-3">
                                        <i class="fas fa-users"></i><br>
                                        User Management
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('admin.role-management.roles') }}" class="btn btn-outline-success btn-lg btn-block mb-3">
                                        <i class="fas fa-user-tag"></i><br>
                                        Role Management
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('admin.role-management.permissions') }}" class="btn btn-outline-info btn-lg btn-block mb-3">
                                        <i class="fas fa-key"></i><br>
                                        Permission Management
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
