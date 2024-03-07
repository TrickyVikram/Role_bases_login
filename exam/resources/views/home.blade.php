@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{Auth::user()->name}}

            </div>

            @if (Auth::user()->role==1)
                <h1> i am admin</h1>
                <a href="/admin/students">View Students</a>

            @elseif(Auth::user()->role == 2)
           <h1> i am teacher </h1>
            @elseif(Auth::user()->role == 0)
         
                <h1>i am student</h1>
            @endif

        </div>
    </div>
@endsection
