<?php
@include 'connect.php';
session_start();
ob_start();
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
        <div class="row">
            <div class="col-md-4">
                <h2>FAQ</h2>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Jak się zarejestrować?
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>Aby się zarejestrować, kliknij przycisk "Rejestracja" w prawym górnym rogu i wypełnij formularz.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Jak zresetować hasło?
                        </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>Aby zresetować hasło, kliknij "Zapomniałeś hasła?" na stronie logowania i postępuj zgodnie z instrukcjami.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Jak aplikować na ofertę pracy?
                        </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>Aby aplikować na ofertę pracy, zaloguj się, wyszukaj interesującą ofertę i kliknij "Aplikuj".</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 offset-md-1">
                <h2>Logowanie</h2>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="login" class="form-label">Login</label>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Login" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Hasło</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Hasło" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Zaloguj</button>
                </form>
                <a href="Rejestracja.php" class="d-block mt-3">Nie masz konta? Zarejestruj się</a>

                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $login = mysqli_real_escape_string($connect, $_POST["login"]);
                        $password = mysqli_real_escape_string($connect, $_POST["password"]);

                        $query = "SELECT * FROM user WHERE user_login = '$login'";
                        $result = $connect->query($query);

                        if (mysqli_num_rows($result) > 0) {
                            $row = $result->fetch_object();

                            if (password_verify($password, $row->user_password)) {
                                $_SESSION['user_login'] = $login;
                                $_SESSION['account_type'] = $row->account_type;
                                $_SESSION['user_id'] = $row->user_id;
                                header("Location: index.php");
                                exit();
                            } else {
                                echo "<div class='alert alert-danger mt-3'>Niepoprawna nazwa użytkownika lub hasło</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Niepoprawna nazwa użytkownika lub hasło</div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <footer class="footer text-center py-4 mt-5">
        <div class="container">
            <p>Kontakt: email@gmail.com | Tel: 123123123</p>
        </div>
    </footer>

    <?php
        ob_end_flush();
        $connect->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>