import { FormEvent } from 'react';
import { router, useForm } from '@inertiajs/react';
import { ArrowLeft, Save } from 'lucide-react';

import MainLayout from '@/components/layout/MainLayout';
import PrimaryButton from '@/components/Buttons/PrimaryButton';
import FormInput from '@/components/Inputs/FormInput';
import FormTextarea from '@/components/Inputs/FormTextarea';
import FormCheckbox from '@/components/Inputs/FormCheckbox';

export default function Create() {
    const { data, setData, post, processing, errors } = useForm({
        nombre: '',
        descripcion: '',
        estado: true,
    });

    function submit(e: FormEvent) {
        e.preventDefault();

        post('/categorias');
    }
    
    return (
        <MainLayout>
            <div className='mx-auto max-w-3xl space-y-6'>
                <div>
                    <button
                        type="button"
                        onClick={() => router.visit('/categorias')}
                        className="mb-4 flex item-center gap-2 text-sm text.gary-500 hover:text-gray-900"
                    >
                        <ArrowLeft size={18} />
                        Regreasar
                    </button>

                    <h1 className="text-2xl font-bold text-gray-900">
                        Nueva categoría
                    </h1>

                    <p className="mt-1 text-sm text-gary-500">
                        Registrar una nueva categoria de producto
                    </p>
                </div>

                <form 
                    onSubmit={submit}
                    className="space-y-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm"    
                >
                    <FormInput
                        label="Nombre"
                        type="text"
                        value={data.nombre}
                        onChange={(e) => 
                            setData (
                                'nombre', e.target.value
                            )
                        }
                        error={errors.nombre}
                        placeholder='Ej.Bebidas'
                    />
                    <FormTextarea
                        label="Descripción"
                        value={data.descripcion}
                        onChange={(e) => 
                            setData(
                                'descripcion',
                                e.target.value
                            )
                        }
                        error={errors.descripcion}
                        placeholder='Descripción de la caegoria'
                        rows={4}
                    />
                    <FormCheckbox
                        id="estado"
                        label="Categoria activa"
                        checked={data.estado}
                        onChange={(e) =>
                            setData(
                                'estado',
                                e.target.checked
                            )
                        }
                    />
                    <div className='flex justify-end'>
                        <PrimaryButton
                            type="submit"
                            disabled={processing}
                        >
                            <span className='flex item-center gap-2'>
                                <Save size={18} />
                                    {processing
                                        ? 'Guardando...'
                                        :'Guardar categoria'}
                                
                            </span>
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </MainLayout>
    );
}