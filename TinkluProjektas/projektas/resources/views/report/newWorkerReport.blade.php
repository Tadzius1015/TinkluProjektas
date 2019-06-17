@extends('layouts.app')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->role == 'Technikas')
        @if(session()->has('message.level'))
            <div class="alert alert-{{ session('message.level') }}">
                {!! session('message.content') !!}
            </div>
        @endif
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nauja ataskaita</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url("/prepareworkingreport") }}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('intervalbegin') ? ' has-error' : '' }}">
                            <label for="surname" class="col-md-4 control-label">Laiko intervalas nuo:</label>

                            <div class="col-md-6">
                                <input id="intervalbegin" type="date" class="form-control" name="intervalbegin" value="{{old('intervalbegin')}}">
                                @if ($errors->has('intervalbegin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('intervalbegin') }}</strong>
                                         </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('intervalend') ? ' has-error' : '' }}">
                            <label for="surname" class="col-md-4 control-label">Laiko intervalas iki:</label>

                            <div class="col-md-6">
                                <input id="intervalend" type="date" class="form-control" name="intervalend" value="{{old('intervalend')}}">
                                @if ($errors->has('intervalend'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('intervalend') }}</strong>
                                         </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Sukurti Ataskaitą
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
