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

p{
  font-size: 20px;
  margin-top: 10%;
}

.container {
     min-height: 100vh; 
     height: 100% !important;
     width: 100%;
 }


#searchBox{
    position: relative;
    transform: translate(-50%,-50%);
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

#inputSearch{
    position: absolute;
    width: 100%;;
    height: 42.5px;
    line-height: 30px;
    outline: 0;
    border: 0;
    display: none;
    font-size: 1em;
    border-radius: 20px;
    padding: 0 20px;
}

#inputConfig{
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

#searchBox:hover{
    width: 200px;
    cursor: pointer;
}

#searchBox:hover input{
    display: block;
}

#searchBox:hover .fa{
    background: #07051a;
    color: white;
    display: block;
}

// select {
  // border: none;
  // font-size: 16px;
  // height: 50%;
  // margin: 0;
  // margin-top: 3.5%;
  // margin-left: 10%;
  // outline: 0;
  // padding: 5px;
  // width: 17%;
  // background-color: #2c2c2cb2;
  // background: rgba(39, 39, 39, 0.596);
  // color: #8d9092;
  // box-shadow: 0 1px 0 rgba(5, 5, 5, 0.705) inset;
  // margin-bottom: 10px;
  // border-radius: 100px;
// }

//option{
  //background: rgba(0, 0, 0, 0.418);
//}


#icon{
  margin-right: 2%;
}

.button {
  background-color: rgba(39, 116, 70, 1);
  border: none;
  color: white;
  width: 240px;
  height: 40px;
  padding: 5% 30%;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 1rem;
  cursor: pointer;
}
.button .icon {
  width: 40px;
  height: 40px;
  margin-top: 5%;
  filter: invert(100%);
}  

textbox {
  width: 70%;
  overflow: hidden;
  font-size: 15px;
  padding: 8px 0;
  margin-bottom: 5%;
  border-bottom: 1px solid white;
}
	 
 
.custom-select{
	width: 25%;
  float: right;
}
</style>


<div id="box" class="container" style="background-color: rgba(255, 255, 255, 0.5);"> 		
  <div class="row" >   
		<div class="col-md-4">
				<form id ="searchBox" action="<?php echo FRONT_ROOT ?> Cinema/getCinemaByName" method = "POST">
					<input id ="inputSearch" type="search" name="cinemaName">
						<i class="fa fa-search" id="inputConfig"></i>
				</form>				 
        </div>
    <div class="row"> 
        <div class="col-md-4 ml-auto">    
                <?php foreach($roomList as $room) { ?> 
                <p> Numero:   <?php echo $room->getRoomNumber(); ?> </p> 
                <p> Cine ID:  <?php echo $room->getIdCinema(); ?> </p> 
                <p> Asientos: <?php echo $room->getCantButacas(); ?> </p> 
                <p> Precio:   <?php echo $room->getPrecioSala(); ?> </p> 
                <p><a id="editRoom" href = "<?php echo FRONT_ROOT ?> Room/ShowEditView"></a><button class="button" type="submit">Editar</a></button></p>
                <p><a id="deleteCinema" href = "<?php echo FRONT_ROOT ?> Room/Remove"></a><button class="button" type="submit">Borrar</a></button></p>
                <?php } ?>
        </div>    
    </div>
  </div>
</div>

</html>