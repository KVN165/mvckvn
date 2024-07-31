<section class="container-l WWList">
    <section class="depth-1 px-4 py-4">
        <h2>Lista de productos</h2>
        <section class="grid">
            <form action="index.php?page=Mantenimientos-Productos-Productos" method="post" class="row">
                <input class="col-8" type="text" name="search" placeholder="Buscar por nombre" value="{{search}}">
                <button class="col-4" type="submit">Buscar</button>
            </form>

        </section>

    </section>
    <table class="my-4">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th><a href="#">Nuevo Producto</a></th>
            </tr>
        </thead>
        <tbody>
            {{foreach productos}}
            <tr>
                <td>{{id}}</td>
                <td><a href="#">{{nombre}}</a></td>
                <td>{{descripcion}}</td>
                <td>{{precio}}</td>
                <td>{{cantidad}}</td>
                <td>
                    <a href="#">Editar</a>
                    <a href="#">Eliminar</a>
                </td>
            </tr>
            {{endfor productos}}
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</section>