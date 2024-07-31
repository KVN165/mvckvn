<section class="container-l WWList">
    <section class="depth-1 px-4 py-4">
        <!--Titulo y buscador-->
        <h1>Formulario usuarios</h1>

        <!--Formulario-->
        

    </section>
    <table class="my-4">
        <thead>
            <tr>
                <th>Codigo del usuario</th>
                <th>Email</th>
                <th>Nombre del usuario</th>
                <th>Contraseña del usuario</th>
                <th>Fecha de registro</th>
                <th>Estado de contraseña</th>
                <th>Fecha de exp de contraseña</th>
                <th>Estado del usuario</th>
                <th>Codigo de activacion</th>
                <th>Fecha del ultimo cambio de contraseña</th>
                <th>Tipo de usuario</th>
            </tr>
        </thead>
        <tbody>
            {{foreach usuarios}}
            <tr>
                <td>{{usercod}}</td>
                <td>{{useremail}}</td>
                <td>{{username}}</td>
                <td>{{userpswd}}</td>
                <td>{{userfching}}</td>
                <td>{{userpswdest}}</td>
                <td>{{userpswdexp}}</td>
                <td>{{userest}}</td>
                <td>{{useractcod}}</td>
                <td>{{userpswdchg}}</td>
                <td>{{usertipo}}</td>
            </tr>
            {{endfor usuarios}}
        </tbody>
        <tfoot>
    
        </tfoot>
    </table>

</section>

