<?php 

require_once("navbar.php");
use Controllers\CinemaController as cinemaController;
?> 

<body>
<div class="container">
        <!-- Inicio Index -->
        <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
            <div class="col-md-10 text-center m-auto">
                <h1 class="" id="cinemaTitle"><i class="fas fa-film"></i></i>&nbsp;</i>Salas</h1>
            </div>
            <!-- form     -->
            <div class="col-md-10">

                <form action = "<?php echo FRONT_ROOT ?>Room/AddMoreRoom" method="post">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-6">
                            <label for="inputCine"><i style="color: red;">&#42&nbsp</i>Nombre de cine</label>
                            <select id="inputCine" class="form-control" name = "Cines">
                                    <option value= "1">Selecciona el Cine:</option>
                                    <?php 
                                        foreach($cinemaList as $cine) { ?>
                                            <option value="<?php echo $cine->getIdCinema(); ?>" > <?php echo $cine->getCinemaName(); ?></option>
                                        <?php } ?>
                            </select>

                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-6">
                            <label for="inputNumber"><i style="color: red;">&#42&nbsp</i>Numero de sala</label>
                            <input type="number" class="form-control" id="inputNumber" placeholder="Numero" name="numeroSala">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-6">
                            <label for="inputAsientos"><i style="color: red;">&#42&nbsp</i>Asientos en total</label>
                            <input type="number" class="form-control" id="inputAsientos" name="asientos" placeholder="Asientos">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPrecio"><i style="color: red;">&#42&nbsp</i>Precio de Ticket</label>
                            <input type="number" class="form-control" id="inputPrecio" name="number" placeholder="Precio">
                        </div>                        
                    </div>                    
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbspSiguiente</button>
                    <button type="button" class="btn btn-primary"><i class="fas fa-arrow-left"></i>&nbspVolver</button>
                </form>
                <!-- form -->
            </div>
        </div>
        <!-- Fin Index -->
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>


</body>



<style>
#box {
    margin-top: 2%;
    min-height: 85vh !important;
    border-radius: 25px;
}

</style>