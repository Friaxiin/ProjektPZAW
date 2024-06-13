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
    <title>Rejestracja - CareerHub</title>
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
        .card h2 {
            color: #555;
        }
        .form-control {
            border: 1px solid #ccc;
            border-radius: 5px;
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
            <div class="col-md-6 offset-md-3">
                <div class="card p-4">
                    <h2 class="text-center mb-4">Rejestracja</h2>
                    <form action="" method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="login" placeholder="Login" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Hasło" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="firstName" placeholder="Imię" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="surname" placeholder="Nazwisko" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="dateOfBirth" placeholder="Data urodzenia" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" class="form-control" name="telNumber" placeholder="Numer telefonu" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="placeOfResidence" placeholder="Miejsce zamieszkania" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="rejestruj" class="btn btn-primary">Zarejestruj</button>
                        </div>
                    </form>

                    <?php
                        if(isset($_POST["rejestruj"]))
                        {
                            $login = mysqli_real_escape_string($connect, $_POST["login"]);
                            $password = mysqli_real_escape_string($connect, $_POST["password"]);
                            $firstName = mysqli_real_escape_string($connect, $_POST["firstName"]);
                            $surname = mysqli_real_escape_string($connect, $_POST["surname"]);
                            $dateOfBirth = mysqli_real_escape_string($connect, $_POST["dateOfBirth"]);
                            $email = mysqli_real_escape_string($connect, $_POST["email"]);
                            $telNumber = mysqli_real_escape_string($connect, $_POST["telNumber"]);
                            $placeOfResidence = mysqli_real_escape_string($connect, $_POST["placeOfResidence"]);

                            $defaultImg = "userProfilePictures/default.jpg";

                            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                            $duplicate = mysqli_query($connect, "SELECT * FROM user WHERE email = '$email' OR user_login = '$login'");

                            if(mysqli_num_rows($duplicate) > 0)
                            {
                                echo "<div class='alert alert-danger mt-3'>Podany e-mail lub nazwa użytkownika jest już w użyciu</div>";
                            }
                            else
                            {
                                if(!empty($login) && !empty($password) && !empty($firstName) && !empty($surname) && !empty($dateOfBirth) && !empty($email) && !empty($telNumber) && !empty($placeOfResidence))
                                {
                                    $query = "INSERT INTO user (user_login, user_password, firstname, surname, date_of_birth, email, tel_number, profile_picture, place_of_residence, account_type) 
                                                        VALUES ('$login', '$passwordHash', '$firstName', '$surname', '$dateOfBirth', '$email', '$telNumber', '$defaultImg', '$placeOfResidence', 'user')";
                                    mysqli_query($connect, $query);
                                    header("Location: Login.php");
                                    exit();
                                }
                                else
                                {
                                    echo "<div class='alert alert-danger mt-3'>Wypełnij wszystkie wymagane pola</div>";
                                }
                            }
                        }
                    ?>
                </div>
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
</body>
</html>