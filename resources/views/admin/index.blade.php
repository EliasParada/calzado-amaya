@extends('layouts.app')

@section('title')
<title>Calzado Amaya</title>
@endsection

@section('content')
    Index Admin
    {{ Auth::user()->nombre }}
@endsection