import { SelectHTMLAttributes } from "react";
import FormError from "./FormError";

interface Option{
    value: string;
    label: string;
}

interface FormSelectProps
    extends SelectHTMLAttributes<HTMLSelectElement>{
    label: string;
    options: Option[];
    error?: string;
}

export default function FormSelect({
    label, 
    options,
    error,
    className ='',
    ...props
}: FormSelectProps){
    return(
        <div className="space-y-1">
            <label className="block text-sm font-medium text-gray-700">
                {label}
            </label>
            <select 
                {...props}
                className={`
                    w-full
                    rounded-lg
                    border 
                    px-3
                    py-2
                    text-sm
                    shadow-sm
                    outline-none
                    trasition
                    ${
                        error
                            ? 'border-red-500 focus:border-red-500  focus:ring-2 focus:ring-red-200'
                            : 'border-gray-300 focus: border-blue-500 focus:ring-2 focus:ring-blue-200'
                    }
                    ${className}
                `}
            >
                <option value="">
                    Seleccione una opción
                </option>

                {options.map((option)=>(
                    <option
                        key={option.value}
                        value={option.value}
                    >
                        {option.label}
                    </option>
                ))}
            </select>
            <FormError message={error}/>
        </div>
    );
}