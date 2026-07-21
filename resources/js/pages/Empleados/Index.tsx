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
            const nombreCompleto = `${empleado.nombre} ${empleado.apellido_paterno}`
        })
    })
}
    return(
        <>
            <Head title = "Empleados"/>
            <MainLayout>
                <Toolbar
                    title='Empleados'
                    chi='Administración de empleados'
                >
                    <SearchInput
                        placeholder="Buscar empleado....."
                    />
                    <Link href={route('empleados.create')}>
                       <PrimaryButton>
                            <Plus size={18} />
                            Nuevo empleado
                       </PrimaryButton>
                    </Link>
                </Toolbar>
            </MainLayout>
        </>
    )
}