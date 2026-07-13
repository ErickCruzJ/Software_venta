import {Search} from 'lucide-react';

interface SearchInputProps {
    value: string;
    onChange: (value: string) =>void;
    placeholder?: string;
}
export default function SearchInput({
    value,
    onChange,
    placeholder = 'Buscar...',
}: SearchInputProps){
    return(
        <div className="relative">
            <Search
                size={18}
                className="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
            />
            <input 
                type="text" 
                value={value}
                onChange={(event) => onChange(event.target.value)}
                placeholder={placeholder}
                className='
                    w-64
                    rounded-lg
                    border
                    border-gray-300
                    py-2
                    pl-10
                    pr-4
                    text-sm
                    outline-none
                    transition
                    focus:border-blue-500
                    focus:ring-2
                    focus:ring-blue-100'
            />
        </div>
    );
}