<header>
    <h1>Ajout catégorie</h1>
</header>

<section>
    <?php include __DIR__ .'/../templates/message.php'?>
    
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nom de la catégorie</label>
            <input type="text" value="<?= $category->name ?>" name="name" class="form-control" id="name" aria-describedby="nameHelp" required placeholder="Ex: Soucoupe volante">
            <div id="nameHelp" class="form-text text-danger"><?= $error['name'] ?? '' ?></div>

        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</section>