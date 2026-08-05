import{
    LayoutDashboard,
    Boxes,
    Package,
    ShoppingCart,
    Users,
    Shield,
    FileBarChart,
}from "lucide-react";
import { router, usePage} from "@inertiajs/react";
import { Button } from "../ui/button";

interface SidebarProps{
    sidebarOpen: boolean;
}

export default function Sidebar({
    sidebarOpen,
}: SidebarProps){
    const menu = [
        {
            icon : <LayoutDashboard size = {20}/>,
            text : "Dashboard",
            route:"/dashboard",
        },
        {
            icon: <Boxes size={20} />,
            text: "Categorias",
            route:"/categorias",
        },
        {
            icon:<Package size={20}/>,
            text: "Productos",
            route: "/productos",
        },
        {
            icon: <ShoppingCart size={20}/>,
            text:"Ventas",
            route:"/ventas",
        },
        {
            icon:<Users size={20}/>,
            text: "Usuarios",
            route:"/usuarios",
        },
        {
            icon:<Users size={20}/>,
            text: "Empleado",
            route:"/empleados",
        },
        {
            icon: <Shield size={20} />,
            text: "Roles",
            route:"/roles",
        },
        {
            icon: <FileBarChart size={20} />,
            text:"Reportes",
            route: "/reportes",
        }
    ];

    const { url } = usePage();
    
    return(
        <aside
            className={`
                    bg-slate-900
                    text-white
                    trasition-all
                    duration-300
                    ${sidebarOpen ? "w-64" : "w-20"}
                `}
        >
            <div className="flex h-16 items-center justify-center border-b boreder-slate-700">
                <span className="text-lg font-bold">
                    {sidebarOpen ? "Sofware Venta": "SV"}
                </span>
            </div>
            <nav className="mt-4">
                {menu.map((item)=>(
                    <Button
                        key={item.text}
                        onClick={()=>router.visit(item.route)}
                        className={`
                            flex 
                            w-full
                            items-center
                            gap-4
                            px-6
                            py-3
                            transition
                            ${
                                url.startsWith(item.route)
                                  ?"bg-slate-700 text-white"
                                  :"hover:bg-slate-800 text-slate-200"  
                            }
                        `}    
                    >
                        {item.icon}
                        {sidebarOpen &&(
                            <span>
                                {item.text}
                            </span>
                        )}
                    </Button>
                ))}
            </nav>
        </aside>
    );
}