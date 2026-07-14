import { InputHTMLAttributes } from "react";

interface FormInputProps
    extends InputHTMLAttributes<HTMLInputElement> {
        label: string;
        error?: string;
    }

    export default function FormInput({
        label,
        error,
        className = '',
        ...props
    }: FormInputProps){
        return (
            <div>
                <label className="mb-2 block text-sm font-medium text-gray-700">
                    {label}
                </label>

                <input 
                    {...props}
                    className={`
                        w-full rounded-lg border 
                        bg-white px-4 py-2
                        text-gray-900
                        placeholder: text-gray-200
                        outline-none transition
                        focus:ring-2
                        ${
                            error
                                ? 'border-red-500 focus:border-red-500 focus:ring-red-100'
                                : 'border-gray-300 focus:border-blue-500 focus:ring-blue-100'
                        }
                        ${className}
                    `}
                />
                {error && (
                    <p className="mt-q text-sm text-red-600">
                        {error}
                    </p>
                )}
            </div>
        );
    }