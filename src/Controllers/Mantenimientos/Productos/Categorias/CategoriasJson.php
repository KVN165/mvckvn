<?php

namespace Controllers\Mantenimientos\Productos\Categorias;

use Controllers\JSONController;
use Dao\Productos\Categorias as DaoCategorias;

class CategoriasJson extends JSONController{
    public function run(): void{
        $viewData["categorias"] = DaoCategorias::getAllCategorias();
    }
}