@extends('layouts.app')

@section('title')
<title>Pago exitoso | Calzado Amaya</title>
@endsection

@section('content')
    {{ $fecha_cobro }}
    <br>
    {{ $numero_aprobacion_pg }}
@endsection