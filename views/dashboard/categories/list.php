<header>
    <h1>Liste des catégories</h1>
</header>


<section>
    <a href="/controllers/dashboard/categories/add-ctrl.php" class="call-action btn btn-primary">+ Créer une nouvelle catégorie</a>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom de la catégorie</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($categories as $key => $category) {
            ?>
                <tr>
                    <td><a href="/controllers/dashboard/categories/update-ctrl.php?id_categories=<?=$category->id_categories?>"><?= $category->name ?></a></td>
                    <td class="text-center">
                        <a href="/controllers/dashboard/categories/update-ctrl.php?id_categories=<?=$category->id_categories?>"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a href="/controllers/dashboard/categories/delete-ctrl.php?id_categories=<?=$category->id_categories?>"><i class="fa-regular fa-trash-can"></i></a>
                    </td>

                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
</section>