@extends('layouts.main')

@section('title')
    <title>{{ env('APP_NAME') }} - User Management</title>
@endsection

@section('content')
    <section class="content-header">
        <h1>Users</h1>
        <ol class="breadcrumb">
            <li class="active"><a href="{{ route('user.index') }}"><i class="fa fa-user"></i> User</a></li>
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
                        <a type="button" class="btn btn-primary" href="{{ route('user.create') }}" id="btn-add"><i class="fa fa-plus"></i> Add User</a>
                        <br><br>
                        <div class="table-responsive">
                            <table id="user" class="responsive nowrap table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th style="width: 5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            var table = $('#user').DataTable({
                ajax: {
                    url: '{{ route('user.getData') }}'
                },
                columnDefs: [
                    {
                        "render": function(data, type, row) {
                            if (data) {
                                return '<span class="label label-success">Active</span>';
                            } else {
                                return '<span class="label label-warning">Inactive</span>';
                            }
                        },
                        "targets": 3
                    },
                    {
                        targets: 5,
                        className: 'text-center'
                    }
                ]
            });

            $('body').on('click', '.btn-danger', function() {
                if (confirm('Are you sure?')) {
                    $('.form-delete').submit();
                } else {
                    return false;
                }
            });
        });
    </script>
@endpush