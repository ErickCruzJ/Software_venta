import { Head } from '@inertiajs/react';


export default function Dashbord() {
    return(
        <>
            <Head title='Panel principal' />
            <div className='space-y-6'>
                <div>
                    <h1 className='text-2xl font-bold text-gray-900'>
                        Panel pricipal
                    </h1>
                    <p className='grid gap-6 md:grid-cols-2 lg:grid-col-3'>
                        Bienvenido al sistema de ventas e inventario
                    </p>
                </div>
                <div className='grid gap-6 md:grid-cols-2 lg:grid-cols-3'>
                    <div className='
                        rounded-xl
                        border border-gray-200 
                        bg-white
                        p-6
                        shadow-sm
                    '>
                        <p className='text-sm text-gray-500'>
                            Categorías
                        </p>
                        <p className='mt-2 text-3xl font-bold text-gray-900'>
                            0
                        </p>
                    </div>
                    <div className='
                        rounded-xl
                        border border-gray-200
                        bg-white
                        p-6 
                        shadow-sm 
                    '>
                        <p className=' text-sm text-gray-500'>
                            stock bajo
                        </p>
                        <p className='mt-2 text-3xl font-bold text-gray-900'>
                            0
                        </p>
                    </div>
                </div>
                <div className='
                    min-h-96
                    rounded-xl
                    border border-gray-200
                    bg-white
                    p-6
                    shadow-sm
                '>
                    <h2 className='text-lg font-semibold text-gray-900'>
                        Resumen del sistema
                    </h2>

                    <p className='mt-2 text-sm text-gray-500 '>
                        Aqui mostraremos estadisticas de ventas e inventario
                    </p>
                </div>
            </div>

        </>
    )
}