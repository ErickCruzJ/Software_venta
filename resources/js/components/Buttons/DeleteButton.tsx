import { ButtonHTMLAttributes } from "react";
import { Trash2 } from 'lucide-react';

interface DeleteButtonProps 
    extends ButtonHTMLAttributes<HTMLButtonElement> {}

export default function DeleteButton({
    className = '',
    ...props
}: DeleteButtonProps){
    return(
        <button
            type="button"
            title="Eliminar"
            {...props}
            className={`
                rounded-lg p-2 text-red-600
                transition hover:bg-red-50
                ${className}   
            `}
        >
            <Trash2 size={18} />
        </button>
    );
}