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
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <br />
                <h1 align="center">Vartotojų sąrašas</h1>
                <br />
                <table class="table table-bordered">
                    <tr>
                        <th>Vardas</th>
                        <th>Pavardė</th>
                        <th>Pareigos</th>
                        <th>El.paštas</th>
                        <th>Redaguoti</th>
                    </tr>
                    @foreach($users as $row)
                        <tr>
                            <td>{{$row['name']}}</td>
                            <td>{{$row['surname']}}</td>
                            <td>{{$row['role']}}</td>
                            <td>{{$row['email']}}</td>
                            <td><a href="{{ route('edit', ['id' => $row['id']]) }}">Redaguoti</a></td>
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
