@extends('layouts.main')

@section('title')
    <title>{{ env('APP_NAME') }} - Set User Role</title>
@endsection

@section('content')
    <section class="content-header">
        <h1>Set User Role</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('user.index') }}"><i class="fa fa-user"></i> User</a></li>
            <li class="active">Set User Role</li>
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
                <div class="box">
                    <div class="box-body">
                        <form role="form" id="form-set-user-role" action="{{ route('user.set_role', $user->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                @foreach ($roles as $row)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="role[]" {{ $user->hasRole($row) ? 'checked':'' }} value="{{ $row }}">{{ $row }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Set Role</button>
                                <a href="{{ route('user.index') }}" class="btn btn-default">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $("#form-set-user-role").submit(function(event) {
                var length = $("input[name*='role']:checked").length;

                if (length <=0)  {
                    alert("Please check at least 1 role.");
                    return false;
                } else {
                    return true;
                }
            });
        });
    </script>
@endpush