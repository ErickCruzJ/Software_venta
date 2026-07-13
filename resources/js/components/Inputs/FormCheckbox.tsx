import { InputHTMLAttributes } from "react";

interface FormCheckboxProps
    extends Omit<
        InputHTMLAttributes<HTMLInputElement>,
        'type'
        >{
            label: string;
}

export default function FormCheckbox({
    label, 
    id,
    className = '',
    ...props
}: FormCheckboxProps){
    return(
        <div className="flex items-center gap-3">
            <input 
                id={id}
                type="checkbox"
                {...props}
                className={`
                    h-4 w-4 rounded border-gray-300
                    ${className}
                `}
            />

            <label 
                htmlFor={id}
                className="text-sm text-gray-700"
            >
                {label}
            </label>
        </div>
    );
}