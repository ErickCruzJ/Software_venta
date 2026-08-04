import { Head, router } from "@inertiajs/react";
import { useState } from "react";
import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { z } from "zod";

import PrimaryButton from "@/components/Buttons/PrimaryButton";
import FormInput from "@/components/Inputs/FormInput";
import FormSelect from "@/components/Inputs/FormSelect";
import { FormActions, FormPage, FormCard } from "@/components/Forms";
import Avatar from "@/components/Avatar/Avatar";

const schema = z.object({
    id_rol: z.number(),
    nombre_usuario: z.string().min(6, "Minimo 6 caracteres").max(50,"Maximo 50 caracteres"),
    password: z.string().min(8, "La contraseña debe tener al menos 8 caracteres").optional().or(z.literal("")),
    password_confirmation: z.string().optional().or(z.literal("")),
}).refine(
    (data) => !data.password || data.password === data.password_confirmation,
    {
        message: "Las contraseñas no coinciden",
        path: ["password_confirmation"],
    }
);
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
interface Usuario{
    id_usuario: number;
    id_rol: number;
    nombre_usuario: string;
}

interface Props{
    empleado: Empleado | null;
    roles: Rol[];
    usuario: Usuario;
}
export default function Edit({
    empleado,
    roles,
    usuario,
}: Props){
    const{
        register,
        handleSubmit,
        watch,
        formState: {errors},
    }=useForm<FormData>({
        resolver: zodResolver(schema),

        defaultValues:{
            id_rol: usuario.id_rol,
            nombre_usuario: usuario.nombre_usuario
        },
    });

    const esSinEmpleado = empleado === null;

    const [processing, setProcessing] = useState(false);

    const onSubmit = (data: FormData) => {
        setProcessing(true);

        router.put(
            `/usuarios/${usuario.id_usuario}`,
            data,
            {
                onFinish: () => setProcessing(false),
            }
        );
    };
    const rolSeleccionado = roles.find(
        (rol) => rol.id_rol === watch("id_rol")
    )
    return(
        <>
            <Head title="Editar usuario"/>
            <FormPage
                title = "Editar Usuario"
                description="Modificacion de la infromacion del usuario."
            >
                <form
                    onSubmit={handleSubmit(onSubmit)}
                    className="space-y-8"
                >
                    <FormCard
                        title={
                            esSinEmpleado
                                ?"Información del Usuario"
                                :"Información del Empleado"                        
                        }
                        columns={1}
                    >
                        {esSinEmpleado ? (
                            <div className="flex items-center gap-5">
                                <Avatar
                                    nombre="Usuario"
                                    size="lg"
                                />
                                <div>
                                    <h3 className="text-lg font-semibold">
                                        Usuario sin empleado
                                    </h3>
                                    <p className="text-lg font-semibold">
                                        Esta cuenta no está asociada ningún empleado.
                                    </p>
                                </div>
                            </div>
                        ):(
                            <div className="flex items-center gap-5">
                                <Avatar
                                    nombre={empleado.nombre}
                                    foto={empleado.foto}
                                    size = "lg"
                                />
                                <div>
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
                        )}
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
                            {roles.map((rol)=>(
                                <option
                                    key={rol.id_rol}
                                    value={rol.id_rol}
                                >
                                    {rol.nombre}
                                </option>
                            ))}
                        </FormSelect>
                        {rolSeleccionado &&(
                            <div className="rounded-lg border border-blue-200 bg-blue-50 p-4">
                                <h3 className="font-semibold text-blue-700 ">
                                    Descripcion del rol
                                </h3>
                                <p className="mt-2 text-sm text-blue-600">
                                    {rolSeleccionado.descripcion}
                                </p>
                            </div>
                        )}
                    </FormCard>
                    <FormCard
                        title="Credenciales de acceso"
                        columns={2}
                    >
                        <FormInput
                            label="Nombre de usuario"
                            {...register("nombre_usuario")}
                            error={errors.nombre_usuario?.message}
                        />
                        <FormInput
                            label="Nueva Contraseña"
                            type="password"
                            {...register("password")}
                            error={errors.password?.message}
                        />
                        <FormInput
                            label="Confrima nueva contraseña"
                            type="password"
                            {...register("password_confirmation")}
                            error={errors.password_confirmation?.message}
                        />
                        <p className="text-sm text-gray-500 dark:text-gray-400">
                            Deja ambos campos vacíos si no desea cambiar la contraseña.
                        </p>
                    </FormCard>
                     <FormActions>
                        <PrimaryButton
                            type = "submit"
                            disabled={processing}
                        >
                            {processing
                                ?"Guardando..."
                                :"Guardar cambios"
                            }
                        </PrimaryButton>
                    </FormActions>
                </form>
            </FormPage>
        </>
    )

}