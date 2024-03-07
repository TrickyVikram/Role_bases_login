@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

                

                <div class="card-body">
                    <p>User Name: {{ Auth::user()->name }}</p>
                    <p>User username: {{ Auth::user()->email }}</p>
            
                    {{-- Check if the authenticated user has an associated student --}}
                    @if(Auth::user()->student)
                    <p>Student User_id: {{ Auth::user()->student->user_id }}</p>
                        <p>Student Name: {{ Auth::user()->student->name }}</p>
                        <p>Student Phone: {{ Auth::user()->student->phone }}</p>
                        <p>Student Email: {{ Auth::user()->student->email }}</p>
                    @else
                        <p>No associated student information.</p>
                    @endif
                </div>



            </div>
        </div>
    </div>
</div>
@endsection
