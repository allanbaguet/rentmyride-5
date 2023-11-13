<div id="vehicles" class="container-fluid">

    <div class="row">

        <?php
        foreach ($vehicles as $vehicle) {
            include __DIR__ . '/../templates/card.php';
        }
        ?>

    </div>

    <div id="pagination">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center" >
                <li class="page-item">
                    <a class="page-link" href="?id_categories=<?= $id_categories ?>&search=<?= $search ?>&page=<?= ($page > 1) ? $page - 1 : 1 ?>">Précédent</a>
                </li>
                <?php

                for ($numberPage = 1; $numberPage <= $nbPages; $numberPage++) {
                    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?id_categories=$id_categories&search=$search&page=$numberPage\">$numberPage</a></li>";
                } ?>

                <li class="page-item">
                    <a class="page-link" href="?id_categories=<?= $id_categories ?>&search=<?= $search ?>&page=<?= ($page < $nbPages) ? $page + 1 : $page ?>">Suivant</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
