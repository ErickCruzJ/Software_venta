import { ButtonHTMLAttributes } from "react";
import { Edit } from 'lucide-react';

interface EditButtonProps
    extends ButtonHTMLAttributes<HTMLButtonElement> {}

export default function EditButton({
    className = '',
    ...props
}: EditButtonProps) {
    return (
        <button
            type="button"
            title="Editar"
            {...props}
            className={`
                rounded-lg p-2 text-blue-600
                transition hover:bg-blue-50
                ${className}    
            `} 
        >
            <Edit size={18} /> 
        </button>
    );
}