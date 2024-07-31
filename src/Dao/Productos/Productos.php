<?php

namespace Dao\Productos;

class Productos extends \Dao\Table{

    public static function getProductosOferta(): array{
        $sqlstr = "SELECT name as nombre, price as precio, 'https://via.placeholder.com/150' as imagen from productos;";
        $productos = self::obtenerRegistros($sqlstr, array());
        return $productos;
    }

    /*CRUD*/

    public static function createProducto(
        $name,
        $price,
        $stock,
        $status,
    ){
        $InsSql = "INSERT INTO productos (name, price, stock, status, create_time)
        value (:name, :price, :stock, :status, now());";
        $insParams =[
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
            'status' => $status
        ];

        return self::executeNonQuery($InsSql, $insParams);
    }

    public static function updateProducto(
        $id,
        $name,
        $price,
        $stock,
        $status
        ){
            $UpdSql = "UPDATE productos set name = :name, price = :price, stock = :stock, status = :status where id = :id;";
            $updParams = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'stock' => $stock,
                'status' => $status
            ];
            return self::executeNonQuery($UpdSql, $updParams);
    }

    public static function deleteProducto($id){
        $DelSql = "DELETE from productos where id = :id;";
        $delParams = ['id' => $id];
        return self::executeNonQuery($DelSql, $delParams);
    }

    public static function readAllProductos($filter = ''){
        $sqlstr = "SELECT * from productos where name like :filter;";
        $params = array('filter' => '%'.$filter.'%');
        return self::obtenerRegistros($sqlstr, $params);
    }

    public static function readProducto($id){
        $sqlstr = "SELECT * from productos where id = :id;";
        $params = array('id' => $id);
        return self::obtenerUnRegistro($sqlstr, $params);
    }
}

?>