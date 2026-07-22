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
import empleados from '@/routes/empleados';

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

        if (!termino){
            return empleados;
        }
        
        return empleados.filter((empleado)=>{
            const nombreCompleto = `${empleado.nombre} ${empleado.apellido_paterno} ${empleado.apellido_materno ?? ''}`.toLowerCase();

            return(
                nombreCompleto.includes(termino)||
                empleado.correo.toLowerCase().includes(termino)||
                empleado.telefono.includes(termino)
            );
        });
    }, [empleados, search]);

    function editarEmpleado(id: number){
        router.visit(`/empleados/${id}/edit`);
    }
    function eliminarEmpleado(empleado: Empleado){
        const confirmar = window.confirm(
            `¿Deseas elimimar al empleado "${empleado.nombre}"?`
        );
        if (!confirmar){
            return;
        }
        router.delete(`/empleados/${empleado.id_empleado}`);
    }

    const columns = [
        {
            key:'nombre',
            label: 'Empleado',
            render: (empleado: Empleado) =>(
                <span className= "font-medium text-gray-900">
                    {empleado.nombre} {empleado.apellido_paterno} {empleado.apellido_materno}
                </span>
            ),
        },
        {
            key: 'telefono',
            label: 'Telfono',
        },
        {
            key: 'correo',
            label: 'Correo',
        },
        {
            key: 'Fecha_Contratacion',
            label: 'Fecha contratación'
        },
        {
            key: 'estado',
            label: 'Estado',
            render: (empleado: Empleado) =>(
                <StatusBadge
                    active= {empleado.estado === 'Activo'}
                />
            ),
        },
        {
            key: 'acciones',
            label: 'Acciones',
            render: (empleado: Empleado) => (
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
            <div className='space-y-6'>
                <div>
                    <h1 className='text-2xl font-bold text-gray-900'>
                        Empleados
                    </h1>
                    <p className='mt-1 text-sm text.gray-500'>
                        Administración de los empleados del sistema.
                    </p>
                </div>

                <Toolbar title="Lisa de empleados">
                    <SearchInput
                        value={search}
                        onChange={setSearch}
                        placeholder='Buscar empleado...'
                    />
                    <PrimaryButton
                        type="button"
                        onClick={()=> router.visit('/emoleados/create')}
                    >
                        <span className='flex items-center gap-2'>
                            <Plus size={18}/>
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
    )
}