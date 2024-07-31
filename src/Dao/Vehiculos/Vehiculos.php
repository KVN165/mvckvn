<?php
// archivo ubicado en: Dao/Vehiculos/Vehiculos.php
namespace Dao\Vehiculos;

class Vehiculos extends \Dao\Table{
    public static function getVehiculos(): array{
        $sql = "SELECT * from datosvehiculos;";
        $datave = self::obtenerRegistros($sql, array());
        return
         $datave;
    }

    public static function createVehiculo(
        $marca,
        $modelo,
        $anofabric,
        $tipocombust,
        $kilometraje,
    ){
        $InsSql = "INSERT INTO datosvehiculos (marca, modelo, ano_fabricacion, tipo_combustible, kilometraje)
        value (:marca, :modelo, :ano_fabricacion, :tipo_combustible, :kilometraje);";
        $insParams =[
            'marca' => $marca,
            'modelo' => $modelo,
            'ano_fabricacion' => $anofabric,
            'tipo_combustible' => $tipocombust,
            'kilometraje' => $kilometraje
        ];
        return self::executeNonQuery($InsSql, $insParams);
    }

    public static function updateVehiculo(
        $id_vehiculo,
        $marca,
        $modelo,
        $anofabric,
        $tipocombust,
        $kilometraje,
        ){
            $UpdSql = "UPDATE datosvehiculos set marca = :marca, modelo = :modelo, ano_facricacion = :ano_fafricacion,
             tipo_combustible = :tipo_combustible, kilometraje = :kilometraje where id_vehiculo = :id_vehiculo;";
            $updParams = [
                'id_vehiculo' => $id_vehiculo,
                'marca' => $marca,
                'modelo' => $modelo,
                'ano_fabricacion' => $anofabric,
                'tipo_combustible' => $tipocombust,
                'kilometraje' => $kilometraje
            ];
            return self::executeNonQuery($UpdSql, $updParams);
    }

    public static function deleteVehiculo($id_vehiculo){
        $DelSql = "DELETE from datosvehiculos where id_vehiculo = :id_vehiculo;";
        $delParams = ['id_vehiculo' => $id_vehiculo];
        return self::executeNonQuery($DelSql, $delParams);
    }

    public static function readAllVehiculos($filter = ''){
        $sqlstr = "SELECT * from datosvehiculos where modelo like :filter;";
        $params = array('filter' => '%'.$filter.'%');
        return self::obtenerRegistros($sqlstr, $params);
    }

    public static function readVehiculo($modelo){
        $sqlstr = "SELECT * from datosvehivulos where modelo = :modelo;";
        $params = array('modelo' => $modelo);
        return self::obtenerUnRegistro($sqlstr, $params);
    }
}

?>