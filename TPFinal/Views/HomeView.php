<?php require_once("navbar.php"); ?>
<style>

.carousel img {
    max-height: 400px;
    margin: 0 auto;
    }

 .container {
    min-height: 100vh; 
    height: 100% !important;
}

.carousel-caption {
    background-color: rgba(47,47,47,0.8);
    border-radius: 25px;
}

#box {
    margin-top: 2%;
    margin-bottom: 2%;
    min-height: 100vh !important;
    border-radius: 10%;    
}

#carouselMovies {
    margin-top: 6%;    
    border-style: solid;
    border-color: linear-gradient(to right,#262b33,#707d91,#262b33);
    border-width: 20px;
    border-radius: 10px;    
}

#colCards {
    margin-top: 4%;
    margin-bottom: 4%;
}

#movieCard {
    background-color: #0169a4;
    color: white;
    border-radius: 15px;
    font-size: 0.95rem;
}

#shopCard {
    background-color: #0169a4;
    color: white;
    border-radius: 15px;
    font-size: 0.95rem;
}

#ticketCard {
    background-color: #0169a4;
    color: white;
    border-radius: 15px;
    font-size: 0.95rem;
}

</style>
<div class="container">
    <!-- Inicio Index -->
    <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
        <div id="colCarousel" class="col-md-10">
            <!-- Inicio carrusel -->
            <div id="carouselMovies" class="carousel slide carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselMovies" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselMovies" data-slide-to="1"></li>
                    <li data-target="#carouselMovies" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/LasBrujas.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Las Brujas</h5>
                            <p>Basada en el libro clásico de Roald Dahl 'Las brujas', la historia cuenta la aterradora, divertida e imaginativa historia de un niño de siete años que se encuentra con una congregación de brujas liderada por la Gran Bruja. A pesar de que su abuela se lo llevó a un centro turístico, llegan al mismo tiempo que ella y sus amigos llegan para comenzar sus rituales.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/Borat.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Borat Subsequent Moviefilm </h5>
                            <p>Borat, el exuberante, ingenuo y atrasado periodista kazajo fanático de los Estados Unidos, se propone realizar un documental sobre ese país. Borat se pone en marcha en busca de figuras políticas estadounidenses para elaborar con ellas una evaluación de la presidencia de Trump y su gestión de la crisis del coronavirus en el país. criminal.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/2067.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>2067</h5>
                            <p>El viaje de un hombre hacia el futuro para salvar un mundo moribundo.</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselMovies" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselMovies" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- Fin Carrusel -->
        </div>
        <div id="colCards" class="col-md-12">
            <!-- Menues -->

            <!-- Primera Opcion -->
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div id="movieCard" class="card text-center bg-dark" style="width: 14rem;">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/moviesIcon.svg" class="card-img-top" alt="..." style="height: 11rem; margin-top: 5%;">
                        <div class="card-body">
                            <h5 class="card-title">Peliculas</h5>
                            <p class="card-text">Vea la lista completa de películas en cartelera.</p>
                        </div>
                        <div class="card-body">
                            <a href=<?php echo FRONT_ROOT. "Movies/ShowApiMovies"?> class="btn btn-primary btn-block">Ver Cartelera</a>
                        </div>
                    </div>
                </div>

                <!-- Segunda Opcion -->
                <div class="col-md-3">
                    <div id="shopCard" class="card text-center bg-dark" style="width: 14rem;">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/transactionIcon.svg" class="card-img-top" alt="..." style="height: 11rem; margin-top: 5%;">
                        <div class="card-body">
                            <h5 class="card-title">Comprar</h5>
                            <p class="card-text">Compre entradas para las mejores películas.</p>
                        </div>
                        <div class="card-body">
                            <a href="<?php echo FRONT_ROOT. 'Purchase/View'?>" class="btn btn-primary btn-block">Comprar Entradas</a>
                        </div>
                    </div>
                </div>

                <!-- Tercera Opcion -->
                <div class="col-md-3">
                    <div id="ticketCard" class="card text-center bg-dark" style="width: 14rem;">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/ticketsIcon.svg" class="card-img-top" alt="..." style="height: 11rem; margin-top: 5%;">
                        <div class="card-body">
                            <h5 class="card-title">Mis Entradas</h5>
                            <p class="card-text">Vea sus entradas adquiridas.</p>
                        </div>
                        <div class="card-body">
                            <a href="<?php echo FRONT_ROOT?>Tickets/View"  class="btn btn-primary btn-block">Ver mis Tickets</a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Fin Menues -->
        </div>

    </div>
    <!-- Fin Index -->
</div>


