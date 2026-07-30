import { ReactNode } from "react";

interface FormActionsProps{
    children: ReactNode;
}

export default function FormActions({
    children, 
}: FormActionsProps){
    return(
        <div className="flex justify-end gap-4 pt-2">
            {children}
        </div>
    );
}