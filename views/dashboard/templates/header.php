<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rent My Ride</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Roboto+Flex:opsz,wght@8..144,100;8..144,200;8..144,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/public/assets/css/dashboard.css">
</head>

<body>
    <aside class="sidebar">
        <header>
            <h1>Dashboard</h1>
        </header>
        <nav>
            <ul>
                <li><a href="/controllers/dashboard/categories/list-ctrl.php"><i class="fa-solid fa-cubes"></i>Catégories</a></li>
                <li><a href="/controllers/dashboard/vehicles/list-ctrl.php"><i class="fa-solid fa-car"></i>Véhicules</a></li>
                <li><a href="/controllers/dashboard/rents/list-ctrl.php"><i class="fa-solid fa-list-check"></i>Réservations</a></li>
            </ul>
        </nav>
    </aside>
    <main class="content">