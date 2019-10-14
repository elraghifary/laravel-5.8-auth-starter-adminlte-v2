@extends('layouts.main')

@section('title')
    <title>{{ env('APP_NAME') }} - Permission Management</title>
@endsection

@section('content')
    <section class="content-header">
        <h1>Permissions</h1>
        <ol class="breadcrumb">
            <li class="active"><a href="{{ route('permission.index') }}"><i class="fa fa-file-text"></i> Permission</a></li>
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
                            <i class="fa fa-plus"></i> Add Permission
                        </button>
                        <div class="modal fade" id="modal-add">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Add Permission</h4>
                                    </div>
                                    <form role="form" id="form-permission" action="{{ route('permission.store') }}" method="post">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Permission</label>
                                                <input type="text" 
                                                name="name"
                                                class="form-control" id="name">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="table-responsive">
                            <table id="permission" class="responsive nowrap table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th>Permission</th>
                                        <th>Guard</th>
                                        <th>Created At</th>
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
            var table = $('#permission').DataTable({
                ajax: {
                    url: '{{ route('permission.getData') }}'
                },
                columnDefs: [
                    {
                        targets: 4,
                        className: 'text-center'
                    }
                ]
            });

            $("#form-permission").validate({
                rules: {
                    name: {
                        required: true
                    }
                }
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