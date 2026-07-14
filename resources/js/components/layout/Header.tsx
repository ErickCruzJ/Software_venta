import {Menu, Bell, Settings, User} from "lucide-react";
interface HeaderProps{
    sidebarOpen: boolean;
    setSidebarOpen: React.Dispatch<React.SetStateAction<boolean>>;
}
export default function Header({ 
    sidebarOpen, 
    setSidebarOpen, 
}: HeaderProps) {
    return (
        <header className="h-16 bg-white boreder-b border-gray-200 shadow-sm">
            <div className="flex h-full items-center justify-between px-6">
                {/*Lado izquierdo */}
                <div className="flex items-center gap-4">
                    <button 
                        onClick={() => setSidebarOpen(!sidebarOpen)}
                        className="rounded-lg p-2 text-gray-700 transition hover:bg-gray-100 hover:text-gray-900"
                    >
                        <Menu size={24}/>
                    </button>
                    <div>
                        <h1 className="text-xl font-bold text-gray-800">
                            Software de venta
                        </h1>
                        <p className="text-xs text-gray-500">
                            Sistema de Inventario y ventas
                        </p>
                    </div>
                </div>
                {/*Lado derecho*/}
                <div className="flex items-center gap-5">
                    <button className="rounded-lg p-2 hover:bg-gray-100">
                        <Bell size={20}/>
                    </button>
                    <button className="rounded-lg p-2 hover:bg-gray-100">
                        <Settings size={20}/>
                    </button>
                    <div className="flex items-center gap-2">
                        <div className="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-white">
                            <User size={20}/>
                        </div>
                        <div>
                            <p className="text-sm font-semibold">
                                Erick Cruz
                            </p>
                            <p className="text-xs text-gray-500">
                                Administrador
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    );
}