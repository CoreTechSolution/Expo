@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                   @include('template-part.sidebar')
                   
                </div>
                <div class="col-lg-9">
                    Thak you to Login as {{ $data['user']->user_type }}
                </div>
            </div>
        </div>
    </div>
@endsection