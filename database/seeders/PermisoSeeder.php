<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Roles
        [
            'nombre' => 'Agregar rol',
            'codigo' => 'rol.a',
            'modulo' => 'rol',
            'accion' => 'Agregar',
            'descripcion' => 'Permire actualizar roles',
        ],
        [
            'nombre' => 'Consultar rol',
            'codigo' => 'rol.c',
            'modulo' => 'rol',
            'accion' => 'Consultar',
            'descripcion' => "Permite consultar roles",
        ],
        [
            'nombre' => 'Actualizar rol',
            'codigo' => 'rol.a',
            'modulo' => 'rol',
            'accion' => 'Actualizar',
            'descripcion' => 'Permite actualizar los roles',
        ],
        [
            'nombre' => 'Eliminar rol',
            'codigo' => 'rol.e',
            'modulo' => 'rol',
            'accion' => 'Eliminar',
            'descripcion' => 'Permite eliminar roles.',
        ],
        //Usuarios
                [
            'nombre' => 'Agregar usuario',
            'codigo' => 'usuario.a',
            'modulo' => 'usuario',
            'accion' => 'Agregar',
            'descripcion' => 'Permire actualizar usuarios',
        ],
        [
            'nombre' => 'Consultar usuario',
            'codigo' => 'usuario.c',
            'modulo' => 'usuario',
            'accion' => 'Consultar',
            'descripcion' => "Permite consultar usuarios",
        ],
        [
            'nombre' => 'Actualizar usuario',
            'codigo' => 'usuario.a',
            'modulo' => 'usuario',
            'accion' => 'Actualizar',
            'descripcion' => 'Permite actualizar los usuarios',
        ],
        [
            'nombre' => 'Eliminar usuario',
            'codigo' => 'usuario.e',
            'modulo' => 'usuario',
            'accion' => 'Eliminar',
            'descripcion' => 'Permite eliminar usuarios.',
        ],
        //Permisos
                [
            'nombre' => 'Agregar permiso',
            'codigo' => 'permiso.a',
            'modulo' => 'permiso',
            'accion' => 'Agregar',
            'descripcion' => 'Permire actualizar permisos',
        ],
        [
            'nombre' => 'Consultar permiso',
            'codigo' => 'permiso.c',
            'modulo' => 'permiso',
            'accion' => 'Consultar',
            'descripcion' => "Permite consultar permisos",
        ],
        [
            'nombre' => 'Actualizar permiso',
            'codigo' => 'permiso.a',
            'modulo' => 'permiso',
            'accion' => 'Actualizar',
            'descripcion' => 'Permite actualizar los permisos',
        ],
        [
            'nombre' => 'Eliminar permiso',
            'codigo' => 'permiso.e',
            'modulo' => 'permiso',
            'accion' => 'Eliminar',
            'descripcion' => 'Permite eliminar permisos.',
        ],
        //Empelados
                [
            'nombre' => 'Agregar empleado',
            'codigo' => 'empleado.a',
            'modulo' => 'empleado',
            'accion' => 'Agregar',
            'descripcion' => 'Permire actualizar empleados',
        ],
        [
            'nombre' => 'Consultar empleqado',
            'codigo' => 'empleado.c',
            'modulo' => 'empleado',
            'accion' => 'Consultar',
            'descripcion' => "Permite consultar empleados",
        ],
        [
            'nombre' => 'Actualizar empleado',
            'codigo' => 'empleado.a',
            'modulo' => 'empleado',
            'accion' => 'Actualizar',
            'descripcion' => 'Permite actualizar los empleados',
        ],
        [
            'nombre' => 'Eliminar empleado',
            'codigo' => 'empleado.e',
            'modulo' => 'empleado',
            'accion' => 'Eliminar',
            'descripcion' => 'Permite eliminar empleados.',
        ],
        //Categoria
        [
            'nombre' => 'Agregar categoria',
            'codigo' => 'categoria.a',
            'modulo' => 'categoria',
            'accion' => 'Agregar',
            'descripcion' => 'Permire actualizar categorias',
        ],
        [
            'nombre' => 'Consultar categoria',
            'codigo' => 'categoria.c',
            'modulo' => 'categoria',
            'accion' => 'Consultar',
            'descripcion' => "Permite consultar categorias",
        ],
        [
            'nombre' => 'Actualizar categoria',
            'codigo' => 'categoria.a',
            'modulo' => 'categoria',
            'accion' => 'Actualizar',
            'descripcion' => 'Permite actualizar los categorias',
        ],
        [
            'nombre' => 'Eliminar  categoria',
            'codigo' => 'categoria.e',
            'modulo' => 'categoria',
            'accion' => 'Eliminar',
            'descripcion' => 'Permite eliminar categorias.',
        ],
        //Marcas
                [
            'nombre' => 'Agregar marca',
            'codigo' => 'marca.a',
            'modulo' => 'marca',
            'accion' => 'Agregar',
            'descripcion' => 'Permire actualizar marcas',
        ],
        [
            'nombre' => 'Consultar rol',
            'codigo' => 'rol.c',
            'modulo' => 'rol',
            'accion' => 'Consultar',
            'descripcion' => "Permite consultar roles",
        ],
        [
            'nombre' => 'Actualizar rol',
            'codigo' => 'rol.a',
            'modulo' => 'rol',
            'accion' => 'Actualizar',
            'descripcion' => 'Permite actualizar los roles',
        ],
        [
            'nombre' => 'Eliminar  rol',
            'codigo' => 'rol.e',
            'modulo' => 'rol',
            'accion' => 'Eliminar',
            'descripcion' => 'Permite eliminar roles.',
        ],
    }
}
