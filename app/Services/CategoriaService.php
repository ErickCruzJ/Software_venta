namespace  App\Services;

use App\Models\Categoria;

class CategoriaService
{
    public function obtenerCategorias()
    {
        return Categoria::orderBy('nombre')->get();
    }
    public function crear(array $data)
    {
        return Categorria::create($data);
    }
    public function actualizar(Categoria $categoria, array $data)
    {
        $categoria->update($data);
        return $categoria;
    }
    public function eliminar(Categoria $categoria)
    {
        $categoria->delete();
    }
}