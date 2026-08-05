import {Menu, Bell, Settings, User, LogOut, ChevronDown} from "lucide-react";
import { useState } from "react";
import { router, usePage } from "@inertiajs/react";

import Avatar from "@/components/Avatar/Avatar";

interface HeaderProps{
    sidebarOpen: boolean;
    setSidebarOpen: React.Dispatch<React.SetStateAction<boolean>>;
}
export default function Header({ 
    sidebarOpen, 
    setSidebarOpen, 
}: HeaderProps) {
    const [openMenu, setOpenMenu] = useState(false);

    const { auth } = usePage().props as any;

    const usuario = auth.user

    function cerrarSesion(){
        router.post("/logout");
    }
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
                <div className="relative">
                    <button
                        onClick={()=> setOpenMenu(!openMenu)}
                        className="flex items-center gap-3 rounded-lg p-2 transition hover:bg-gray-100"
                    >
                        <Avatar
                            nombre={auth.user.nombre_usuario}
                            foto={usuario.empleado?.foto}
                            size="md"
                        />
                        <div className="text-left">
                            <p className="text-sm font-semibold">
                                {usuario.nombre_usuario}
                            </p>
                            <p className="text-xs text-gray-500">
                                {usuario.rol?.nombre}
                            </p>
                        </div>
                        <ChevronDown size={18}/>
                    </button>
                    {openMenu &&(
                        <div className="absolute right-0 mt-2 w-64 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-xl">
                            <div className="border-b p-4">
                                <div className="flex items-center gap-3">
                                    <Avatar
                                        nombre={usuario.nombre_usuario}
                                        foto={usuario.empleado?.foto}
                                        size="lg"
                                    />
                                    <div>
                                        <p className="font-semibold">
                                            {usuario.nombre_usuario}
                                        </p>
                                        <p className="text-sm text-gray-500">
                                            {usuario.rol?.nombre}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <button
                                className="flex w-full items-center gap-3 px-4 py-3 hover:bg-gray-100"
                            >
                                <Settings size={18}/>
                                Configuración
                            </button>
                            <button
                                onClick={cerrarSesion}
                                className="flex w-full items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50"
                            >
                                <LogOut size={18}/>
                                Cerrar sesión
                            </button>
                        </div>
                    )}
                </div>
            </div>
        </header>
    );
}