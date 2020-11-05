<?php require_once("navbar.php"); ?>
<style>
  body {
    height: 100%;
    max-height: 100vh;
    margin: 0;
  }


  #box {
    min-height: 100vh !important;
    height: auto !important;
    margin-bottom: 10%;
    margin-top: 5%;
    border-radius: 25px;

  }

  h1 {
    font-size: 20px;
    margin-top: 10%;
  }

  .flip-card {
    background-color: transparent;
    width: 200px;
    height: 250px;
    /* border: 1px solid #f1f1f1; */

    perspective: 1000px;
    /* Remove this if you don't want the 3D effect */
  }

  /* This container is needed to position the front and back side */
  .flip-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    text-align: center;
    transition: transform 0.8s;
    transform-style: preserve-3d;
    border-style: solid;
    border-color: linear-gradient(to right, #262b33, #707d91, #262b33);
    border-width: 10px;
    border-radius: 10px;
  }

  /* Do an horizontal flip when you move the mouse over the flip box container */
  .flip-card:hover .flip-card-inner {
    transform: rotateY(180deg);
  }

  /* Position the front and back side */
  .flip-card-front,
  .flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
  }

  /* Style the front side (fallback if image is missing) */
  .flip-card-front {
    background-color: #bbb;
    color: black;
  }

  /* Style the back side */
  .flip-card-back {
    background-color: rgba(88, 88, 88, 0.534);
    color: white;
    font-size-adjust: small;
    transform: rotateY(180deg);
  }

  .container {
    min-height: 100vh;
    height: 100% !important;
    width: 100%;
  }

  .movieBoxes {
    margin-left: 7%;
    width: 85%;
    padding: 10px;
    margin-bottom: 10%;
  }

  .col-md-3 img {
    opacity: 0.8;
    cursor: pointer;
  }

  .col-md-3 img:hover {
    opacity: 1;
  }


  #searchBox {
    position: relative;
    transform: translate(-50%, -50%);
    transition: all 1s;
    width: 50px;
    height: 50px;
    background: white;
    box-sizing: border-box;
    border-radius: 25px;
    border: 4px solid white;
    padding: 5px;
    margin-top: 17%;
    margin-left: 36%;
  }

  #inputSearch {
    position: absolute;
    width: 100%;
    ;
    height: 42.5px;
    line-height: 30px;
    outline: 0;
    border: 0;
    display: none;
    font-size: 1em;
    border-radius: 20px;
    padding: 0 20px;
  }

  #inputConfig {
    box-sizing: border-box;
    padding: 10px;
    width: 42.5px;
    height: 42.5px;
    position: absolute;
    top: 0;
    right: 0;
    border-radius: 50%;
    color: #07051a;
    text-align: center;
    font-size: 1.2em;
    transition: all 1s;
  }

  #searchBox:hover {
    width: 200px;
    cursor: pointer;
  }

  #searchBox:hover input {
    display: block;
  }

  #searchBox:hover .fa {
    background: #07051a;
    color: white;
    display: block;
  }

  .button {
    background-color: rgba(39, 116, 70, 1);
    border: none;
    color: white;
    padding: 5% 30%;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    width: 100%;
    font-size: 1rem;
    cursor: pointer;
  }


  .textbox {
    font-size: 15px;
    padding: 8px 0;

  }


  .custom-select {
    width: 100%;
  }

  #edit {
    background-color: #FF851B;
  }

  #remove {
    background-color: #FF4136;
  }
</style>

<div id="box" class="container" style="background-color: rgba(255, 255, 255, 0.5);">
  <div class="row">
    <div class="col-md-4">
      <form id="searchBox" action="<?php echo FRONT_ROOT ?>Movies/GetMovieFromApiByName" method="POST">
        <input id="inputSearch" type="search" name="movieName">
        <i class="fa fa-search" id="inputConfig"></i>
      </form>
    </div>
    <div class="col-md-8 align-items-center m-auto">

      <div class="row justify-content-center align-items-center">

        <div class="col-md-6 text-center m-auto" >
          <div class="textbox">
            <select class="custom-select" >

              <option value="0">Selecciona el Género</option>
              <?php foreach($moviegender as $moviegenders) { ?>
              <option value="1"><?php echo $moviegenders->getGenresFromApi(); ?></option>
            <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-md-6 text-center m-auto">
          <div class="textbox">
            <form action="">
              <input id="inputDate" type="date" name="date">
              <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
          </div>
        </div>


      </div>

    </div>
    
  </div>
  <div class="row">
    <?php foreach($movieList as $movies) { ?>
    <div class="col-md-3">
      <div class="flip-card movieBoxes">
        <div class="flip-card-inner">
          <div class="flip-card-front">
            <img src="<?php echo $movies->getPhoto()?>" alt="Avatar" style="width:100%;height:100%;">
          </div>
          <div class="flip-card-back">
            <h1> <?php echo $movies->getMovieName(); ?> </h1>
            <p><?php echo $movies->getReleaseDate(); ?></p>
            <?php if($movies->getIsPlaying() == false) {?>
            <p><a id="addMovie"
                href="<?php echo FRONT_ROOT ?>Movies/AddMovieToDatabase?IdMovieIMDB=<?php echo $movies->getIdMovieIMDB(); ?>"><button
                  id="add" class="button">Agregar</button></a></p>
            <?php } else {?>
            <p><a id="editMovie"
                href="<?php echo FRONT_ROOT ?>Screening/View?IdMovieIMDB=<?php echo $movies->getIdMovieIMDB(); ?>"><button
                  id="edit" class="button">Editar</button></a></p>
            <p><a id="removeMovie"
                href="<?php echo FRONT_ROOT ?>Movies/RemoveMovie?IdMovieIMDB=<?php echo $movies->getIdMovieIMDB(); ?>"><button
                  id="remove" class="button">Eliminar</button></a></p>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
</div>




</html>