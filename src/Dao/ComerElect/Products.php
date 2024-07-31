<?php
// archivo ubicado en: Dao/ComerElect/Products.php
namespace Dao\ComerElect;

class Products extends \Dao\Table{
    public static function getProductosElect(): array{
        $sql = "SELECT * from productoselectro;";
        $productoselectro = self::obtenerRegistros($sql, array());
        return $productoselectro;
    }

}