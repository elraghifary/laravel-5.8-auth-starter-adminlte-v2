@extends('layouts.main')

@section('title')
    <title>{{ env('APP_NAME') }} - Home</title>
@endsection

@section('content')
    <section class="content-header">
        <h1>Home</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                
            </div>
        </div>
    </section>
@endsection
