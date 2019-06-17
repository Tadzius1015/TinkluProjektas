@extends('layouts.app')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->role == 'Vadovas')
        @if(count($reportDevices) == 0)
            <h1 align="center">Atsiprašome, tačiau nerasta nė viena ataskaita</h1>
        @endif
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <br />
                <h1 align="center">Suremontuotų prietaisų sąrašas su ataskaitomis</h1>
                <br />
                <table class="table table-bordered">
                    <tr>
                        <th>Prietaisas</th>
                        <th>Aprašymas</th>
                        <th>Detalesnė ataskaita</th>
                    </tr>
                    @foreach($reportDevices as $row)
                        <tr>
                            <td>{{$row->problem}}</td>
                            <td>{{$row->description}}</td>
                            <td><a href="{{ route('concretedevicereport', ['id' => $row->id ]) }}">Peržiūrėti</a></td>
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
