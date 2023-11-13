<header>
    <h1>Liste des véhicules</h1>
</header>


<section>
    <?php
    FlashMessage::display();
    ?>
    <a href="/controllers/dashboard/vehicles/add-ctrl.php" class="call-action btn btn-primary">+ Créer un nouveau véhicule</a>



    <div class="form-group mb-3">
        <input type="search" class="form-control" name="search" id="search" placeholder="Ex: Avion">
    </div>

    <table class="table">
        <thead>
            <tr>

                <th scope="col"><a href="?column=name&order=<?= ($order == 'DESC') ? 'ASC' : 'DESC'; ?>">Catégorie</th>
                <th scope="col">Visuel</th>
                <th scope="col"><a href="?column=brand&order=<?= ($order == 'DESC') ? 'ASC' : 'DESC'; ?>">Marque</a></th>
                <th scope="col"><a href="?column=model&order=<?= ($order == 'DESC') ? 'ASC' : 'DESC'; ?>">Modèle</a></th>
                <th scope="col">Immatriculation</th>
                <th scope="col"><a href="?column=mileage&order=<?= ($order == 'DESC') ? 'ASC' : 'DESC'; ?>">Kilométrage</a></th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody id="vehiclesList">
            <?php
            foreach ($vehicles as $key => $vehicle) {
                $isDeleted = ($vehicle->deleted_at) ? 'deleted' : '';
            ?>
                <tr class="<?= $isDeleted ?>">
                    <td><a href="/controllers/dashboard/categories/update-ctrl.php?id_categories=<?= $vehicle->id_categories ?>"><?= $vehicle->name ?></a></td>
                    <td>
                        <?php if ($vehicle->picture) { ?>
                            <a href="/controllers/dashboard/vehicles/update-ctrl.php?id_vehicles=<?= $vehicle->id_vehicles ?>">
                                <img class="thumb" src="/public/uploads/vehicles/<?= $vehicle->picture ?>">
                            </a>
                        <?php } ?>
                    </td>
                    <td><a href="/controllers/dashboard/vehicles/update-ctrl.php?id_vehicles=<?= $vehicle->id_vehicles ?>"><?= $vehicle->brand ?></a></td>
                    <td><a href="/controllers/dashboard/vehicles/update-ctrl.php?id_vehicles=<?= $vehicle->id_vehicles ?>"><?= $vehicle->model ?></a></td>
                    <td><a href="/controllers/dashboard/vehicles/update-ctrl.php?id_vehicles=<?= $vehicle->id_vehicles ?>"><?= $vehicle->registration ?></a></td>
                    <td><a href="/controllers/dashboard/vehicles/update-ctrl.php?id_vehicles=<?= $vehicle->id_vehicles ?>"><?= $vehicle->mileage ?></a></td>
                    <td class="text-center">
                        <a href="/controllers/dashboard/vehicles/update-ctrl.php?id_vehicles=<?= $vehicle->id_vehicles ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a href="/controllers/dashboard/vehicles/delete-ctrl.php?id_vehicles=<?= $vehicle->id_vehicles ?>"><i class="fa-regular fa-trash-can"></i></a>
                    </td>

                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
</section>

<script src="/public/assets/js/searchVehicle.js"></script>