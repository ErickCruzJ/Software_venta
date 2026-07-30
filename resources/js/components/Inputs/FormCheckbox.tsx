import { forwardRef, InputHTMLAttributes } from "react";

interface FormCheckboxProps extends InputHTMLAttributes<HTMLInputElement>{
    label: string;
    error?: string;
}

const FormCheckbox = forwardRef<HTMLInputElement, FormCheckboxProps>(
    ({label, error, ...props}, ref) => {
        return(
            <div className="space-y-6">
                <label className="flex items-center gap-3 cursor-pointer">
                    <input
                        ref={ref}
                        type="checkbox"
                        className="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                        {...props}
                    />
                    <span className="text-sm font-medium text-gray-700 dark:text-gray-300">
                        {label}
                    </span>
                </label>
                {error && (
                    <p className="text-sm text-red-500">
                        {error}
                    </p>
                )}
            </div>
        );
    }
);
FormCheckbox.displayName = "FormCheckbox";
export default FormCheckbox;