<?php

namespace Dao\TarProductos;

class Products extends \Dao\Table{
    public static function getTarProductos(): array{
        $sql = "SELECT * from productostarea;";
        $productoselectro = self::obtenerRegistros($sql, array());
        return $productoselectro;
    }

}