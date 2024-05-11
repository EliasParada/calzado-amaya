<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargar factura {{ $compra->factura_nombre }} | Calzado Amaya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yaldevi:wght@200..700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        main: {
                            'red': '#940809',
                            'orange': '#F84E29',
                            'yellow': '#E5BD35',
                        },
                        secondary: {
                            'white': '#ffffff',
                            'black': '#000000',
                        }
                    },
                    fontFamily: {
                        yaldevi: 'Yaldevi, sans-serif'
                    }
                }
            }
        }
    </script>
</head>
<body class="font-yaldevi box-border h-full">
    <div class="max-w-md mx-auto bg-white p-8">
        <h2 class="text-3xl font-bold mb-6 text-center">¡Pago exitoso!</h2>
        <div class="mb-6">
            <p class="text-lg mb-2">Fecha:</p>
            <p class="text-gray-700">{{ $fecha_cobro }}</p>
        </div>
        <div class="mb-6">
            <p class="text-lg mb-2">Número de factura:</p>
            <p class="text-gray-700">{{ $compra->factura_nombre }}</p>
        </div>
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Detalles de la compra:</h3>
            <div class="border-t border-gray-400 py-2">
                @forelse ($compra->detalle as $producto)
                <div class="flex justify-between items-center mb-2">
                    <div class="flex items-center">
                        <p class="mr-4">{{ $producto->productos->nombre }}</p>
                        <p class="font-bold mr-4">X</p>
                        <p class="mr-4">{{ $producto->cantidad }}</p>
                    </div>
                    <p>{{ $producto->cantidad * $producto->productos->precio_venta - $producto->descuento }}</p>
                </div>
                @empty
                <p>No hay productos en esta compra.</p>
                @endforelse
            </div>
        </div>
        <div class="mb-6 flex justify-between">
            <p class="text-lg">Envio:</p>
            <p class="text-gray-700">{{ $compra->precio_envio }}</p>
        </div>
        <div class="mb-6 flex justify-between">
            <p class="text-lg">Total:</p>
            <p class="text-gray-700">{{ $subtotal }}</p>
        </div>
        <p class="text-center text-gray-600">¡Gracias por tu compra!</p>
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="bg-black text-white px-4 py-2">Volver a la página principal</a>
        </div>
    </div>
</body>
</html>