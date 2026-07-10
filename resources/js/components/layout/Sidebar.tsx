import{
    LayoutDashboard,
    Boxes,
    Package,
    ShoppingCart,
    Users,
    Shield,
    FileBarChart,
}from "lucide-react";

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
        },
        {
            icon: <Boxes size={20} />,
            text: "Categorias",
        },
        {
            icon:<Package size={20}/>,
            text: "Productoa",
        },
        {
            icon: <ShoppingCart size={20}/>,
            text:"Ventas",
        },
        {
            icon:<Users size={20}/>,
            text: "Usuarios",
        },
        {
            icon: <Shield size={20} />,
            text: "Roles",
        },
        {
            icon: <FileBarChart size={20} />,
            text:"Reportes",
        }
    ];
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
                    <button
                        key={item.text}
                        className="flex w-full items-center gap-4 px-6 py-3 transition hover:bgslate-700"
                    >
                        {item.icon}
                        {sidebarOpen && (
                            <span>
                                {item.text}
                            </span>
                        )}
                    </button>
                ))}
            </nav>
        </aside>
    );
}