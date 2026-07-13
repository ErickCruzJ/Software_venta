import {ReactNode} from 'react';

interface Column<T>{
    key: string;
    label: string;
    render: (item: T) => ReactNode;
}

interface DataTableProps<T>{
    columns: Column<T>[];
    data: T[];
    rowKey: (item: T) => string | number;
}

export default function DataTable<T>({
    columns,
    data,
    rowKey,
}:DataTableProps<T>){
    return(
        <div className="overflow-hodden rounded-xl border border-gary-200 bg-white shadow-sm">
            <div className="overflow-x-auto">
                <table className="w-full">
                    <thead className="bg-gray-50">
                        <tr>
                            {columns.map((column) =>(
                                <th
                                    key={column.key}
                                    className="px-6 px-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"
                                >
                                    {column.label}
                                </th>
                            ))}
                        </tr>
                    </thead>
                    <tbody className="divide-y divide-gary-200">
                        {data.map((item)=>(
                            <tr
                                key={rowKey(item)}
                                className="transition hover:bg-gray-50"
                            >
                                {columns.map((column)=>(
                                    <td
                                        key={column.key}
                                        className="px-6 py-4 text-sm text-gray-700"
                                    >
                                        {column.render(item)}
                                    </td>
                                ))}
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    )
}