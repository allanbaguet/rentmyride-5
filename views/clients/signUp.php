<h1>Inscription</h1>

<?php
FlashMessage::display();
?>

<form method="post" id="signUpForm" novalidate>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="form-group mb-4">
                    <label for="lastname">Votre nom</label>
                    <input class="form-control" type="text" id="lastname" name="lastname" required placeholder="Ex: Dupond">
                </div>

                <div class="form-group mb-4">
                    <label for="firstname">Votre prénom</label>
                    <input class="form-control" type="text" id="firstname" name="firstname" required placeholder="Ex: Jean">
                </div>

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

                <div class="form-group mb-4">
                    <label for="passwordConfirm">Confirmation du mot de passe</label>
                    <input class="form-control" type="password" id="passwordConfirm" name="passwordConfirm" required placeholder="Ex: X5x?!,jhtzu%vr38">
                    <?= $errors['password'] ?? '' ?>
                </div>


                <div class="form-group mb-4">
                    <label for="birthday">Votre date de naissance</label>
                    <input class="form-control" type="date" id="birthday" name="birthday" required>
                </div>

                <div class="form-group mb-4">
                    <label for="phone">Numéro de téléphone</label>
                    <input class="form-control" type="text" id="phone" name="phone" required placeholder="Ex: 06xxxxxxxx">
                </div>

                <div class="form-group mb-4">
                    <label for="zipcode">Code postal</label>
                    <input class="form-control" maxlength="5" type="text" id="zipcode" name="zipcode" required placeholder="Ex: 80000">
                </div>

                <div class="form-group mb-4">
                    <label for="citySelect">Votre commune</label>
                    <select class="form-control" name="city" id="citySelect">
                        <option selected disabled>Liste des communes</option>
                    </select>
                </div>

                <div class="text-center mb-4">
                    <button type="submit" class="btn btn-primary">Inscription</button>
                </div>
            </div>
        </div>
    </div>




</form>

<script src="/public/assets/js/cities.js"></script>