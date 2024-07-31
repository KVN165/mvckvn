<?php

namespace Controllers\TrabajoGrupal;

use \Dao\TrabajoGrupal\Usuarios as DaoUsuarios;

class Usuarios extends \Controllers\PublicController{
    public function run(): void{
        $viewData = array();
        $viewData["usuarios"] = DaoUsuarios::readAllUsuarios();
        \Views\Renderer::render('trabajogrupal/formusuarios', $viewData);
    }
}

