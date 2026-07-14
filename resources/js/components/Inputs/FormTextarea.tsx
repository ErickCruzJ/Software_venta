import { TextareaHTMLAttributes } from "react";

interface FormTextareaProps
    extends TextareaHTMLAttributes<HTMLTextAreaElement>{
        label: string;
        error?: string;
}

export default function FormTextarea({
    label, 
    error,
    className='',
    ...props
}: FormTextareaProps) {
    return (
        <div>
            <label className="mb-2 block text-sm font-medium text-gray-700">
                {label}
            </label>

            <textarea 
                {...props}
                className={`
                    w-full resize-none rounded-lg border 
                    bg-white px-4 py-2
                    text-gray-900
                    placeholder: text-gray-400
                    outline-none transition focus:ring-2
                    ${
                        error 
                            ? 'border-red-500 focus:border-red-500 focus:rimg-red-100'
                            : 'border-gray-300 focus:border-blue-500 focus:ring-blue-100'
                    }
                    ${className}
                `}
            />

            {error && (
                <p className="mt-1 text-sm text-red-600">
                    {error}
                </p>
            )}
        </div>
    );
}
