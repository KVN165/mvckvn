<?php

namespace Controllers\Landing;

use Controllers\PublicController;
use Dao\Productos\Productos;
use Views\Renderer;

class ProductosOferta extends PublicController{

    public function run(): void{

        $viewData = array();
        $viewData["productos"] = Productos::getProductosOferta();

        Renderer::render('productos/ProductosOferta', $viewData);

    }
}
?>