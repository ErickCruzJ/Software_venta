import { FormEvent } from 'react';
import { router, useForm } from '@inertiajs/react';
import { ArrowLeft, Save} from 'lucide-react';

import MainLayout from '@/components/layout/MainLayout';
import PrimaryButton from '@/components/Buttons/PrimaryButton';
import FormInput from '@/components/Inputs/FormInput';
import FormTextarea from '@/components/Inputs/FormTextarea';
import FormCheckbox from '@/components/Inputs/FormCheckbox';

interface Categoria {
    id_categoria: number;
    nombre: string; 
    descripcion: string | null; 
    estado: boolean;
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

        put(`/categorias/${categoria.id_categoria}`);
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
                        className="mb-4 flex items-center gap-2
                        text-sm text-gray-500
                        transition hover:text-gray-900
                        "
                    >
                        <ArrowLeft size={18} />
                        Regresar
                    </button>

                    <h1 className='text-2xl font-bold text-gray-900'>
                        Editar Categoria
                    </h1>

                    <p className='mt-1 text-sm text-gray-500'>
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
                            setData('nombre', e.target.value)
                        }
                        error={errors.nombre}
                        required
                        maxLength={100}
                        pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\S]+"
                        title="Solo se permiten letras, números y espacios"
                    />
                    <FormTextarea
                        label="Descripcion"
                        value={data.descripcion}
                        onChange={(e)=>
                            setData('descripcion', e.target.value)
                        }
                        error={errors.descripcion}
                        rows={4}
                    />
                    <FormCheckbox
                        id="estado"
                        label="Categoria activa"
                        checked={data.estado}
                        onChange={(e)=>
                            setData('estado', e.target.checked)
                        }
                    />
                    <div className='flex justify-end'>
                        <PrimaryButton
                            type="submit"
                            disabled={processing}
                        >
                            <span className='flex items-center gap-2'>
                                <Save size={18}/> 
                                {processing
                                    ? 'Actualizando...'
                                    : 'Actualizar categoría'}   
                            </span>    
                        </PrimaryButton>    
                    </div>
                </form>
            </div>
        </MainLayout>
    )
}