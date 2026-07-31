import {useMemo, useState} from 'react';
import {router} from '@inertiajs/react';
import {Plus} from 'lucide-react';

import MainLayout from '@/components/layout/MainLayout';
import Toolbar from '@/components/Toolbar/Toolbar';
import SearchInput from '@/components/Inputs/SearchInput';
import PrimaryButton from '@/components/Buttons/PrimaryButton';
import DataTable from '@/components/Table/DataTable';
import StatusBadge from '@/components/Badge/StatusBadge';
import EditButton from '@/components/Buttons/EditButton';
import DeleteButton from '@/components/Buttons/DeleteButton';

interface Empleado {
    id_empleado: number;
    nombre: string;
    apellido_paterno: string;
    apellido_materno?: string;
    telefono: string;
    correo: string;
    fecha_contratacion: string;
    foto?: string;
    estado: 'Activo' | 'Suspendido' | 'Vacaciones' | 'Baja temporal' | 'Baja' ;
}
interface Props{
    empleados: Empleado[];
}
export default function Index({empleados}: Props){
    const [search, setSearch] = useState('');

    const empleadosFiltrados = useMemo(()=>{
        const termino = search.toLowerCase().trim();

        if(!termino){
            return empleados;
        }

        return empleados.filter((empleado)=>{
            const nombreCompleto = `${empleado.nombre} ${empleado.apellido_paterno} ${empleado.apellido_materno ?? ''}`.toLowerCase();
            
            return (
                nombreCompleto.includes(termino)||
                empleado.correo.toLowerCase().includes(termino)||
                empleado.telefono.includes(termino)
            );
        });
    }, [empleados,search]);

    function editarEmpleado(id:number){
        router.visit(`/empleados/${id}/edit`);
    }

    function eliminarEmpleado(empleado:Empleado){
        const confirmar = window.confirm(
            `¿Deseas eliminar al empleado "${empleado.nombre}"?`
        );
        if(!confirmar){
            return;
        }
        router.delete(`/empleados/${empleado.id_empleado}`);
    }
    const columns =[
        {
            key: 'id_empleado',
            label: 'ID',
            render: (empleado: Empleado) => (
                <div>
                    <p className="font-semibold text-base text-gray-900 dark:text-white">
                        {empleado.id_empleado}
                    </p>
                </div>
            )
        },
        {
            key: 'nombre',
            label: 'Empleado',
            render: (empleado: Empleado) => (
                <div className='flex items-center gap-4'>
                    <img 
                        src={
                            empleado.foto
                                ? `/storage/${empleado.foto}`
                                : `/images/user-default.png`
                        }
                        alt="Empleado"
                        className='h-14 w-14 rounded-full object-cover border-2 border-gray-200 shadow-sm'
                    />
                    
                    <div>
                        <p className='font-semibold text-base text-gray-900 dark:text-white'>
                            {empleado.nombre} {' '}
                            {empleado.apellido_paterno} {' '} 
                            {empleado.apellido_materno}
                        </p>

                        <p className='text-sm text-gray-500'>
                            {empleado.correo}
                        </p>
                    </div>

                </div>

            ),
        },
        {
            key: 'telefono',
            label: 'Telefono',
            render: (empleado: Empleado)=>(
                <span className='font-medium'>
                    {empleado.telefono}
                </span>
            )
        },
        {
            key:'fecha_contratacion',
            label: 'Fecha contratación',
            render: (empleado: Empleado) => new Intl.DateTimeFormat('es-MX',{
                day: '2-digit',
                month: 'short',
                year: 'numeric',
            }).format(
                new Date(empleado.fecha_contratacion)
            ),
        },
        {
            key: 'estado',
            label: 'Estado',
            render: (empleado: Empleado) => (
                <StatusBadge
                    active={empleado.estado === 'Activo'}
                />
            ),
        },
        {
            key: 'acciones',
            label: 'Acciones',
            render: (empleado: Empleado) =>(
                <div className='flex items-center gap-2'>
                    <EditButton
                        onClick={()=>
                            editarEmpleado(empleado.id_empleado)
                        }
                    />
                    <DeleteButton
                        onClick={()=>
                            eliminarEmpleado(empleado)
                        }
                    />
                </div>
            ),
        },
    ];
    return(
  <>

            <div className="space-y-6">

                <div className='mb-6'>
                    <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                        Empleados
                    </h1>

                    <p className="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {empleadosFiltrados.length} empleados registrados
                    </p>
                </div>

                <Toolbar title="">

                    <SearchInput
                        value={search}
                        onChange={setSearch}
                        placeholder="Buscar nombre, correo o telefono..."
                    />

                    <PrimaryButton
                        type="button"
                        onClick={() => router.visit('/empleados/create')}
                    >
                        <span className="flex items-center gap-2">
                            <Plus size={18} />
                            Nuevo empleado
                        </span>
                    </PrimaryButton>

                </Toolbar>

                <DataTable
                    columns={columns}
                    data={empleadosFiltrados}
                    rowKey={(empleado) => empleado.id_empleado}
                />

            </div>

        </>
    );

}
    