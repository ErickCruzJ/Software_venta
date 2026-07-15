import { useMemo, useState } from 'react';
import { router } from '@inertiajs/react';
import { Plus} from 'lucide-react';


import Toolbar from '@/components/Toolbar/Toolbar';
import PrimaryButton from '@/components/Buttons/PrimaryButton';
import SearchInput from  '@/components/Inputs/SearchInput';
import StatusBadge from  '@/components/Badge/StatusBadge';
import DataTable from '@/components/Table/DataTable';
import EditButton from '@/components/Buttons/EditButton';
import DeleteButton from '@/components/Buttons/DeleteButton';

interface Categoria {
    id_categoria: number;
    nombre: string;
    descripcion: string | null;
    estado: boolean; 
}

interface IndexProps{
    categorias: Categoria[];
}

export default function Index({ categorias }: IndexProps) {
    const[search, setSearch] = useState('');

    const categoriasFiltradas = useMemo(() =>{
        const termino = search.toLowerCase().trim();

        if (!termino) {
            return categorias;
        }

        return categorias.filter((categoria) => {
            const nombre = categoria.nombre.toLowerCase();
            
            const descripcion =
                categoria.descripcion?.toLowerCase() ?? '';

                return(
                    nombre.includes(termino) ||
                    descripcion.includes(termino)
                );
        });
    }, [categorias, search]);

    function editarCategoria (id: number) {
        router.visit(`/categorias/${id}/edit`);
    }

    function eliminarCategoria(categoria: Categoria) {
       const confirmar = window.confirm(
        `¿Deseas eliminar la categoria "${categoria.nombre}"?`
       );

       if (!confirmar) {
        return;
       }

       router.delete(
        `/categorias/${categoria.id_categoria}`
       )

    }

    const columns = [
        {
            key: 'nombre',
            label: 'Nombre',
            render: (categoria: Categoria) => (
                <span className="font-medium text-gray-900">
                    {categoria.nombre}
                </span>
            ),
        },
        {
            key: 'descripcion',
            label: 'Descripción',
            render: (categoria: Categoria) => (
                <span className="text-gray-600">
                    {categoria.descripcion ?? 'Sin descripción'}
                </span>
            ),
        },
        {
            key: 'estado',
            label: 'Estado',
            render: (categoria: Categoria) => (
                <StatusBadge active={categoria.estado} />
            ),
        },
        {
            key: 'acciones',
            label: 'Acciones',
            render: (categoria: Categoria) => (
                <div className="flex items-center gap-2">
                    <EditButton
                        onClick={() =>
                            editarCategoria(categoria.id_categoria)
                        }
                    />
                    <DeleteButton
                        onClick={() =>
                            eliminarCategoria(categoria)
                         }
                    />
                </div>
            ),
        },
    ];

    return (
        <>
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold text-gray-900">
                        Categorias
                    </h1>
                    
                    <p className="mt-1 text-sm text-gray-500">
                        Administra las categorias de los productos.
                    </p>
                </div>

                <Toolbar title="Lista de caregorias">
                    <SearchInput
                        value={search}
                        onChange={setSearch}
                        placeholder="Buscar categoria..."
                    />

                    <PrimaryButton
                        type='button' 
                        onClick={() =>
                            router.visit('/categorias/create')
                        }
                    >
                        <span className="flex items-center gap-2">
                            <Plus size={18} />

                            Nueva categoria
                        </span>
                    </PrimaryButton>
                </Toolbar>

                <DataTable
                    columns={columns}
                    data={categoriasFiltradas}
                    rowKey={(categoria) =>
                        categoria.id_categoria
                    }
                />
            </div>
        </>
    );
}