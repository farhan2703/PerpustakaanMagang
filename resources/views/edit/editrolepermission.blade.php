<!DOCTYPE html>
<html lang="en">

<head>
    @include('templatemember.header')
</head>

<body>

<header id="header" class="header fixed-top d-flex align-items-center">
    @include('templatemember.headerbody')
</header>

<aside id="sidebar" class="sidebar">
    @include('templatemember.sidebar')
</aside>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Role</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Role</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('role.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name" class="text-label">Role Name *</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-tag"></i> </span>
                            </div>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name) }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="guard_name" class="text-label">Guard Name *</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-shield"></i> </span>
                            </div>
                            <input type="text" class="form-control" id="guard_name" name="guard_name" value="{{ old('guard_name', $role->guard_name) }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-label">Permissions *</label>
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $permission->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Role</button>
                        <button type="button" class="btn btn-light" onclick="window.location='{{ route('halaman.role') }}'">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

@include('templatemember.scripts')

</body>
</html>
