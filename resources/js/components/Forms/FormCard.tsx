import { ReactNode } from "react";
import clsx from "clsx";

interface FormCardProps {
    title: string;
    children: ReactNode;

    columns?: 1 | 2;

    className?: string;
}

export default function FormCard({
    title,
    children,
    columns = 2,
    className,
}: FormCardProps){
    return(
        <div 
            className={clsx(
                "rounded-xl border bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800",
                className
            )}
        >
            <h2 className="mb-5 text-lg font-semibold text-gray-900 dark:text-white">
                {title}
            </h2>
            <div
                className={clsx(
                    "grid gap-5",
                    columns === 1
                        ?"grid-cols-1"
                        :"grid-cols-1 md:grid-cols-2"
                )}
            >
                {children}
            </div>
        </div>
    );
}