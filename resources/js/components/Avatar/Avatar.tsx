interface  AvatarProps {
    nombre: string;
    foto?: string;
    size?: "sm"|"md"|"lg";
}

export default function Avatar({
    nombre,
    foto,
    size = "md",
}: AvatarProps){
    const sizes = {
        sm: {
            container: "h-10 w-10",
            text: "text-sm"
        },
        md:{
            container: "h-14 w-14",
            text: "text-lg" 
        },
        lg:{
            container: "h-20 w-20",
            text: "text-3xl",
        },
    };

    return foto?(
        <img
            src={`storage/${foto}`}
            alt={nombre}
            className={`
                ${sizes[size].container}
                rounded-full
                object-cover
                border-2
                border-gray-200
                shadow-sm
            `}
        />
    ):(
        <div className={`
            ${sizes[size].container}
            flex
            items-center
            rounded-full
            bg-blue-100
            font-bold
            text-blue-700
            shadow-sm
            ${sizes[size].text}
        `}>
            {nombre.charAt(0).toUpperCase()}
        </div>
    );
}