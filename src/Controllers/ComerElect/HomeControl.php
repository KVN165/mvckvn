<?php
// archivo ubicado en: Controllers/ComerElect/HomeControl.php
namespace Controllers\ComerElect;

use Controllers\PublicController;

use Dao\ComerElect\Products; 
use Views\Renderer;


class HomeControl extends PublicController{
    public function run(): void{

        
        $viewData = array();
        $viewData["productos"] = Products::getProductosElect();

        Renderer::render('comerelect/home', $viewData);
        
    }
}
?>