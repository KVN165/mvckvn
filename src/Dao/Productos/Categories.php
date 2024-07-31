<?php

namespace Dao\Productos;

use Dao\Table;

class categories extends Table{
    public static function getCategories(): array{
        $sqlstr = "SELECT category_id, category_name from categorias where category_status='ACT';";
        //return self::obtenerRegistro($sqlstr, array();)
    }

    
}