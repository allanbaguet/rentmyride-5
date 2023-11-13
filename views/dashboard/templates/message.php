<?php

if (isset($message)) { ?>
    <div class="alert alert-success" role="alert">
        <?= $message ?? '' ?>
    </div>

<?php }
?>