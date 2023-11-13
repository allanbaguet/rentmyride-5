<div id="vehicle" class="container">
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="container-picture">
                <div class="picture">
                    <?php
                    if (!$vehicle->picture) { ?>
                        <img class="img-fluid" src="/public/assets/img/ghost.png" alt="Visuel véhicule par défaut">
                    <?php } else { ?>
                        <img class="img-fluid" src="/public/uploads/vehicles/<?= $vehicle->picture ?>" alt="<?= $vehicle->brand . ' ' . $vehicle->model ?>">
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="content">
                <div class="separator"></div>
                <div class="model">
                    <?= $vehicle->model ?>
                </div>
                <div class="category">
                    <?= $vehicle->name ?>
                </div>
                <div class="brand">
                    <?= $vehicle->brand ?>
                </div>
                <div class="mileage">
                    <?= number_format($vehicle->mileage, 0, ".", " ") ?> kms
                </div>
                <a href="/controllers/rentsBooking-ctrl.php?id_vehicles=<?=$id_vehicles?>" class="btn btn-primary">Réserver</a>

            </div>
        </div>
    </div>
</div>