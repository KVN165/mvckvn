<!--archivo ubicado en: Views/templates/comerelect/home.view.tpl -->
<h1>Productos disponibles</h1>
<div class="container px-5">
    <div class="row">
        <div class="col-12">
            <div class="row">
                {{foreach productos}}
                <div class="col-3">
                    <div class="card ">
                        <center>
                        <h3>{{nombre}}</h3>
                        <p>{{descripcion}}</p>
                        <img src="{{imagen}}" class="card-imp-bot" alt="{{nombre}}">
                        <p>Precio: L {{precio}}</p>
                        </center>
                    </div>
                </div>
                {{endfor productos}}
            </div>
        </div>
    </div>
</div>