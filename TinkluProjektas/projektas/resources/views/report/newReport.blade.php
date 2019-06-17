@extends('layouts.app')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->role == 'Technikas')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nauja ataskaita</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url("/newreport") }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('devicename') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Įrenginio pavadinimas</label>

                            <div class="col-md-6">
                                <input id="deivicename" type="text" class="form-control" name="devicename" value="{{ $problem[0]->devicename }}" readonly>

                                @if ($errors->has('devicename'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('devicename') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <label for="surname" class="col-md-4 control-label">Aprašymas</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ $problem[0]->description}}" readonly>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Problemos užregistravimo laikas</label>

                            <div class="col-md-6">
                                <input id="registrationtime" type="text" class="form-control" name="registrationtime" value="{{ $problem[0]->registrationtime }}" readonly>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Problemos paėmimo laikas</label>

                            <div class="col-md-6">
                                <input id="takingtime" type="text" class="form-control" name="takingtime" value="{{ $problem[0]->takingtime }}" readonly>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Problemos išsprendimo laikas</label>

                            <div class="col-md-6">
                                <input id="fixingtime" type="text" class="form-control" name="fixingtime" value="{{ $problem[0]->fixingtime }}" readonly>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Operatoriaus vardas</label>

                            <div class="col-md-6">
                                <input id="opname" type="text" class="form-control" name="opname" value="{{ $problem[0]->operator->name }}" readonly>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Operatoriaus pavardė</label>

                            <div class="col-md-6">
                                <input id="opsurname" type="text" class="form-control" name="opsurname" value="{{ $problem[0]->operator->surname }}" readonly>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Techniko komentaras</label>

                            <div class="col-md-6">
                                <input id="technicdescription" type="text" class="form-control" name="technicdescription" value="{{$problem[0]->technicdescription}}" readonly>

                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('shortdescription') ? ' has-error' : '' }}">
                            <label for="surname" class="col-md-4 control-label">Trumpas aprašas vadovui</label>

                            <div class="col-md-6">
                                <input id="shortdescription" type="text" class="form-control" name="shortdescription" value="{{ old('shortdescription') }}">
                                @if ($errors->has('shortdescription'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shortdescription') }}</strong>
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
