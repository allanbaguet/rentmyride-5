<header>
    <h1>Ajout d'un véhicule</h1>
</header>

<section>
    <form method="POST" enctype="multipart/form-data" novalidate>

        <div class="mb-3">
            <label for="id_categories" class="form-label">Catégorie*</label>
            <select name="id_categories" id="id_categories" class="form-select">
                <?php
                foreach ($categories as $key => $category) {
                    $isSelected = ($vehicle->id_categories == $category->id_categories) ? 'selected ' : '';
                    echo '<option ' . $isSelected . ' value="' . $category->id_categories . '">' . $category->name . '</option>';
                }
                ?>
            </select>
            <div id="id_categoriesHelp" class="form-text text-danger"><?= $error['id_categories'] ?? '' ?></div>
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Marque du véhicule*</label>
            <input type="text" value="<?= $vehicle->brand ?? '' ?>" pattern="<?= NAME ?>" name="brand" class="form-control" id="brand" aria-describedby="brandHelp" required placeholder="Ex: Porsche">
            <div id="brandHelp" class="form-text text-danger"><?= $error['brand'] ?? '' ?></div>
        </div>

        <div class="mb-3">
            <label for="model" class="form-label">Modèle du véhicule*</label>
            <input type="text" value="<?= $vehicle->model ?? '' ?>" pattern="<?= NAME ?>" name="model" class="form-control" id="model" aria-describedby="modelHelp" required placeholder="Ex: 911 Carrera">
            <div id="modelHelp" class="form-text text-danger"><?= $error['model'] ?? '' ?></div>
        </div>

        <div class="mb-3">
            <label for="registration" class="form-label">Immatriculation*</label>
            <input type="text" value="<?= $vehicle->registration ?? '' ?>" pattern="<?= REGISTRATION ?>" name="registration" class="form-control" id="registration" aria-describedby="registrationHelp" required placeholder="Ex: AA-123-BB">
            <div id="registrationHelp" class="form-text text-danger"><?= $error['registration'] ?? '' ?></div>
        </div>

        <div class="mb-3">
            <label for="mileage" class="form-label">Kilométrage*</label>
            <input type="text" value="<?= $vehicle->mileage ?? '' ?>" pattern="<?= MILEAGE ?>" name="mileage" class="form-control" id="mileage" aria-describedby="mileageHelp" required placeholder="Ex: 125000">
            <div id="mileageHelp" class="form-text text-danger"><?= $error['mileage'] ?? '' ?></div>
        </div>

        <div class="mb-3">
            <label for="picture" class="form-label">Illustration</label>
            <input type="file" name="picture" class="form-control" id="picture" aria-describedby="pictureHelp" accept="jpg">
            <?php if ($vehicle->picture) { ?>
                <div><img src="/public/uploads/vehicles/<?=$vehicle->picture?>" class="thumb mt-2"></div>
            <?php } ?>
            <div id="pictureHelp" class="form-text text-danger"><?= $error['picture'] ?? '' ?></div>
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</section>