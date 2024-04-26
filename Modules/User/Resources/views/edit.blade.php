@extends('layouts.app')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    @include('include.content-block', ['data' => ['title' => __('main.info', ['name' => $item->first_name . ' ' . $item->last_name ])]])

                    <form action="{{ route('users.update', $item->id) }}" class="form-contact needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('patch')
                        @include('user::form')
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

@endsection
