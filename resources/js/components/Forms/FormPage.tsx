import { ReactNode } from "react";

interface FormPageProps{
    title: string;
    description?: string;
    children?: ReactNode;
}

export default function FormPage({
    title,
    description,
    children,
}: FormPageProps){
    return(
        <div className="space-y-6">
            <div>
                <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                    {title}
                </h1>
                {description &&(
                    <p className="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {description}
                    </p>
                )}
            </div>
            {children}
        </div>
    );
}