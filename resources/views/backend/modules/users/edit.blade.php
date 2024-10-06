@extends('backend.layouts.base')
@section('title', 'Edit User | Admin')

@section('content')

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-10 d-flex justify-content-lg-start justify-content-center">
                            <div class="page-breadcrumb d-flex d-sm-flex align-items-center mb-2">
                                <div class="breadcrumb-title pe-3">Edit User</div>
                                <div class="ps-3">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0 p-0">
                                            <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a></li>
                                            <li class="breadcrumb-item" aria-current="page"><a href="/admin/users">Users</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Edit User</h5>
                    <form class="row g-3" action="{{ route('users.update', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Full Name" value="{{ old('name', $user->name) }}">
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Enter Username" value="{{ old('username', $user->username) }}">
                            <p class="text-danger">{{ $errors->first('username') }}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ old('email', $user->email) }}">
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password (Leave empty to keep current password)</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password">
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center justify-content-end gap-3">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary px-4">Cancel</a>
                                <button type="submit" class="btn btn-primary px-4">Update User</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
</div>

@endsection
