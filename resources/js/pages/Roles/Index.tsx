import { useMemo, useState } from "react";
import { router } from "@inertiajs/react";
import { Plus } from "lucide-react";

import Toolbar from "@/components/Toolbar/Toolbar";
import SearchInput from "@/components/Inputs/SearchInput";
import PrimaryButton from "@/components/Buttons/PrimaryButton";
import DataTable from "@/components/Table/DataTable";
import StatusBadge from "@/components/Badge/StatusBadge";
import EditButton from "@/components/Buttons/EditButton";
import DeleteButton from "@/components/Buttons/DeleteButton";

interface Rol{
    id_rol: number;
    nombre: string;
    descripcion: string;
    estado: boolean;
}

interface Props{
    roles: Rol[];
}

export default function Index({ roles }:Props){
    const [search, setSearch] = useState("");

    const rolesFiltrados = useMemo(()=>{
        const termino = search.toLowerCase().trim();

        if(!termino){
            return roles;
        }
        return roles.filter((rol)=>
            rol.nombre.toLowerCase().includes(termino) ||
            rol.descripcion.toLowerCase().includes(termino)
        );
    }, [roles, search]);

    function editarRol(id: number){
        router.visit(`/roles/${id}/edit`);
    }

    function eliminarRol(rol: Rol){
        const confirmar = window.confirm(
            `¿Deseas eliminar el rol "${rol.nombre}"?`
        );
        if(!confirmar) return;
        router.delete(`/roles/${rol.id_rol}`);
    }

    const columns = [
        {
            key:"nombre",
            label: "Nombre",

            render: (rol: Rol) => (
                <div>
                    <p className="font-semibold text-base text-gray-900 dark:text-white">
                        {rol.nombre}
                    </p>
                </div>
            ),
        },
        {
            key: "descripcion",
            label: "Descripcion",

            render: (rol: Rol)=>(
                <span className="text-gray-600 dark:text-gray-300">
                    {rol.descripcion}
                </span>
            ),
        },
        {
            key: "estado",
            label: "Estado",

            render: (rol: Rol)=>(
                <StatusBadge
                    active={rol.estado}
                />
            ),
        },
        {
            key:"acciones",
            label: "Acciones",

            render: (rol: Rol) =>(
                <div className="flex items-center gap-2">
                    <EditButton
                        onClick={()=>editarRol(rol.id_rol)}
                    />

                    <DeleteButton
                        onClick={()=>eliminarRol(rol)}
                    />
                </div>
            ),
        },
    ];

    return(
        <>
            <div className="space-y-6">
                <div className="mb-6">
                    <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                        Roles
                    </h1>
                    <p className="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {rolesFiltrados.length} roles registrados
                    </p>
                </div>
                <Toolbar title="">
                    <SearchInput
                        value={search}
                        onChange={setSearch}
                        placeholder="Buscar nombre o descripción...."
                    />
                    <PrimaryButton
                        type="button"
                        onClick={()=>router.visit("/roles/create")}
                    >
                        <span className="flex items-center  gap-2">
                            <Plus size={18}/>
                            Nuevo Rol
                        </span>
                    </PrimaryButton>
                </Toolbar>
                <DataTable
                    columns={columns}
                    data={rolesFiltrados}
                    rowKey={(rol) => rol.id_rol}
                />
            </div>
        </>
    )
}

