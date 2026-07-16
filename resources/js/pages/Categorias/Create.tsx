import { FormEvent, useState } from 'react';
import { router, useForm } from '@inertiajs/react';
import { ArrowLeft, Save } from 'lucide-react';
import {verificarConexion} from '@/utils/connection';
import { validarNombreGeneral, validarDescripcion } from '@/validators';

import PrimaryButton from '@/components/Buttons/PrimaryButton';
import FormInput from '@/components/Inputs/FormInput';
import FormTextarea from '@/components/Inputs/FormTextarea';
import FormCheckbox from '@/components/Inputs/FormCheckbox';

export default function Create() {
    const [nombreError, setNombreError] = useState('');
    const [descripcionError, setDescripcionError] = useState('');
    const { data, setData, post, processing, errors } = useForm({
        nombre: '',
        descripcion: '',
        estado: true,
    });


    function validarNombreCampo(nombre: string): boolean{
        const resultado = validarNombreGeneral(nombre);
        setNombreError(resultado.message);
        return resultado.valid;
    }
    
    function validarDescripcionCampo(descripcion: string): boolean{
       const resultado = validarDescripcion(descripcion);
       setDescripcionError(resultado.message);
       return resultado.valid;
    }

    function submit(e:FormEvent) {
        e.preventDefault();

        const nombreValido = validarNombreCampo(data.nombre);

        const descripcionValida = validarDescripcionCampo(data.descripcion);

        if (!nombreValido || !descripcionValida){
            return;
        }

        if(!verificarConexion()){
            return
        }
        post('/categorias');
    }

    return (
        <>
            <div className='mx-auto max-w-3xl space-y-6'>
                <div>
                    <button
                        type="button"
                        onClick={() => router.visit('/categorias')}
                        className="mb-4 flex items-center gap-2 text-sm text-gary-500 hover:text-gray-900"
                    >
                        <ArrowLeft size={18} />
                        Regresar
                    </button>

                    <h1 className="text-2xl font-bold text-gray-900">
                        Nueva categoría
                    </h1>

                    <p className="mt-1 text-sm text-gray-500">
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
                            validarNombreCampo(valor);
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
                            validarDescripcionCampo(valor);
                        }}
                        error={
                            descripcionError || errors.descripcion
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
                            <span className='flex items-center gap-2'>
                                <Save size={18} />
                                    {processing
                                        ? 'Guardando...'
                                        :'Guardar categoria'}
                                
                            </span>
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </>
    );
}