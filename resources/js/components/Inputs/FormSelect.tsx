import { SelectHTMLAttributes, ReactNode } from "react";
import FormError from "./FormError";

interface FormSelectProps
    extends SelectHTMLAttributes<HTMLSelectElement>{
    label: string;
    error?: string;
    children: ReactNode;
}

export default function FormSelect({
    label,
    error,
    children,
    className = '',
    ...props
}: FormSelectProps){
    return(
        <div>
            <label className="mb-2 block text-sm font-medium text-gray-700">
                {label}
            </label>

            <select 
                className={`
                    w-full rounded-lg border
                    bg-white px-4 py-2
                    text-gray-900
                    outline-none transition
                    ${
                        error
                            ?'border-red-500 focus:border-red-500 focus:ring-red-100'
                            :'border-gray-300 focus:border-blue-500 focus:ring-blue-100'
                    }
                    ${className}
                `}
            >
                {children}
            </select>
            <FormError message={error}/>
        </div>
    );
}