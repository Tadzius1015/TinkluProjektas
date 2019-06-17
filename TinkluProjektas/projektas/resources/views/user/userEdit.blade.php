@extends('layouts.app')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->role == 'Vadovas')
    @if(session()->has('message.level'))
        <div class="alert alert-{{ session('message.level') }}">
            {!! session('message.content') !!}
        </div>
    @endif
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profilio redagavimas</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url("/edit/{$user->id}") }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Vardas</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                            <label for="surname" class="col-md-4 control-label">Pavardė</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control" name="surname" value="{{ $user->surname }}">

                                @if ($errors->has('surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">El.pašto adresas</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <a>Pareigos: {{ $user->role }}</a>
                        </div>
                        @if (Auth::user()->role == 'Vadovas')
                            <div class="col-md-6">
                                <a>Keisti pareigas:</a>
                                <select id="role" name="role">
                                    <option>Operatorius</option>
                                    <option>Technikas</option>
                                    <option>Vadovas</option>
                                </select>
                            </div>
                            @endif
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Redaguoti
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    @else
        <div align="center">
            <h5 class="class">Neturite teisių peržiūrėti šios nuorodos.</h5>
            <div>
                <h3 class="class">Kreipkitės į sistemos administratorių dėl teisių suteikimo.</h3>
            </div>
        </div>
        <style>
            .class{
                font-size: 35px;
                color:red;
            }
        </style>
    @endif
@endsection
