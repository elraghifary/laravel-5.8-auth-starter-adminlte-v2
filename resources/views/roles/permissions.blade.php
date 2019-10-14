@extends('layouts.main')

@section('title')
    <title>{{ env('APP_NAME') }} - Set Role Permission</title>
@endsection

@section('content')
    <section class="content-header">
        <h1>Set Role Permission</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('role.index') }}"><i class="fa fa-file-text"></i> Role</a></li>
            <li class="active">Set Role Permission</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        {!! session('success') !!}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        {!! session('error') !!}
                    </div>
                @endif
                <div class="box">
                    <div class="box-body">
                        <form role="form" id="form-set-role-permission" action="{{ route('role.set_permission', $role->name) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" name="role" id="role" class="form-control" value="{{ $role->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="permission">Permission</label>
                                @php $no = 1; @endphp
                                @foreach ($permissions as $permission)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" 
                                                name="permission[]" 
                                                value="{{ $permission }}" {{ in_array($permission, $hasPermission) ? 'checked' : '' }}
                                                > {{ $permission }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <button class="btn btn-primary">Set Permission</button>
                            <a href="{{ route('role.index') }}" class="btn btn-default">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
