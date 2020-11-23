
<?php 

require_once("navbar.php");

?> 
<style>
#box {
    margin-top: 2%;
    min-height: 85vh !important;
    border-radius: 25px;
}

</style>
<body>
<div class="container">
    <!-- Inicio Index -->
    <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
        <div class="col-md-10 text-center m-auto">
            <h1 class="mt-3" id="cinemaTitle"><i class="fas fa-id-badge"></i>&nbsp;Contacto</h1>
        </div>
        <!-- form     -->
        <div class="col-md-10">
            <form action="<?php echo FRONT_ROOT ?>Tickets/Add" method="post" >
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label for="inputNombre"><i style="color: red;">&#42&nbsp</i>Nombre y Apellido</label>
                        <input type="text" class="form-control" id="inputNombre" placeholder="Nombre" name ="Name">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label for="inputPago"><i style="color: red;">&#42&nbsp</i>Tipo de pago</label>
                        <select id="inputPago" class="form-control">
                        <option value = "1">Efectivo</option>
                        <option value = "2">Tarjeta</option>
                        </select>
                    </div>
                </div>    
                <div class="form-row justify-content-center">
                    <input hidden value = <?php $fecha?> name ="fecha">
                    <div class="form-group col-md-6">
                        <label for="inputPrecio"><i style="color: red;">&#42&nbsp</i>Monto a pagar</label>
                        <input hidden value = <?php echo $precio?> name ="precio">
                        <input hidden value = <?php $cant?> name ="cant">
                        <p> <?php echo "Cantidad: " ." " . $cant?> </p>
                        <p> <?php echo "Total: " ." " . $precio?> pesos</p>
                    </div>
                </div>   
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label for="inputRoom"><i style="color: red;">&#42&nbsp</i>Sala </label>
                        <input hidden value = <?php echo $room?> name ="room">
                        <p> <?php echo  "" . $room?> </p>
                    </div>
                </div>         
               
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label for="inputSeat"><i style="color: red;">&#42&nbsp</i>Butaca</label>
                        <input type="number" class="form-control" id="seat" placeholder="seat" name ="seat">
                    </div>
                </div>
                <div class = "form-row justify-content-center">
                    <div class = "form-group col-md-6">
                        <label for = "inputOrder"><i style= "color: red;">&#42&nbsp</i>Nro. Orden</label>
                        <input hidden value = <?php echo $o ?> name = "order">
                        <p><?= $o ?></p>
                    </div>
                </div>
    
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i>&nbspEnviar</button>
                            <a href="<?php echo FRONT_ROOT. "Home/View"?>" type="button" class="btn btn-primary btn-block"><i class="fas fa-arrow-left"></i>&nbspVolver</a>
                    </div>
                </div>
            </form>
            <!-- form -->
        </div>
    </div>
    <!-- Fin Index -->
</div>

</body>

