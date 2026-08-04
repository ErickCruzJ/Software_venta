import { Head, router } from "@inertiajs/react";
import { useEffect, useState } from 'react';
import { useForm } from 'react-hook-form';
import { zodResolver } from "@hookform/resolvers/zod";
import { z } from 'zod';

import PrimaryButton from "@/components/Buttons/PrimaryButton";

import FormInput from "@/components/Inputs/FormInput";
import FormDate from "@/components/Inputs/FormDate";
import FormFile from "@/components/Inputs/FormFile";
import FormSelect from "@/components/Inputs/FormSelect";


const schema = z.object({
    nombre: z.string().min(1, 'El nombre es obligatorio'),
    apellido_paterno: z.string().min(1,'El apellido paterno es obligatorio'),
    apellido_materno:z.string().optional(),
    calle: z.string().min(1,'Este campo es obligatorio. '),
    numero: z.string().min(1,'Este campo es obligatorio. '),
    codigo_postal: z.string().min(1,'Este campo es obligatorio. '),
    colonia: z.string().min(1,'Este campo es obligatorio. '),
    alcaldia: z.string().min(1,'Este campo es obligatorio. '),
    ciudad: z.string().min(1,'Este campo es obligatorio. '),
    telefono: z.string().min(1,'Este campo es obligatorio. '),
    correo: z.string().email('Ingresa un corro valido'),
    fecha_contratacion: z.string().min(1,'Este campo es obligatorio. '),
    estado: z.string().min(1,'Seleccionar un estado.'),
    foto: z.instanceof(File).optional(),
});
type FormData = z.infer<typeof schema>;

interface Empleado{
    id_empleado: number;
    nombre: string;
    apellido_paterno: string;
    apellido_materno?: string;
    calle: string;
    numero: string;
    codigo_postal: string;
    colonia: string;
    alcaldia: string;
    ciudad: string;
    telefono: string;
    correo:string;
    fecha_contratacion: string;
    estado:string;
    foto?: string;
}

interface Props{
    empleado: Empleado;
}

export default function Edit({empleado}: Props){
    const{
        register,
        handleSubmit,
        setValue,
        formState:{errors},
    }=useForm<FormData>({
        resolver: zodResolver(schema),
        defaultValues:{
            nombre: empleado.nombre,
            apellido_paterno: empleado.apellido_paterno,
            apellido_materno: empleado.apellido_materno ?? "",

            calle: empleado.calle,
            numero: empleado.numero,
            codigo_postal: empleado.codigo_postal,
            colonia: empleado.colonia,
            alcaldia: empleado.alcaldia,
            ciudad: empleado.ciudad,

            telefono: empleado.telefono,
            correo: empleado.correo,
            
            fecha_contratacion: empleado.fecha_contratacion
                ? empleado.fecha_contratacion.split("T")[0]
                :"",

            estado: empleado.estado,
            
            foto: undefined,
        },
    });

    const [processing, setProcessing] = useState(false);

    const [preview, setPreview] = useState<string | null>(null);

    useEffect(()=>{
        if(empleado.foto){
            setPreview(`/storage/${empleado.foto}`);
        }
    }, [empleado]);

    const onSubmit = (data: FormData) => {
        
        setProcessing(true);

        const datos = {
            ...data,
            _method: "put",
        };
        if(!data.foto) {
            delete datos.foto;
        }

        router.post (
            `/empleado/${empleado.id_empleado}`,
            datos,
            {
                forceFormData: true,
                onFinish:() => {
                    setProcessing(false);
                },
            }
        );
    };
    return(
        <>
            <Head title="Editar Empleado"/>

            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                        Editar empleado
                    </h1>
                    <p className="text-sm text-gray-500 dark:text-gray-400">
                        Actuañiza la información del empleado.
                    </p>
                </div>
                <form
                    onSubmit={handleSubmit(onSubmit)}
                    className="space-y-8"
                >
                    {/*Datos personales*/}
                    <div className="rounded-xl border bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">

                        <h2 className="mb-5 text-lg font-semibold">
                            Datos personales
                        </h2>

                        <div className="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <FormInput
                                label="Nombre"
                                {...register("nombre")}
                                error={errors.nombre?.message}
                            />
                            <FormInput
                                label="Apellido paterno"
                                {...register("apellido_paterno")}
                                error={errors.apellido_paterno?.message}
                            />
                            <FormInput
                                label="Apellido materno"
                                {...register("apellido_materno")}
                                error={errors.apellido_materno?.message}
                            />
                            <FormInput
                                label="Telefono"
                                {...register("telefono")}
                                error={errors.telefono?.message}
                            />
                            <FormInput
                                label="Correo electronico"
                                type="email"
                                {...register("correo")}
                                error={errors.correo?.message}
                            />
                            <FormDate
                                label="Fecha de contratacion"
                                {...register("fecha_contratacion")}
                                error={errors.fecha_contratacion?.message}
                            />
                            <FormSelect
                                label="Estado"
                                {...register("estado")}
                                error={errors.estado?.message}
                            >
                                <option value="Activo"> Activo</option>
                                <option value="Suspendido">Suspendido</option>
                                <option value="Vacaciones">Vacaciones</option>
                                <option value="Baja temporal">Baja temporal</option>
                                <option value="Baja,">Baja</option>
                            </FormSelect>
                            <FormFile
                                label="Fotografia"
                                accept="image/*"
                                onFileChange={(file) => {
                                    setValue("foto", file, {
                                        shouldValidate: true,
                                        shouldDirty: true,
                                    });
                                    if (file){
                                        setPreview(
                                            URL.createObjectURL(file)
                                        );
                                    }
                                }}
                                error={errors.foto?.message}
                            />
                            {preview &&(
                                <div className="mt-3">
                                    <img
                                        src={preview}
                                        alt="Vista previa"
                                        className="h-32 w-32 rounded-lg border object-cover"
                                    />
                                </div>
                            )}
                        </div>
                    </div>
                    {/*Direccion */}
                    <div className="rounded-xl border bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <h2 className="mb-5 text-lg font-semibold">
                            Dirección
                        </h2>
                        <div className="grid grid-cols-1 gap-5 md:grid-cols-2 ">
                            <FormInput
                                label="Calle"
                                {...register('calle')}
                                error={errors.calle?.message}
                            />
                            <FormInput
                                label="Numero"
                                {...register('numero')}
                                error={errors.numero?.message}
                            />
                            <FormInput
                            label="Código Postal"
                            {...register('codigo_postal')}
                            error={errors.codigo_postal?.message}
                            />
                            <FormInput
                                label="Colonia"
                                {...register('colonia')}
                                error={errors.colonia?.message}
                            />
                            <FormInput
                                label="Alcaldía / Municipio"
                                {...register("alcaldia")}
                                error={errors.alcaldia?.message}
                            />

                            <FormInput
                                label="Ciudad"
                                {...register("ciudad")}
                                error={errors.ciudad?.message}
                            />
                        </div>
                    </div>
                    {/*Botones */}
                    <div className="flex justify-end gap-4">
                        <PrimaryButton
                            type="submit"
                            disabled={processing}
                        >
                            {processing
                                ?'Actualizando....'
                                :'Actualizar empleado'}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </>
    )
}