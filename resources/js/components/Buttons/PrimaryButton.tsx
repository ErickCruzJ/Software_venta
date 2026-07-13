import { ButtonHTMLAttributes,ReactNode } from "react";

interface PrimaryButtonProps
    extends ButtonHTMLAttributes<HTMLButtonElement>{
        children: ReactNode;
    }

    export default function PrimaryButton({
        children,
        className  ='',
        ...props
    }: PrimaryButtonProps){
        return(
            <button
            className={`
                rounded-lg
                bg-blue-600
                px-4
                py-2
                text-sm
                font-medium
                text-white
                transition
                hove:bg-blue-700
                disabled:cursor-not-allowed
                disabled:opacity-50
                ${className}
            `}>
                {children}
            </button>
        );
    }