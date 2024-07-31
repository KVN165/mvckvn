<?php

namespace Controllers\Mantenimientos\Productos;

use \Dao\Productos\Productos as DaoProductos;
use \Utilities\Validators as Validators;
use \Utilities\Site as Site;

class Producto extends \Controllers\PublicController{

    private $mode = "NAN";
    private $modeDscArr= [
        "INS" => "Nuevo Producto",
        "UPD" => "Actualizando Producto %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s", 
    ];

    private $modeDsc = "";

    private $id = 0;
    private $prdname = "";
    private $price = 0;
    private $stock = 0;
    private $status = "ACT";

    private $errors = array();
    private $xsrftk = "";
    
    public function run(): void{
        
        // 1 cargar data del get
        $this->obtenerDatosDelGet();
        // 2 si en get viene el id obtener producto del db
        $this->getDatosFromDB();
        // 3 si es un postback
        if ($this->isPostBack()){
            // 3.1 obtener datos del post
            // 3.2 validar datos
            $this->obtenerDatosDePost();
            if(count($this->errors) === 0){
                // 3.3 si los datos son validos
            // 3.3.1 guardar datos en la bd
            // 3.3.2 redirigir a la lista de productos
            $this->procesarAccion();
            }
            // 3.4 si los datos no son validos
            // 3.4.1 mostrar errores
        }
        // 4 mostrar formulario
        $this->showView();
    }

    private function obtenerDatosDelGet(){
        if (isset($_GET["mode"])){
            $this->mode = $_GET["mode"];
        }
        if (!isset($this->modeDscArr[$this->mode])){
            throw new \Exception("Modo no valido");
        }
        if (isset($_GET["id"])){
            $this->id = intval($_GET["id"]);
        }
        if ($this->mode != "INS" && $this->id <= 0){
            throw new \Exception("ID no valido");
        }

    }

    private function getDatosFromDB(){
        if ($this-> id > 0){
            $producto = DaoProductos::readProducto($this->id);
            if (!$producto){
                throw new \Exception("Producto no encontrado");
            }
            $this->prdname = $producto["name"];
            $this->price = $producto["price"];
            $this->stock = $producto["stock"];
            $this->status = $producto["status"];
        }
        
    }

    private function obtenerDatosDePost(){
        $tempName = $_POST["name"] ?? "";
        $tempPrice = $_POST["price"] ?? "";
        $tempStock = $_POST["stock"] ?? "";
        $tempStatus = $_POST["status"] ?? "";
        $tempMode = $_POST["mode"] ?? "";

        if(Validators::IsEmpty($tempName)){
            $this->addError("name", "El nombre no puede estar vacio", "error");
        }
        $this->prdname = $tempName;

        if(Validators::IsEmpty($tempPrice)){
            $this->addError("price", "El precio no puede estar vacio", "error");
        }else if(!Validators::IsCurrency($tempPrice)){
            $this->addError("price", "El precio no es valido", "error");
        }
        $this->price = $tempPrice;

        if(Validators::IsEmpty($tempStock)){
            $this->addError("stock", "El stock no puede estar vacio", "error");
        }else if(!Validators::IsInteger($tempStock)){
            $this->addError("stock", "El stock no es valido", "error");
        }
        $this->stock = $tempStock;

        if(Validators::IsEmpty($tempStatus)){
            $this->addError("status", "El status no puede estar vacio", "error");
        }else if(!in_array($tempStatus, ["ACT", "INA"])){
            $this->addError("status", "El status no es valido", "error");
        }
        $this->status = $tempStatus;

        if(Validators::IsEmpty($tempMode) || !in_array($tempMode,["INS", "UPD", "DEL"])){
            $this->throwError("Ocurrio un error al procesar la solicitud");
        } 

        
     }
     private function procesarAccion(){
            switch ($this->mode){
                case "INS":
                    $insResult = DaoProductos::createProducto(
                    $this->prdname,
                    $this->price,
                    $this->stock,
                    $this->status,
                    );
                    $this->validateDBOperation(
                        "Producto insertado correctamente",
                        "Ocurrio un error al insertar el producto",
                        $insResult
                    );
                    break;
                case "UPD":
                    $updResult = DaoProductos::updateProducto(
                        $this->id,
                    $this->prdname,
                    $this->price,
                    $this->stock,
                    $this->status,
                    );
                    $this->validateDBOperation(
                        "Producto actualizado correctamente",
                        "Ocurrio un error al actualizar el producto",
                        $updResult
                    );
                    break;
                case "DEL":
                    $delResult = DaoProductos::deleteProducto($this->id);
                    $this->validateDBOperation(
                        "Producto eliminado correctamente",
                        "Ocurrio un error al eliminar el producto",
                        $delResult
                    );
                    break;
            }
    }

    private function validateDBOperation($msg, $error, $result){
        if(!$result){
            $this->errors["error_general"] = $error;
        }else {
            Site::redirectToWithMsg(
                "index.php?page=Mantenimientos-Productos-Productos",
                $msg
            );
        }
    }

    private function throwError($msg){
        Site::redirectToWithMsg(
            "index.php?page=Mantenimientos-Productos-Productos",
            $msg

        );

     }
    private function addError($key, $msg, $context = "general"){
        if(!isset($this->errors[$context."_".$key])){
            $this->errors[$context."_".$key] = [];
        }
        $this->errors[$context."_".$key] [] = $msg;
    }

    private function showView(){
        $viewData = array();
        $viewData["mode"] = $this->mode;
        $viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->prdname);
        $viewData["id"] = $this->id;
        $viewData["name"] = $this->prdname;
        $viewData["price"] = $this->price;
        $viewData["stock"] = $this->stock;
        $viewData["status"] = $this->status;
        $viewData["errors"] = $this->errors;
        $viewData["prdest".$this->status] = "selected";
        \Views\Renderer::render("mantenimientos/productos/form", $viewData);
    }
}