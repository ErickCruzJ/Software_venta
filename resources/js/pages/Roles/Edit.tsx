import { Head, router } from "@inertiajs/react";
import { useState } from "react";
import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { z } from "zod";

import PrimaryButton from "@/components/Buttons/PrimaryButton";
import FormInput from "@/components/Inputs/FormInput";
import FormTextarea from "@/components/Inputs/FormTextarea";
import FormCheckbox from "@/components/Inputs/FormCheckbox";

import { FormActions, FormCard, FormPage, } from "@/components/Forms";

const schema = z.object({
    nombre: z .string().min(1,"Este campo es obligatorio").max(100,"Maximo 100 caracteres"),
    descripcion: z.string().min(1,"Este campo es obligatorio").max(255,"Maximo 255 caracteres"),
    estado: z.boolean(),
});
type FormData = z.infer<typeof schema>;

interface Rol{
    id_rol: number;
    nombre: string;
    descripcion: string;
    estado: boolean;
}

interface Props{
    rol: Rol;
}

export default function Edit({rol}:Props){
    const{
        register,
        handleSubmit,
        setValue,
        formState:{errors},
    } = useForm<FormData>({
        resolver: zodResolver(schema),
        defaultValues:{
            nombre: rol.nombre,
            descripcion: rol.descripcion,
            estado: rol.estado,
        },
    });

    const [processing, setProcessing] = useState(false);

    const onSubmit = (data: FormData) => {
        setProcessing(true);

        router.put(
            `/roles/${rol.id_rol}`,
            data,
            {
                onFinish: ()=>{
                    setProcessing(false);
                },
            }
        );
    };
     return(
        <>
            <Head title="Nuevo Rol"/>

            <FormPage
                title="Nuevo Rol"
                description="Registro de nuevos roles del sistema"
            >
                <form
                    onSubmit={handleSubmit(onSubmit)}
                    className="space-y-8"
                >
                    <FormCard
                        title="Información del Rol"
                        columns={1}
                    >
                        <FormInput
                            label="Nombre"
                            {...register('nombre')}
                            error={errors.nombre?.message}
                        />
                        <FormTextarea
                            label="Descripcion"
                            {...register('descripcion')}
                            error={errors.descripcion?.message}
                        />
                        <FormCheckbox
                            label="Rol activo"
                            {...register("estado")}
                            error={errors.estado?.message}
                        />
                    </FormCard>
                    <FormActions>
                        <PrimaryButton
                            type="submit"
                            disabled={processing}
                        >
                            {processing ? "Guardando..." :"Guardar"}
                        </PrimaryButton>
                    </FormActions>
                </form>
            </FormPage>
        </>
    );
}
