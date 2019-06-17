@extends('layouts.app')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->role == 'Technikas')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Problemos redagavimas</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url("/editproblem/{$problem->id}") }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('devicename') ? ' has-error' : '' }}">
                            <label for="devicename" class="col-md-4 control-label">Problema</label>

                            <div class="col-md-6">
                                <input id="devicename" type="text" class="form-control" name="devicename" value="{{ $problem->devicename }}" readonly>

                                @if ($errors->has('devicename'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('devicename') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Aprašymas</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ $problem->description }}" readonly>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-md-4 control-label">Būsena:</label>
                        <div class="col-md-6">
                            <a>{{ $problem->status }}</a>
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-md-4 control-label">Keisti remonto būseną:</label>
                        <div class="col-md-6">
                            <select id="status" name="status">
                                <option>Remontuojamas</option>
                                <option>Suremontuota</option>
                            </select>
                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('technicdescription') ? ' has-error' : '' }}">
                            <label for="technicdescription" class="col-md-4 control-label">Problemos sprendimo aprašas:</label>

                            <div class="col-md-6">
                                <input id="technicdescription" type="text" class="form-control" name="technicdescription" value="{{ $problem->technicdescription }}">

                                @if ($errors->has('technicdescription'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('technicdescription') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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
