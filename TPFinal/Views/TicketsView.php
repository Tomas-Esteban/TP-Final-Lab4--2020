<?php require_once("navbar.php"); ?>
<style>
    .SearchField {
        width: 20%;
    }

    .container {
        padding: 3%;
        height: 85%;
        background-color: white;
        opacity: .9;
        background-size: cover;
        margin-top: 1%;
        width: 70%;
        border-radius: 1%;
    }

    .overflow-auto {
        height: 85%;
    }

    .card-text {
        margin: -2%;
    }

    .card {
        background-color: black;
        color: white;
        opacity: 1;
        margin: 5%;
        padding: 1%;
        width: 75%;
    }
</style>
<body>
    <div class="container">
        <div class="overflow-auto">
            <?php foreach ($ticket as $t) { ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="card-text">Ticket: <?php echo $t->getIdTicket(); ?> </p><br>
                                <p class="card-text">Precio: <?php echo $t->getPrice(); ?> </p><br>
                                <p class="card-text">Sala: <?php echo $t->getIdRoom(); ?> </p><br>
                                <p class="card-text">Butaca: <?php echo $t->getIdSeat();?> </p><br>
                                <p class="card-text">Nro Orden: <?php echo $t->getIdOrder(); ?> </p><br>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
