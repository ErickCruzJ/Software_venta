<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Servicio no disponible</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-50">

    <main
        class="
            flex min-h-screen
            items-center justify-center
            px-6
        "
    >
        <div class="w-full max-w-lg text-center">

            <div
                class="
                    rounded-2xl
                    border border-gray-200
                    bg-white
                    p-10
                    shadow-sm
                "
            >
                <div
                    class="
                        mx-auto
                        flex h-16 w-16
                        items-center justify-center
                        rounded-full
                        bg-red-50
                    "
                >
                    <svg
                        class="h-8 w-8 text-red-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v3m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"
                        />
                    </svg>
                </div>

                <h1
                    class="
                        mt-6
                        text-2xl
                        font-bold
                        text-gray-900
                    "
                >
                    Servicio temporalmente no disponible
                </h1>

                <p class="mt-3 text-sm text-gray-500">
                    No fue posible establecer conexión con el servidor
                    de datos.
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Verifica la conexión e intenta nuevamente.
                </p>

                <button
                    type="button"
                    onclick="window.location.reload()"
                    class="
                        mt-8
                        rounded-lg
                        bg-blue-600
                        px-5 py-2.5
                        text-sm
                        font-medium
                        text-white
                        transition
                        hover:bg-blue-700
                    "
                >
                    Intentar nuevamente
                </button>

            </div>

            <p class="mt-4 text-xs text-gray-400">
                Sistema de ventas e inventario
            </p>

        </div>
    </main>

</body>
</html>
