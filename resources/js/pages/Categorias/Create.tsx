import { FormEvent, useState } from 'react';
import { router, useForm } from '@inertiajs/react';
import { ArrowLeft, Save } from 'lucide-react';

import MainLayout from '@/components/layout/MainLayout';
import PrimaryButton from '@/components/Buttons/PrimaryButton';
import FormInput from '@/components/Inputs/FormInput';
import FormTextarea from '@/components/Inputs/FormTextarea';
import FormCheckbox from '@/components/Inputs/FormCheckbox';

export default function Create() {
    const [nombreError, setNombreError] = useState('');
    const [descripcionErrores, setDescripcionErrores] = useState('');
    const { data, setData, post, processing, errors } = useForm({
        nombre: '',
        descripcion: '',
        estado: true,
    });


    function validarNombre(nombre: string): boolean{
        const regex = /^[A-Za-zÁÉÍÓÚáéíóúÜüÑñ0-9\s]+$/u;

        if (!nombre.trim()){
            setNombreError(
                'El nombre de la categoria es obligatorio.'
            );
            return false;
        }

        if (!regex.test(nombre)){
            setNombreError(
                'El nombre contiene carateres no permitidos. Solo se aceptan letras, numeros y espacios'
            );
            return false;
        }
        setNombreError('');
        return true;
    }
    
    function validarDescripcion(descripcion: string): boolean{
        const regex = /^[A-Za-zÁÉÍÓÚáéíóúÜüÑñ0-9\s.,()-]*$/u;

        if (!regex.test(descripcion)) {
            setDescripcionErrores(
                'La descripción contiene caracteres no permitidos. '
            );
            return false;
        }

        setDescripcionErrores('');
        return true;
    }

    function submit(e:FormEvent) {
        e.preventDefault();

        const nombreValido = validarNombre(data.nombre);

        const descripcionValida = validarDescripcion(data.descripcion);

        if (!nombreValido || !descripcionValida){
            return;
        }

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
                        onChange={(e) => {
                            const valor = e.target.value;

                            setData('nombre', valor);
                            validarNombre(valor);
                        }}
                        error={
                            nombreError || errors.nombre
                        }
                        maxLength={100}
                    />
                    <FormTextarea
                        label="Descripción"
                        value={data.descripcion}
                        onChange={(e) => {
                            const valor = e.target.value;

                            setData('descripcion', valor);
                            validarDescripcion(valor);
                        }}
                        error={
                            descripcionErrores || errors.descripcion
                        }
                        rows={4}
                        maxLength={255}
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