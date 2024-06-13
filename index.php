<?php
@include 'connect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .navbar {
            background-color: #fff;
            border-bottom: 2px solid #e9ecef;
        }
        .navbar-brand img {
            height: 50px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .card h5, .card p {
            color: #555;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .footer {
            background-color: #fff;
            padding: 20px 0;
            border-top: 2px solid #e9ecef;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="logo.png" alt="CareerHub Logo">
                CareerHub
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class='bx bx-home-alt-2'></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Wyszukiwarka.php"><i class='bx bx-search-alt-2'></i> Wyszukaj</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ProfilePracodawcow.php"><i class='bx bx-briefcase-alt-2'></i> Pracodawcy</a>
                    </li>
                    <?php if (isset($_SESSION['account_type'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-user-circle'></i> Konto
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="ProfilUzytkownika.php">Mój profil</a></li>
                                <li><a class="dropdown-item" href="logout.php">Wyloguj się</a></li>
                            </ul>
                        </li>
                        <?php if ($_SESSION['account_type'] == "admin"): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="PanelAdmina.php"><i class='bx bx-cog'></i> Panel Admina</a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="Login.php"><i class='bx bx-log-in'></i> Zaloguj się</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <section class="mb-5">
            <h2 class="mb-4">Najnowsze oferty</h2>
            <div class="row">
                <?php
                    $query = "SELECT * FROM job_offer ORDER BY end_of_recrutation DESC LIMIT 3";
                    $result = $connect->query($query);

                    while($row = $result->fetch_object()):
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row->offer_name) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($row->job_name) ?></p>
                                <a href="Oferta.php?id=<?= $row->offer_id ?>" class="btn btn-primary">Przejdź do oferty</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>

        <section class="mb-5">
            <h2 class="mb-4">Polecane oferty</h2>
            <div class="row">
                <?php
                    $query = "SELECT * FROM job_offer LIMIT 3";
                    $result = $connect->query($query);

                    while($row = $result->fetch_object()):
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row->offer_name) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($row->job_name) ?></p>
                                <a href="Oferta.php?id=<?= $row->offer_id ?>" class="btn btn-primary">Przejdź do oferty</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>

        <section>
            <h2 class="mb-4">Ostatnio aplikowane</h2>
            <div class="row">
                <?php
                    if(isset($_SESSION['user_id'])):
                        $userId = $_SESSION['user_id'];
                        $query = "SELECT * FROM `applications` JOIN job_offer ON job_offer_id = job_offer.offer_id WHERE user_id = $userId ORDER BY application_date DESC LIMIT 3";
                        $result = $connect->query($query);

                        while($row = $result->fetch_object()):
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row->offer_name) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($row->job_name) ?></p>
                                <a href="Oferta.php?id=<?= $row->offer_id ?>" class="btn btn-primary">Przejdź do oferty</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; endif; ?>
            </div>
        </section>
    </div>

    <footer class="footer text-center py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p class="mb-0">© 2024 CareerHub. Wszystkie prawa zastrzeżone.</p>
                </div>
                <div class="col-md-4">
                    <p class="mb-0">Kontakt:</p>
                    <p>E-mail: email@gmail.com<br>Tel: 123123123</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>