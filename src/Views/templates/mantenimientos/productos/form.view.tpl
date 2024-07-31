<section>
    <h2>{{modeDsc}}</h2>
</section>
<section class="grid">
    <section class="row">
    <form class="col-12 col-m-8 offset-m-2" action="index.php?page=Mantenimientos-Productos-Producto&mode={{mode}}&id={{id}}" method="post">
        <input type="hidden" name="id" value="{{id}}">
        <input type="hidden" name="xsrftk" value="{{xsrftk}}">
        <input type="hidden" name="mode" value="{{mode}}">
        <div class="row my-4">
            <label class="col-4" for="prdprd">Codigo:</label>
            <input class="col-8" type="text" name="prdprd" id="prdprd" value="{{id}}" readonly>
            
        </div>
        <div class="row my-4">
            <label class="col-4" for="prddsc">Descripcion:</label>
            <input class="col-8" type="text" name="name" id="prddsc" value="{{name}}" required>
            {{with errors}}
                {{if error_name}}
                    {{foreach error_name}}
                        <div class="vol-12 error">{{this}}</div>
                    {{endfor error_name}}

                {{endif error_name}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="prdprc">Precio:</label>
            <input class="col-8" type="number" name="price" id="prdprc" value="{{price}}" required>
            {{with errors}}
                {{if error_price}}
                    {{foreach error_price}}
                        <div class="vol-12 error">{{this}}</div>
                    {{endfor error_price}}

                {{endif error_price}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="prdctd">Cantidad:</label>
            <input class="col-8" type="number" name="stock" id="prdctd" value="{{stock}}" required>
            {{with errors}}
                {{if error_stock}}
                    {{foreach error_stock}}
                        <div class="vol-12 error">{{this}}</div>
                    {{endfor error_stock}}

                {{endif error_stock}}
            {{endwith errors}}
        </div>

        <div class="row my-4">
            <label class="col-4" for="prdest">Estado</label>
            <select class="col-8" name="status" id="prdest" required>
                <option value="ACT" {{prdestACT}}>Activo</option>
                <option value="INA" {{prdestINA}}>Inactivo</option>
            </select>
            {{with errors}}
                {{if error_status}}
                    {{foreach error_status}}
                        <div class="vol-12 error">{{this}}</div>
                    {{endfor error_status}}

                {{endif error_status}}
            {{endwith errors}}
        </div>
        <div class="row flex-end">
            <button type="submit" class="primary mx-2">Guardar</button>
            <button type="button" onclick="window.location='index.php?page=Mantenimientos-Productos-Productos'">Cancelar</button>
        </div>
    </form>
    </section>
</section>