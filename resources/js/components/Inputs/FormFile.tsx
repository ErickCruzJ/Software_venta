import { InputHTMLAttributes } from "react";
import FormError from "./FormError";

interface FormFileProps
    extends Omit<InputHTMLAttributes<HTMLInputElement>,'type'| 'onChange'>{
    label: string;
    error?: string;
    onFileChange?: (file: File | undefined)=> void; 

}

export default function FormFile({
    label, 
    error,
    className ='',
    onFileChange,
    ...props
}: FormFileProps){
    return(
        <div className="space-y-1">
            <label className='block text-sm font-medium text-gray-700'>
                {label}
            </label>

            <input 
                type="file"
                {...props}
                onChange={(e) => {
                    const file = e.target.files?.[0];
                    onFileChange?.(file);
                }}
                className={`
                    block
                    w-full
                    rounded-lg
                    border
                    bg-white
                    px-3
                    py-2
                    text-sm
                    text-gray-700
                    file:mr-4
                    file:rounded-md
                    file:border-0
                    file:bg-blue-600
                    file:px-4
                    file:py-2
                    file:text-sm
                    file:font-medium
                    file:text-white
                    hover:file:bg-blue-700
                    ${
                        error
                            ?'border-red-500'
                            :'border-gray-300'
                    }
                    ${className}
                `}
            />
            <FormError message={error}/>
        </div>
    );
}