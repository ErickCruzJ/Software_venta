import { Head,router } from "@inertiajs/react";
import { useState } from "react";
import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { z } from "zod";

import PrimaryButton from "@/components/Buttons/PrimaryButton";
import FormInput from "@/components/Inputs/FormInput";

const schema = z.object({
    nombre_usuario: z.string().min(4, "Minimo 4 caracteres").max(50,"Maximo 50  carateres"),
    password: z.string().min(8,"La contraseña debe tener  al menos 8 caracteres"),
    password_confirmation: z.string(),
}).refine(
    (data)=> data.password === data.password_confirmation,
    {
        message: "Las contraselas no coinciden.",
        path: ["password_confirmation"],
    }
);
type FormData = z.infer<typeof schema>;

export default function Index(){
    const{
        register,
        handleSubmit,
        formState:{errors},
    }  = useForm<FormData>({
        resolver: zodResolver(schema),
    });

    const [processing, setProcessing] = useState(false);

    const onSubmit = (data: FormData) => {
        setProcessing(true);

        router.post(
            "/setup",
            data,
            {
                onFinish: () => setProcessing(false),
            }
        );
    };
    return(
        <>
            <Head title="Configuración inicial"/>

            <div className="min-h-screen flex items-center justify-center bg-gray-100 px-4">
                <div className="w-full max-w-md rounded-xl bg-white p-8 shadow">
                    <div className="text-2xl font-bold text-gray-900">
                        <h1 className="text-2xl font-bold text-gray-900">
                            Configuración inicial
                        </h1>

                        <p className=" mt-2 text-sm text-gray-600">
                            Crea el usuario administrador para comenzar a utilizar el sistema.
                        </p>
                    </div>

                    <form
                        onSubmit={handleSubmit(onSubmit)}
                        className="space-y-6"
                    >
                        <FormInput
                            label="Nombre de usuario"
                            {...register("nombre_usuario")}
                            error={errors.nombre_usuario?.message}
                        />
                        <FormInput
                            label="Contraseña"
                            type="password"
                            {...register("password")}
                            error={errors.password?.message}
                        />
                        <FormInput
                            label="Confirmar contraseña"
                            type="password"
                            {...register("password_confirmation")}
                            error={errors.password_confirmation?.message}
                        />
                        <PrimaryButton
                            type="submit"
                            disabled={processing}
                            className="w-full"
                        >
                            {processing
                                ?"Creando administrador..."
                                :"Crear administrador"}
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </>
    )
}