import { Head, router } from "@inertiajs/react";
import { useState } from 'react';
import { useForm } from 'react-hook-form';
import { zodResolver } from "@hookform/resolvers/zod";
import { z } from "zod";

import PrimaryButton from "@/components/Buttons/PrimaryButton";

import FormInput from "@/components/Inputs/FormInput";
import FormSelect from "@/components/Inputs/FormSelect";

import { FormActions, FormCard, FormPage, } from "@/components/Forms";

const schema = z.object({
    id_rol: z.number(),
    nombre_usuario: z.string().min(6, "Minimo 6 caracteres").max(50,"Maximo 50 caracteres"),
    password: z.string().min(8, "La contraseña debe tener al menos 8 caracteres"),
    password_confirmation: z.string(),
});
type FormData = z.infer<typeof schema>;

interface Empleado {
    id_empleado: number;
    nombre: string;
    apellido_paterno: string;
    apellido_materno: string;
    correo: string;
    foto?: string;
}
interface Rol{
    id_rol: number;
    nombre: string;
    descripcion: string;
}

interface Props{
    empleado: Empleado;
    roles: Rol[];
}

export default function Create({
    empleado,
    roles,
}: Props){
    const {
        register,
        handleSubmit,
        watch,
        formState: {errors},
    }=useForm<FormData>({
        resolver: zodResolver(schema),

    });

    const [processing, setProcessing] = useState(false);

    const onSubmit = (data: FormData) => {
        setProcessing(true);
        router.post(
            "/usuarios",
            {
                ...data,
                id_empleado: empleado.id_empleado,
            },
            {
                onSuccess: () => {
                    console.log("Usuario creado correctamente. ");
                },
                onError: (errors) => {
                    console.error(errors);
                },
                onFinish: () => {
                    setProcessing(false);
                },
            }
        );
    };

    const rolSeleccionado = roles.find(
        (rol) => rol.id_rol === watch("id_rol")
    )

    return(
        <>
            <Head title="Nuevo usuario"/>

            <FormPage
                title = "Nuevo Usuario"
                description="Registro del Usuario para inicio del sistema"
                >
                    <form
                        onSubmit={handleSubmit(onSubmit, (errors)=>console.log(errors))}
                        className="space-y-8"
                    >
                        <FormCard
                            title="Informacion del Emoleado"
                            columns={1}
                        >
                            <div className="flex items-center gap-5">
                                {empleado.foto?(
                                    <img 
                                        src={`/storage/${empleado.foto}`} 
                                        alt="Empleado" 
                                        className="h-20 w-20 rounded-full border-2 border-gray-200 object-cover shadow-sm"
                                    />
                                ):(
                                    <div className="flex h-20 w-20 items-center justify-center rounded-full bg-blue-100 text-3xl font-bold text-blue-700 shadow-sm ">
                                        {empleado.nombre.charAt(0).toUpperCase()}
                                    </div>
                                )}
                                <div className="space-y-1">
                                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                        {empleado.nombre}{" "}
                                        {empleado.apellido_paterno}{" "}
                                        {empleado.apellido_materno}

                                    </h3>
                                    <p className="text-sm text-gray-500 dark:text-gray-400">
                                        {empleado.correo}
                                    </p>
                                    <p className="text-xs text-gray-400">
                                        ID del empleado: {empleado.id_empleado}
                                    </p>
                                </div>
                            </div>
                
                        </FormCard>
                        <FormCard
                            title="Seleccion de Rol"
                            columns={1}
                        >
                            <FormSelect
                                label="Rol"
                                {...register("id_rol",{
                                    valueAsNumber: true,
                                })}
                                error={errors.id_rol?.message}
                            >
                                <option value="">
                                    Seleccione un rol
                                </option>
                                {roles.map((rol) => (
                                    <option
                                        key={rol.id_rol}
                                        value={rol.id_rol}
                                    >
                                        {rol.nombre}
                                    </option>
                                ))}
                            </FormSelect>
                            {rolSeleccionado &&(
                                <div className="rounded-lg border border-blue -200 bg-blue-50 p-4">
                                    <h3 className="font-semibold text-blue-700">
                                        Descripcion del rol
                                    </h3>
                                    <p className="mt-2 text-sm text-blue-600">
                                        {rolSeleccionado.descripcion}
                                    </p>
                                </div>
                            )}
                        </FormCard>
                        <FormCard
                            title="Registro del Usuario"
                            columns={2}
                        >
                            <FormInput
                                label = "Nombre de Usuario"
                                {...register("nombre_usuario")}
                                error={errors.nombre_usuario?.message}
                            />
                            <FormInput 
                                label="Contraseña"
                                type = "password"
                                {...register("password")}
                                error={errors.password?.message}
                            />
                            <FormInput
                                label="Cofirma contraseña"
                                type="password"
                                {...register("password_confirmation")}
                                error={errors.password_confirmation?.message}
                            />
                        </FormCard>
                        <FormActions>
                            <PrimaryButton
                                type="submit"
                                disabled={processing}
                            >
                                {processing ?"Creando...." :"Crear usuario"}
                            </PrimaryButton>
                        </FormActions>
                    </form>
                </FormPage>        
        </>
    );
}