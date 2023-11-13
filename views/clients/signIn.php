<h1>Connexion</h1>

<?php
FlashMessage::display();
?>

<form method="post" id="signInForm" novalidate>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">

                <div class="form-group mb-4">
                    <label for="email">Votre email</label>
                    <input class="form-control" type="email" id="email" name="email" required placeholder="Ex: Jean@mail.com">
                    <?= $errors['email'] ?? '' ?>
                </div>

                <div class="form-group mb-4">
                    <label for="password">Votre mot de passe</label>
                    <input class="form-control" type="password" id="password" name="password" required placeholder="Ex: X5x?!,jhtzu%vr38">
                    <?= $errors['password'] ?? '' ?>
                </div>

                <div class="text-center mb-4">
                    <button type="submit" class="btn btn-primary">Connexion</button>
                </div>
            </div>
        </div>
    </div>

</form>
