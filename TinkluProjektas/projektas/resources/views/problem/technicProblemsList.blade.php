@extends('layouts.app')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->role == 'Technikas')
        @if(count($currentproblems) == 0)
            <h1 align="center">Atsiprašome, tačiau jūs kolkas nesprendžiate nei vienos problemos</h1>
        @endif
            @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}">
                    {!! session('message.content') !!}
                </div>
            @endif
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <br />
                <h1 align="center">Mano paimtų problemų sąrašas</h1>
                <br />
                <table class="table table-bordered">
                    <tr>
                        <th>Problemos nr.</th>
                        <th>Prietaisas</th>
                        <th>Aprašymas</th>
                        <th>Sukūrimo data</th>
                        <th>Paėmimo remontuoti laikas</th>
                        <th>Techniko komentaras</th>
                        <th>Veiksmai</th>
                    </tr>
                    @foreach($currentproblems as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->devicename}}</td>
                            <td>{{$row->description}}</td>
                            <td>{{$row->registrationtime}}</td>
                            <td>{{$row->takingtime}}</td>
                            <td>{{$row->technicdescription}}</td>
                            <td><a href="{{ route('editproblem', ['id' => $row->id]) }}">Redaguoti</a></td>
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
