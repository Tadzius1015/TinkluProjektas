@extends('layouts.app')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->role == 'Vadovas')
        @if(count($reportWorkers) == 0)
            <h1 align="center">Atsiprašome, tačiau problemų kolkas nėra</h1>
        @endif
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <br />
                <h1 align="center">Technikų darbo veiklos ataskaita</h1>
                <br />
                <table class="table table-bordered">
                    <tr>
                        <th>Darbuotojo vardas</th>
                        <th>Darbuotojo pavardė</th>
                        <th>Vidutinis atsako į problemą laikas(minutėmis)</th>
                        <th>Vidutinis problemos išsprendimo laikas(minutėmis)</th>
                        <th>Paimtų problemų kiekis</th>
                        <th>Išspręstų problemų kiekis</th>
                        <th>Laikotarpis nuo</th>
                        <th>Laikotarpis iki</th>
                        <th>Ataskaitos sukūrimo laikas</th>
                    </tr>
                    @foreach($reportWorkers as $row)
                        <tr>
                            <td>{{$row->workername}}</td>
                            <td>{{$row->workersurname}}</td>
                            <td>{{$row->avgresponsetime}}</td>
                            <td>{{$row->avgfixingtime}}</td>
                            <td>{{$row->takingdevicescount}}</td>
                            <td>{{$row->repaireddevicescount}}</td>
                            <td>{{$row->intervalbegin}}</td>
                            <td>{{$row->intervalend}}</td>
                            <td>{{$row->created_at}}</td>
                        </tr>
                        @endforeach
                </table>
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
