<header>
    <h1>Liste des véhicules</h1>
</header>


<section>
    <?php
    FlashMessage::display();
    ?>

    <!-- // A venir
    <div class="form-group mb-3">
        <input type="search" class="form-control" name="search" id="search" placeholder="Ex: Avion">
    </div> -->

    <table class="table">
        <thead>
            <tr>

                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Modèle</th>
                <th scope="col">Immatriculation</th>
                <th scope="col">Date de début</th>
                <th scope="col">Date de fin</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody id="rentsList">
            <?php
            foreach ($rents as $key => $rent) {
                $isDeleted = ($rent->deleted_at) ? 'deleted' : '';
            ?>
                <tr>
                    <td><?= $rent->lastname ?></td>
                    <td><?= $rent->firstname ?></td>
                    <td><?= $rent->model ?></td>
                    <td><?= $rent->registration ?></td>
                    <td><?= $rent->startdate ?></td>
                    <td><?= $rent->enddate ?></td>
                    <td class="text-center">
                        <i class="fa-regular fa-envelope"></i>
                    </td>

                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
</section>

<script src="/public/assets/js/searchrent.js"></script>