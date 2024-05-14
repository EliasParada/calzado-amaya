@extends('layouts.app')

@section('title')
<title>Administrar | Calzado Amaya</title>
@endsection

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-semibold mb-4">Dashboard Calzado Amaya</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white p-6 rounded-md shadow-md">
            <h2 class="text-xl font-semibold mb-4">Administrar Categorías</h2>
            <a href="{{ route('categorias') }}" class="bg-main-yellow text-secondary-black px-4 py-2 rounded-md hover:bg-main-orange">Ir a Categorías</a>
        </div>
        <div class="bg-white p-6 rounded-md shadow-md">
            <h2 class="text-xl font-semibold mb-4">Administrar Productos</h2>
            <a href="{{ route('productos') }}" class="bg-main-yellow text-secondary-black px-4 py-2 rounded-md hover:bg-main-orange">Ir a Productos</a>
        </div>
    </div>

    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Gráficas del Negocio</h2>
        <p>Aquí iran gráficas del negocio.</p>
    </div>
</div>
@endsection