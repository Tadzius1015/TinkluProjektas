@extends('layouts.app')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->role == 'Vadovas')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Detali problemos {{$report->problem}} ataskaita</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form">
                        {{ csrf_field() }}

                        <div>
                            <label for="name" class="col-md-4 control-label">Įrenginio pavadinimas:</label>

                            <div class="col-md-6">
                                <label for="name" class="col-md-4 control-label">{{$report->problem}}</label>

                            </div>
                        </div>

                        <div>
                            <label for="surname" class="col-md-4 control-label">Aprašymas:</label>

                            <div class="col-md-6">
                                <label for="surname" class="col-md-4 control-label">{{$report->description}}</label>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Problemos užregistravimo laikas:</label>

                            <div class="col-md-6">
                                <label for="surname" class="col-md-4 control-label">{{$report->registrationtime}}</label>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Problemos paėmimo laikas:</label>

                            <div class="col-md-6">
                                <label for="surname" class="col-md-4 control-label">{{$report->takingtime}}</label>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Problemos išsprendimo laikas:</label>

                            <div class="col-md-6">
                                <label for="surname" class="col-md-4 control-label">{{$report->fixingtime}}</label>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Operatoriaus vardas:</label>

                            <div class="col-md-6">
                                <label for="surname" class="col-md-4 control-label">{{$report->operatorname}}</label>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Operatoriaus pavardė:</label>

                            <div class="col-md-6">
                                <label for="surname" class="col-md-4 control-label">{{$report->operatorsurname}}</label>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Techniko vardas:</label>

                            <div class="col-md-6">
                                <label for="surname" class="col-md-4 control-label">{{$report->technicname}}</label>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Techniko pavardė:</label>

                            <div class="col-md-6">
                                <label for="surname" class="col-md-4 control-label">{{$report->technicsurname}}</label>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Techniko komentaras:</label>

                            <div class="col-md-6">
                                <label for="surname" class="col-md-4 control-label">{{$report->technicdescription}}</label>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Trumpas aprašas vadovui:</label>

                            <div class="col-md-6">
                                <label for="surname" class="col-md-4 control-label">{{$report->reportdescription}}</label>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Neveikimo laikas(dienomis):</label>

                            <div class="col-md-6">
                                <label for="surname" class="col-md-4 control-label">{{$report->notworkingtime}}</label>

                            </div>
                        </div>
                        <div>
                            <label for="surname" class="col-md-4 control-label">Ataskaitos sukūrimo laikas:</label>

                            <div class="col-md-6">
                                <label for="surname" class="col-md-4 control-label">{{$report->created_at}}</label>

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
