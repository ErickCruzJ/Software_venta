import { Description } from "@radix-ui/react-dialog";

export interface ValidationResult{
    valid:boolean;
    message: string;
}
const REGEX = {
    nombrePersona: /^[A-Za-zÁÉÍÓÚáéíóúÜüÑñ\s]+$/u,

    apellido: /^[A-Za-zÁÉÍÓÚáéíóúÜüÑñ]+$/u,

    nombreGeneral: /^[A-Za-zÁÉÍÓÚáéíóúÜüÑñ0-9\s.-]+$/u,

    descripcion: /^[A-Za-zÁÉÍÓÚáéíóúÜüÑñ0-9\s.,()/-]*/u,
};
const MESSAGE ={
    REQUIRED: 'Este campo es obligatorio. ',

    INVALID_GENERAL_NAME: 'Solo se permite letras, números y espacios',

    INVALID_PERSON_NAME: 'Solo se permiten letras y numeros',

    INVALID_LASTNAME: 'Solo se permiten letras.',

    INVALID_DESCRIPTION: 'La descripción contiene caracteres no permitidos.',
};
export function validarNombreGeneral(
    nombre: string
): ValidationResult{
    if(!nombre.trim()){
        return{
            valid: false,
            message: MESSAGE.REQUIRED,
        };
    }
    if(REGEX.nombreGeneral.test(nombre)){
        return{
            valid: false,
            message: MESSAGE.INVALID_GENERAL_NAME,
        };
    }
    return{
        valid:true,
        message: '',
    };
}

export function validarNombrePersona(
    nombre:string
): ValidationResult{
    if(!nombre.trim()){
        return{
            valid: false,
            message: MESSAGE.REQUIRED, 
        };
    }
    if(!REGEX.nombrePersona.test(nombre)){
        return{
            valid: false,
            message: MESSAGE.INVALID_PERSON_NAME ,
        };
    }
    return {
        valid: true,
        message: '',

    };
}
export function validarApellido(
    apellido:string,
    required: boolean = true
):ValidationResult{
    if(!required && !apellido.trim()){
        return{
            valid:true,
            message: '',
        };
    }
    if(!apellido.trim()){
        return{
            valid: true,
            message: MESSAGE.REQUIRED,

        };
    }
    if(REGEX.apellido.test(apellido)){
        return{
            valid: false,
            message: MESSAGE.INVALID_LASTNAME
        };
    }
    return{
        valid:true,
        message: '',
    };
}

export function validarDescripcion(
    descripcion: string
): ValidationResult{
    if(!descripcion.trim()){
        return{
            valid: true,
            message:'',
        };
    }
    if(REGEX.descripcion.test(descripcion)){
        return{
            valid: false,
            message:MESSAGE.INVALID_DESCRIPTION,
        };
    }
    return{
        valid: true,
        message: '',
    };
}