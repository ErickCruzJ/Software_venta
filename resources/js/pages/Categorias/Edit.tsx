import { FormEvent } from 'react';
import { router, useForm } from '@inertiajs/react';
import { ArrowLeft, Save, Target } from 'lucide-react';

import MainLayout from '@/components/layout/MainLayout';
import PrimaryButton from '@/components/Buttons/PrimaryButton';
import FormInput from '@/components/Inputs/FormInput';
import FormTextarea from '@/components/Inputs/FormTextarea';
import FormCheckbox from '@/components/Inputs/FormCheckbox';
import { Description } from '@radix-ui/react-dialog';
import { Value } from '@radix-ui/react-select';

interface Categoria {
    id_categoria: number;
    nombre: string; 
    descripcion: string | null; 
    estado:Categoria;
}

interface EditProps {
    categoria: Categoria;
}

export default function Edit({ categoria}: EditProps){
    const{ data, setData, put, processing, errors,} = useForm({
        nombre: categoria.nombre,
        descripcion: categoria.descripcion ?? '',
        estado: categoria.estado,
    });

    function submit(e:FormEvent) {
        e.preventDefault();

        put(`/categoria/${categoria.id_categoria}`);
    }
    return(
        <MainLayout>
            <div className='mx-auto max-w-3xl space-y-6'>
                <div>
                    <button
                        type="button"
                        onClick={()=>
                            router.visit('/categorias')
                        }
                        className='mb-4 flex items-center gap-2
                        text-sm text-gray-500
                        trasition hover:text-gray-900
                        '
                    >
                        <ArrowLeft size={18} />
                        Regresar
                    </button>

                    <h1 className='text-2xl font-bold text-gray-900'>
                        Editar Categoria
                    </h1>

                    <p className='mt-1 text-sm text-sm text-gray-500'>
                        Modificar la informacion de la categoría.
                    </p>
                </div>
                <form 
                    onSubmit={submit}
                    className='
                        space-y-6 rounded-xl
                        border border-gray-200
                        bg-white p-6 shadow-sm'
                >
                    <FormInput 
                        label="Nombre"
                        type="text"
                        value={data.nombre}
                        onChange={(e)=>
                            setData('nombre', e.target,Value)
                        }
                        error={errors.nombre}
                    />
                    <FormTextarea
                        label="Descripcion"
                        value={data.descripcion}
                        onChange={(e)=>
                            setData('descripcion', e.target,Value)
                        }
                        error={errors.descripcion}
                        rows={4}
                    />
                    <FormCheckbox
                        id="estado"
                        label="Categoria activa"
                        checked={data.estado}
                        onChange={(e)=>
                            setData('estado', e.target.value)
                        }
                    />
                </form>
            </div>
        </MainLayout>
    )
}