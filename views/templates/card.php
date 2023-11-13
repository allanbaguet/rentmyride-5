<div class="col-12 col-md-6 col-lg-4 col-xl-3">

<a href="/controllers/vehiclesDetail-ctrl.php?id_vehicles=<?=$vehicle->id_vehicles?>">
    <div class="card h-100 p-4">
        <div class="picture h-100">
            <?php
            if (!$vehicle->picture) { ?>
                <img src="/public/assets/img/ghost.png" alt="Visuel véhicule par défaut">
            <?php } else { ?>
                <img src="/public/uploads/vehicles/<?= $vehicle->picture ?>" alt="<?= $vehicle->brand . ' ' . $vehicle->model ?>">
            <?php } ?>
        </div>
        <div class="content">
            <div class="category">
                <?= $vehicle->name ?>
            </div>
            <div class="brand ps-2">
                <?= $vehicle->brand ?>
            </div>
            <div class="model ps-2">
                <?= $vehicle->model ?>
            </div>
        </div>
    </div>
    </a>

</div>