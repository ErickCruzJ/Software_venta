import { FormEvent } from "react";
import { router, useForm } from "@inertiajs/react";
import { ArrowLeft, Save } from "lucide-react";

import PrimaryButton from "@/components/Buttons/PrimaryButton";
import FormInput from "@/components/Inputs/FormInput";
import FormTextarea from "@/components/Inputs/FormTextarea";
import FormCheckbox from "@/components/Inputs/FormCheckbox";

interface FormularioRol{
    nombre: string;
    descripcion: string;
    estado: boolean;
}

export default function Create() {

    const {
        data,
        setData,
        post,
        errors,
    } =
}