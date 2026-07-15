export function verificarConexion(): boolean{
    if(!navigator.onLine) {
        alert(
            'No hay conexión de red. Verifica tu conexíon'
        );
        return false;
    }
    return true;
}