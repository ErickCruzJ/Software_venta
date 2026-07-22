import { Head, router } from '@inertiajs/react'
import { zodResolver } from '@hookform/resolvers/zod';
import {useForm as useReactHookForm} from 'react-hook-form';
import { z } from 'zod';

import MainLayout from '@/components/layout/MainLayout';
import PrimaryButton from '@/components/Buttons/PrimaryButton';

import FormInput from '@/components/Inputs/FormInput';
import FormTextarea from '@/components/Inputs/FormTextarea';
import FormDate from '@/components/Inputs/FormDate';
import FormFile from '@/components/Inputs/FormFile';
import FormSelect from '@/components/Inputs/FormSelect'; 

const schema = z.object({
    nombre: z.string().min(1, 'El nombre es obligatorio'),
    apellido_paterno: z.string().min(1, 'El apellido es obligatorio'),
    apellido_materno: z.string().optional(),
    calle: z.string().min(1),
    numero: z.string().min(1),
    codigo_postal: z.string().min(1),
    colinia: z.string().min(1),
    alcaldia: z.string().min(1),
    ciudad: z.string().min(1),
    telefono: z.string().min(1),
    correo: z.string().email('Ingrese un correo váñido'),
    fecha_contratacion: z.string(),
    estado: z.string(),
    foto: z.any().optional(),
});
type FormData = z.infer<typeof schema>;

export default function Create(){

    const {
        register,
        handleSubmit,
        setValue,
        formState: {errors},
    }=useReactHookForm<FormData>({
        resolver:zodResolver(schema),
        defaultValues: {
            estado: 'Activo',
        },
    });

    const onSubmit = (data: FormData) => {
        router.post('/empleados',data,{
            forceFormData: true,
        });
    };
    return(
        <>
            <Head title='Nuevo empleado'/>
            <>
                <div className='space-y-6'>
                    <div>
                        <h1 className='text-2xl font-bold text-gary-900'>
                            Nuevo empledo
                        </h1>
                        <p className='text-sm text-gray-500'>
                            Registros de nuevos empleados
                        </p>
                    </div>
                    <form 
                        onSubmit={handleSubmit(onSubmit)}
                        className='space-y-8'
                    >
                        {/*Datos personales*/}
                        <div className='rounded-xl border bg-white p-6 shadow-sm'>
                            <h2 className='mb-5 text-lg font-semibold'>
                                Datos personales
                            </h2>
                            <div className='grid grid-cols-1 gap-5 md:grid-cols-2'>
                                <FormInput
                                    label="Nombre"
                                    {...register('nombre')}
                                    error={errors.nombre?.message}
                                />
                                <FormInput
                                    label="Apellido Paterno"
                                    {...register('apellido_paterno')}
                                    error={errors.apellido_paterno?.message}
                                />
                                <FormInput
                                    label="Apellido Materno"
                                    {...register('apellido_materno')}
                                    error={errors.apellido_materno?.message}
                                />
                                <FormInput
                                    label="Telefono"
                                    {...register('telefono')}
                                    error={errors.telefono?.message}
                                />
                                <FormInput
                                    label="Corrreo electronico"
                                    type='email'
                                    {...register('correo')}
                                    error={errors.correo?.message}
                                />
                                <FormDate
                                    label = "Fecha de  comtratacion"
                                    {...register('fecha_contratacion')}
                                    error={errors.fecha_contratacion?.message}
                                />

                            </div>

                        </div>
                    </form>
                </div>
               
            </>
        </>
    
    );
}


