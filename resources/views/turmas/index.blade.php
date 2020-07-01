<script src="{{url('./vendor/jquery/jquery.min.js')}}" type="text/javascript"></script>
@include('admin.includes.alerts')

@extends('adminlte::page')

@section('title', 'Turmas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('turmas.index') }}" class="active">Turmas</a></li>
    </ol>

    <h1>Turmas <a href="{{ route('turmas.create') }}" class="btn btn-outline-success ">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('turmas.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-success">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>ÚNICO</th>
                        <th>ANO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turmas as $turma)
                        <tr>
                            <td>{{ $turma->TURMA }}</td>
                            <td>{{ $turma->UNICO }}</td>
                            <td>{{\Carbon\Carbon::parse($turma->ANO)->format('d/m/Y')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $turmas->appends($filters)->links() !!}
            @else
                {!! $turmas->links() !!}
            @endif
        </div>
    </div>
@stop



