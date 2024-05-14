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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="w-full">
                <canvas id="bar-chart"></canvas>
            </div>
            <div class="w-full">
                <canvas id="radar-chart"></canvas>
            </div>
            <div class="w-full">
                <canvas id="comparacion-chart"></canvas>
            </div>
            <div>
                <canvas id="line-chart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx1 = document.getElementById('bar-chart').getContext('2d');
    var myBarChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: {!! json_encode($productosMasVendidos->pluck('nombre')) !!},
            datasets: [{
                label: 'Productos más vendidos',
                data: {!! json_encode($productosMasVendidos->pluck('total_vendido')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            // Opciones del gráfico
        }
    });

    var ctx = document.getElementById('comparacion-chart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($datosGrafico)) !!},
            datasets: [{
                label: 'Comparación de ingresos y comisión',
                data: {!! json_encode(array_values($datosGrafico)) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
    var ctx = document.getElementById('radar-chart').getContext('2d');
    var myRadarChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Categorías más compradas',
                data: {!! json_encode($data) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            // Opciones del gráfico
        }
    });
</script>
@endsection