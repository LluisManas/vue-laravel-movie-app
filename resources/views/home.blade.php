@extends('layouts.app')

@section('content')
<div class="container">
    @guest
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>You don't have access to this page!</h4>
                    </div>
                    <div class="card-body text-center">
                        <p>You need an account to proceed.</p>
                        <p>Please register first or login directly if you already own an account</p>                        
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success">
                            <a href="{{ route('login') }}">LogIn</a>
                        </button>
                        <button type="submit" class="btn btn-secundary">
                            <a href="{{ route('register') }}">Register</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row justify-content-center">
        @if (session('status'))
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                    
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div id='app'>
        <app-component></app-component>
    </div>
    @endguest
</div>
@endsection
