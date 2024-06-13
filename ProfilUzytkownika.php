<?php
@include 'connect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerHub - Mój Profil</title>
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
        .profile-image {
            border-radius: 50%;
            max-width: 150px;
            height: auto;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
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

    <!-- Main Content -->
    <div class="container mt-5">
        <?php
            if(isset($_SESSION['user_login'])) {
                $login = $_SESSION['user_login'];
                $query = "SELECT * FROM user WHERE user_login = '$login'";
                $result = $connect->query($query);

                if ($result && $row = $result->fetch_object()) {
                    $src = $row->profile_picture;
                    $userId = $row->user_id;
                    echo <<<PROFILE
                        <div class="row">
                            <div class="col-lg-4 mb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src="$src" alt="zdjęcie profilowe" class="profile-image mb-3">
                                        <h5 class="card-title">$row->firstname $row->surname</h5>
                                        <p class="card-text">$row->email</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Dane użytkownika</h5>
                                        <p class="card-text">Imię: $row->firstname</p>
                                        <p class="card-text">Nazwisko: $row->surname</p>
                                        <p class="card-text">Data urodzenia: $row->date_of_birth</p>
                                        <p class="card-text">E-mail: $row->email</p>
                                        <p class="card-text">Numer telefonu: $row->tel_number</p>
                                        <p class="card-text">Miejsce zamieszkania: $row->place_of_residence</p>
                                        <p class="card-text">Obecny zawód: $row->current_position</p>
                                        <p class="card-text">Opis zawodu: $row->description_of_position</p>
                                        <p class="card-text">Podsumowanie profesji: $row->profession_summary</p>
                                        <p class="card-text">Znajomość języków: $row->knowledge_of_languages</p>
                                        <p class="card-text">Umiejętności: $row->skills</p>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Twoje aplikacje</h5>
                                        <div class="row">
PROFILE;

                    $query1 = "SELECT * FROM `applications` 
                               JOIN job_offer ON applications.job_offer_id = job_offer.offer_id 
                               WHERE user_id = $userId";
                    $result1 = $connect->query($query1);

                    if ($result1->num_rows > 0) {
                        while($row1 = $result1->fetch_object()) {
                            echo <<<CARD
                                <div class="col-lg-4 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">$row1->offer_name</h5>
                                            <p class="card-text">$row1->job_name</p>
                                            <a href="Oferta.php?id=$row1->offer_id" class="btn btn-primary">Przejdź do oferty</a>
                                        </div>
                                    </div>
                                </div>
CARD;
                        }
                    } else {
                        echo "<p class='text-center'>Brak aplikacji.</p>";
                    }

                    echo <<<CLOSEPROFILE
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
CLOSEPROFILE;
                } else {
                    echo "<p class='text-center'>Błąd w odczycie danych użytkownika.</p>";
                }
            } else {
                header("Location: Login.php");
            }
        ?>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <p class="mb-0">&copy; 2024 CareerHub. Wszelkie prawa zastrzeżone.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>