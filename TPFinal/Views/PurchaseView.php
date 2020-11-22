
<style>
  #box {
    margin-top: 2%;
    min-height: 85vh !important;
    border-radius: 25px;
  }
</style>
<div class="container">
  <!-- Inicio Index -->
  <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
    <div class="col-md-10 text-center m-auto">
      <h1 class="" id="cinemaTitle"><i class="fas fa-shopping-cart"></i>&nbsp;</i>Comprar Entradas</h1>
    </div>
    <!-- form-->
    <div class="col-md-10">
      <form action="<?php echo FRONT_ROOT ?>Purchase/Index" method="post">
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="inputCiudad"><i style="color: red;">&#42&nbsp</i>Ciudad</label>
            <select id="inputCiudad" class="form-control">
            <option>Mar del plata</option>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="inputPelicula"><i style="color: red;">&#42&nbsp</i>Pelicula</label>
            <select id="inputPelicula" class="form-control">
              <?php if (isset($screen)) {
                foreach ($screen as $s) {?>
                  <option value = " "> <?php echo $mC->getNameByIDMB($s->getIdMovieIMDB());?> </option>
                <?php }
              } ?>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="inputCine"><i style="color: red;">&#42&nbsp</i>Cine</label>
            <select id="inputCine" class="form-control">
            <?php if (isset($screen)) {
                foreach ($screen as $s) {?>
                  <option value = " "> <?php echo $cC->getCineNameByID($s->getIdCinema());?> </option> ;
                
              <?php } } ?>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="inputFuncion"><i style="color: red;">&#42&nbsp</i>Funcion</label>
            <select id="inputFuncion" class="form-control">
              <?php if (isset($screen)) {
                foreach ($screen as $s) {?>
                  <option value = " "> <?php echo "Funcion: " . $s->getIdScreening() . "|" . "Fecha: " . $s->getStartDate() . "|" . "Horario: " . $s->getStartHour() . "|" . "Precio: " . $s->getPrice();?> </option> ;
              <?php }
             } ?>
            </select>
          </div>

          <div class="form-group col-md-12">
            <label for="inputCantAsientos"><i style="color: red;">&#42&nbsp</i>Cantidad de asientos</label>
            <input type="number" max="10" min="1" class="form-control" id="inputCantAsientos" placeholder="Cantidad de asientos">
          </div>
        </div>

        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbspContinuar</button>
        <button type="button" class="btn btn-danger"><i class="fas fa-arrow-left"></i>&nbspVolver</button>
      </form>
      <!-- form -->
    </div>
  </div>
  <!-- Fin Index -->
</div>
<

<script>
  $(document).ready(function() {
    $("#inputCiudad").change(function() {
      var CityId = $(this).val();

      $.ajax({
        url: "<?php echo FRONT_ROOT ?>Movies/GetMovieByCity",
        type: 'post',
        data: { cityId: CityId },
        dataType: 'json',
        success: function(response) {

          console.log(response);
          var len = response.length;

          $("#inputPelicula").empty();
          for (var i = 0; i < len; i++) {
            var id = response[i]['id'];
            var name = response[i]['movie'];

            $("#inputPelicula").append("<option value='" + id + "'>" + name + "</option>");
          }
        }
      });
    });
  });
</script>
