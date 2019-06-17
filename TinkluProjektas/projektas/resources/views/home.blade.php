@extends('layouts.app')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->role == 'Operatorius')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Prisijungėte
                </div>
            </div>
        </div>
    </div>
</div>
@elseif(\Illuminate\Support\Facades\Auth::user()->role == 'Vadovas')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        Prisijungėte
                    </div>
                    <button>Šiaip</button>
                </div>
            </div>
        </div>
    </div>
    @elseif(\Illuminate\Support\Facades\Auth::user()->role == 'Technikas')
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Dashboard</div>

                        <div class="panel-body">
                            Prisijungėte
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endif
@endsection
