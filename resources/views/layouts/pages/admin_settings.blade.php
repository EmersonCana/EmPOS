@extends('layouts.default')
@section('content')
@include('layouts.components.fragments.admin.admin_navbar')
<div class="container-fluid">
    <div class="row">
        <div class="col-3 mt-3">
            @include('layouts.components.fragments.admin.admin_sidebar')
        </div>
        <div class="col-9 mt-3">
            @include('layouts.components.fragments.create_category')
        </div>
    </div>
</div>

@endsection