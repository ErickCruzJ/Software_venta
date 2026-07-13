import {ReactNode} from 'react';

interface ToolbarProps{
    title: string;
    children: ReactNode;
}

export default function Toolbar({
    title,
    children,
}: ToolbarProps){
    return(
       <div className="mb-6 rounded-xl border border-gray-200 bg-white p-5 shadow-sw">
            <div className="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h1 className="text-2xl font-semibold text-gray-800">
                    {title}
                </h1>
                <div className="flex flex-wrap items-center gap-3">
                    {children}
                </div>
            </div>
       </div>
    );
}