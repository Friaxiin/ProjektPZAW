<?php
session_start();
@include 'connect.php';
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerHub - Rejestracja Firmy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
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
        .main-content {
            margin-top: 20px;
        }
        .registration-form {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            margin: auto;
        }
        .registration-form input[type="text"],
        .registration-form input[type="password"],
        .registration-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .registration-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
        }
        .registration-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .registration-form a {
            color: #007bff;
            text-decoration: none;
        }
        .registration-form a:hover {
            text-decoration: underline;
        }
        .alert {
            margin-top: 20px;
        }
        .footer {
            background-color: #fff;
            padding: 20px 0;
            border-top: 2px solid #e9ecef;
            text-align: center;
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
    <div class="container main-content">
        <div class="registration-form">
            <form action="ProfilePracodawcowRejestracja.php" method="post">
                <h2 class="text-center">Rejestracja Firmy</h2>
                <input type="text" placeholder="Login firmy" name="cLogin" required>
                <small style="color:blue; font-size:12px;">Dana wymagana podczas logowania do profilu firmy</small>
                <input type="text" placeholder="Nazwa firmy" name="cName" required>
                <input type="password" placeholder="Hasło" name="cPass" required>
                <input type="password" placeholder="Powtórz hasło" name="cPassRepeat" required>
                <input type="submit" value="Zarejestruj" name="submit">
            </form>
            <p class="text-center mt-3">Jeśli posiadasz już konto firmowe: <a href="ProfilePracodawcow.php">kliknij tutaj</a></p>

            <?php
            if (isset($_POST['submit'])) {
                $cLogin = $_POST['cLogin'];
                $cName = $_POST['cName'];
                $cPass = $_POST['cPass'];
                $cPassRepeat = $_POST['cPassRepeat'];

                $query = "SELECT * FROM company WHERE company_login = '$cLogin' AND company_name = '$cName'";
                $result = $connect->query($query);

                if ($result->num_rows > 0) {
                    echo <<< alert
                        <div class="alert alert-danger" role="alert">
                            Taka firma już istnieje!
                        </div>
                    alert;
                } else {
                    if ($cPass != $cPassRepeat) {
                        echo <<< alert
                            <div class="alert alert-danger" role="alert">
                                Hasła się nie pokrywają!
                            </div>
                        alert;
                    } else {
                        $cPassHash = password_hash($cPass, PASSWORD_DEFAULT);
                        $query = "INSERT INTO `company` (company_name, company_login, company_password) 
                                  VALUES ('$cName', '$cLogin', '$cPassHash')";
                        $connect->query($query);
                        header("Location: ProfilePracodawcow.php");
                        exit();
                    }
                }
            }
            $connect->close();
            ob_end_flush();
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 CareerHub. Wszystkie prawa zastrzeżone.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>