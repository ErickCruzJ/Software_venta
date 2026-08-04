import { useMemo, useState } from 'react';
import { Head, router } from '@inertiajs/react';
import { Plus } from 'lucide-react';

import Toolbar from "@/components/Toolbar/Toolbar";
import SearchInput from "@/components/Inputs/SearchInput";
import PrimaryButton from '@/components/Buttons/PrimaryButton';
import StatusBadge from '@/components/Badge/StatusBadge';
import EditButton from '@/components/Buttons/EditButton';
import DeleteButton from '@/components/Buttons/DeleteButton';
import DataTable from '@/components/Table/DataTable';
import Avatar from '@/components/Avatar/Avatar';

import {  FormCard, FormPage } from '@/components/Forms';

interface Empleado {
    id_empleado: number;
    nombre: string;
    apellido_paterno:string;
    apellido_materno:string;
    correo:string;
    foto?:string;
}

interface Rol{
    id_rol: number;
    nombre:string;
}

interface Usuario{
    id_usuario: number;
    nombre_usuario: string;
    estado: "Conectado"|"Desconectado"|"Suspendido"|"Bloqueado";
    ultima_conexion?: string;

    empleado: Empleado | null;
    rol: Rol;

}

interface Props{
    usuarios: Usuario[];
}

export default function Index({usuarios}:Props){
    const [search, setSearch] = useState('');

    const usuariosFiltrados = useMemo(()=>{
        const termino = search.toLowerCase().trim();

        if(!termino){
            return usuarios;
        }
        return usuarios.filter((usuario)=>{
            const empleado = usuario.empleado;

            const nombreCompleto = empleado
                ?`${empleado.nombre} ${empleado.apellido_paterno} ${empleado.apellido_materno ?? ""}`.toLowerCase(): "";

            const correo = empleado?.correo.toLowerCase() ?? "";

            return (
                usuario.nombre_usuario.toLowerCase().includes(termino) ||
                nombreCompleto.includes(termino) ||
                correo.includes(termino) ||
                usuario.rol.nombre.toLowerCase().includes(termino) ||
                usuario.estado.toLowerCase().includes(termino)
            );
        });

    }, [usuarios, search]);

    function editarUsuario(id: number){
        router.visit(`/usuarios/${id}/edit`);
    }
    
    function eliminarUsuario(usuario: Usuario){
        const confirmar = window.confirm(`¿Deseas eliminar el usuario "${usuario.nombre_usuario}"?`);
        
        if(!confirmar) return;
        router.delete(`/usuarios/${usuario.id_usuario}`);
    }
    const columns =[
        {
            key: "id_usuario",
            label: "ID",
            render: (usuario: Usuario) => (
                <div>
                    <p className="font-semibold text-base text-gray-900 dark:text-white">
                        {usuario.id_usuario}
                    </p>
                </div>
            )
        },
        {
            key: "empleado",
            label: "Empleado",
            render: (usuario: Usuario) => (
                usuario.empleado ? (
                    <div className='flex item-center gap-4'>
                        <Avatar 
                            nombre={usuario.empleado.nombre}
                            foto={usuario.empleado.foto}
                        />
                        <div>
                            <p className='font-semibild text-gray-900 dark:text-white'>
                                {usuario.empleado.nombre}{" "}
                                {usuario.empleado.apellido_paterno}{" "}
                                {usuario.empleado.apellido_materno}
                            </p>
                            <p className='text-sm text-gray-900 dark:text-white'>
                                {usuario.empleado.correo}
                            </p>
                        </div>
                    </div>
                ):(
                    <div className='flex items-center gap-4'>
                        <Avatar
                            nombre="Usuario"
                        />
                        <div>
                            <p className='font-semibold text-gray-900 dark:text-white'>
                                Sin empleado
                            </p>
                            <p className='text-sm text-gray-500 dark:text-gray-400'>
                                Cuenta independiente
                            </p>
                        </div>
                    </div>
                )
                
            ),
        },
        {
            key: "nombre_usuario",
            label: "Usuario",
            render: (usuario: Usuario) => (
                <span className="font-medium">
                    {usuario.nombre_usuario}
                </span>
            ),
        },
        {
            key: "rol",
            label: "Rol",
            render: (usuario: Usuario) => (
                <span>
                    {usuario.rol.nombre}
                </span>
            ),
        },
        {
           key: "estado",
           label: "Estado",
           render: (usuario: Usuario) => {
                const estilos ={
                    Conectado: "bg-green-100 text-green-700",
                    Desconectado: "bg-gray-100 text-gray-700",
                    Suspendido: "bg-yellow-100 text-yellow-700",
                    Bloqueado: "bg-red-100 text-red-700",
                };
                return(
                    <span className={`rounded-full px-3 py-1 text-sm font-semibold ${estilos[usuario.estado]}`}>
                        {usuario.estado}
                    </span>
                );
            },
            
        },
        {
            key: "ultuma_conexion",
            label: "Ultima Conexion",
            render: (usuario: Usuario) => (
                usuario.ultima_conexion
                    ? new Intl.DateTimeFormat("es-MX",{
                        dateStyle: "medium",
                        timeStyle: "short",
                    }).format(new Date(usuario.ultima_conexion))
                    :"Nunca"
            ),
        },
        {
            key: "acciones",
            label: "Acciones",
            render: (usuario: Usuario) =>(
                <div className="flex items-center gap-2">
                    <EditButton
                        onClick={() => editarUsuario(usuario.id_usuario)}
                    />
                    <DeleteButton
                        onClick={() => eliminarUsuario(usuario)}
                    />
                </div>
            ),
        },
    ];
    return(
        <>
           <Head title="Usuarios"/>

           <FormPage
                title = "Usuarios"
                description='Lista de usuarios registrados en el sistema'
            >
                <Toolbar title=''>
                    <SearchInput
                        value={search}
                        onChange={setSearch}
                        placeholder='Buscar usuario, empleado, correo o rol...'
                    />
                    <div>
                        <PrimaryButton
                            type="button"
                            onClick={()=>router.visit("/usuarios/sinempleado/create")}
                        >
                            <Plus size={18}/>
                            <span className='ml-2'>
                                Usuario sin empleado
                            </span>
                        </PrimaryButton>
                        <PrimaryButton
                            type= "button"
                            onClick={()=>router.visit("/empleados")}
                        >
                            <Plus size={18}/>
                            <span className='ml-2'>
                                Desde empleado
                            </span>
                        </PrimaryButton>
                    </div>
                </Toolbar>
                <DataTable
                    columns={columns}
                    data={usuariosFiltrados}
                    rowKey={(usuario)=>usuario.id_usuario}
                />
                
            </FormPage>
        </>
    );
}
