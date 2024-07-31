<section class="container-l WWList">
    <section class="depth-1 px-4 py-4">
        <h2>Lista de VEHICULOS</h2>
        <section class="grid">
            <form action="index.php?page=Vehiculos-Vehiculos" method="post" class="row">
                <input class="col-8" type="text" name="search" placeholder="Buscar por MODELO" value="{{search}}">
                <button class="col-4" type="submit">Buscar</button>
            </form>
        </section>
    </section>
    <table class="my-4">
        <thead>
            <tr>
                <th>Id</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año de frabric</th>
                <th>Tipo combustible</th>
                <th>Kilometraje</th>
                <th><a href="index.php?page=Vehiculos-Vehiculo&mode=INS">Nuevo Vehiculo</a></th>
            </tr>
        </thead>
        <tbody>
            {{foreach datave}}
            <tr>
                <td>{{id_vehiculo}}</td>
                <td><a href="index.php?page=Vehiculos-Vehiculo&mode=DSP&id={{id_vehiculo}}">{{marca}}</a></td>
                <td>{{modelo}}</td>
                <td>{{ano_fabricacion}}</td>
                <td>{{tipo_combustible}}</td>
                <td>{{kilometraje}}</td>
                <td>
                    <a href="index.php?page=Vehiculos-Vehiculo&mode=UPD&id={{id_vehiculo}}">Editar</a>
                    <a href="index.php?page=Vehiculos-Vehiculo&mode=DEL&id={{id_vehiculo}}">Eliminar</a>
                </td>
            </tr>
            {{endfor datave}}
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">Total de registros: {{total}}</td>
            </tr>
        </tfoot>
    </table>
</section>