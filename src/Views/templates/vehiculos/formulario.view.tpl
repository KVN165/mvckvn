<section>
    <h2>{{modeDsc}}</h2>
</section>
<section class="grid">
    <section class="row">
    <form class="col-12 col-m-8 offset-m-2" action="index.php?page=Vehiculos-Vehiculo&mode={{mode}}&id={{id}}" method="post">
        <input type="hidden" name="id" value="{{id_vehiculo}}">
        <input type="hidden" name="xsrftk" value="{{xsrftk}}">
        <input type="hidden" name="mode" value="{{mode}}">
        <div class="row my-4">
            <label class="col-4" for="prdprd">Codigo:</label>
            <input class="col-8" type="text" name="prdprd" id="prdprd" value="{{id_vehiculo}}" readonly>
            
        </div>
        <div class="row my-4">
            <label class="col-4" for="prddsc">Marca:</label>
            <input class="col-8" type="text" name="marca" id="prddsc" value="{{marca}}" required>
            {{with errors}}
                {{if error_marca}}
                    {{foreach error_marca}}
                        <div class="vol-12 error">{{this}}</div>
                    {{endfor error_marca}}

                {{endif error_marca}}
            {{endwith errors}}
        </div>
        
        <div class="row my-4">
            <label class="col-4" for="prddsc">Modelo:</label>
            <input class="col-8" type="text" name="modelo" id="prddsc" value="{{modelo}}" required>
            {{with errors}}
                {{if error_modelo}}
                    {{foreach error_modelo}}
                        <div class="vol-12 error">{{this}}</div>
                    {{endfor error_modelo}}

                {{endif error_modelo}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="prdprc">Año de fabricacion:</label>
            <input class="col-8" type="number" name="anofabricacion" id="prdprc" value="{{anofabricacion}}" required>
            {{with errors}}
                {{if error_anofabricacion}}
                    {{foreach error_anofabricacion}}
                        <div class="vol-12 error">{{this}}</div>
                    {{endfor error_anofabricacion}}

                {{endif error_anofabricacion}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="prdctd">Tipo de combustible:</label>
            <input class="col-8" type="text" name="tipo_combustible" id="prdctd" value="{{tipo_combustible}}" required>
            {{with errors}}
                {{if error_tipo_combustible}}
                    {{foreach error_tipo_combustible}}
                        <div class="vol-12 error">{{this}}</div>
                    {{endfor error_tipo_combustible}}

                {{endif error_tipo_combustible}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="prddsc">Kilometraje:</label>
            <input class="col-8" type="number" name="kilometraje" id="prddsc" value="{{kilometraje}}" required>
            {{with errors}}
                {{if error_kilometraje}}
                    {{foreach error_kilometraje}}
                        <div class="vol-12 error">{{this}}</div>
                    {{endfor error_kilometraje}}

                {{endif error_kilometraje}}
            {{endwith errors}}
        </div>

       
        <div class="row flex-end">
            <button type="submit" class="primary mx-2">Guardar</button>
            <button type="button" onclick="window.location='index.php?page=Vehiculos-Vehiculos'">Cancelar</button>
        </div>
    </form>
    </section>
</section>