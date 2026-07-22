import { InputHTMLAttributes } from "react";
import FormError from "./FormError";
import { EraserIcon } from "lucide-react";

interface FormDateProps
    extends InputHTMLAttributes<HTMLInputElement>{
    label: string;
    error?: string;
}

export default function FormDate({
    label,
    error,
    className = '',
    ...props
}: FormDateProps){
    return(
        <div className="space-y-1">
            <label className="block text-sm font-medium text-gray-700">
                {label}
            </label>

            <input
                type="date"
                {...props}
                className={`
                    w-full
                    rounded-lg 
                    border
                    bg-white
                    px-3
                    py-2
                    text-sm
                    shadow-sm
                    outline-none
                    transition
                    ${
                        error 
                        ?'border-red-500 focus:border-red-500 focus:ring-2 focus:ring-red-200'
                        :'border-gray-300 focus:border-blue-500 focus: ring-2 focus:ring-blue-200'
                    }
                    ${className}
                `} 
            />
            <FormError message={error}/>
        </div>
    );
}