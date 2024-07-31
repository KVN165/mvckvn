<?php

namespace Controllers\Tarproductos;

use Controllers\PublicController;

use Dao\TarProductos\Products as DaoTPProductos; 
use Views\Renderer;


class Products extends PublicController{
    public function run(): void{

        
        $viewData = array();
        $viewData["productos"] = DaoTPProductos::getTarProductos();

        Renderer::render('tarproduc/products', $viewData);
        
    }
}
?>