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
    <title>CareerHub - Profil Firmy</title>
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
        .main-content {
            margin-top: 20px;
        }
        .company-info {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .company-info h1 {
            font-size: 28px;
            font-weight: bold;
        }
        .company-info p {
            margin: 10px 0;
        }
        .company-info p strong {
            font-weight: bold;
        }
        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .action-buttons input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        .action-buttons input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .login-form {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            margin: auto;
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
        }
        .login-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .login-form a {
            color: #007bff;
            text-decoration: none;
        }
        .login-form a:hover {
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
        <?php
        if(isset($_SESSION['cId'])){
            $cId = $_SESSION['cId']; 
            $query = "SELECT * FROM `company` WHERE company_id = '$cId'";
            $result = $connect->query($query);
                
            $cData = null;
            while ($row = $result->fetch_object()) {
                $cData = array(
                    'company_name' => $row->company_name,
                    'company_login' => $row->company_login,
                    'city' => $row->city,
                    'street' => $row->street,
                    'street_number' => $row->street_number,
                    'longtitude' => $row->longtitude,
                    'latitude' => $row->latitude,
                    'info' => $row->info
                );
            }
                
            if ($cData) {
                foreach ($cData as $key => $data) {
                    if ($data == '') {
                        $cData[$key] = '<strong>Brak danych</strong>';
                    }
                }
        ?>
            <div class="company-info">
                <h1><?php echo $cData['company_name']; ?></h1>
                <p><strong>Login firmy:</strong> <?php echo $cData['company_login']; ?></p>
                <p><strong>Miasto:</strong> <?php echo $cData['city']; ?></p>
                <p><strong>Ulica:</strong> <?php echo $cData['street']; ?></p>
                <p><strong>Numer ulicy:</strong> <?php echo $cData['street_number']; ?></p>
                <p><strong>Długość geograficzna:</strong> <?php echo $cData['longtitude']; ?></p>
                <p><strong>Szerokość geograficzna:</strong> <?php echo $cData['latitude']; ?></p>
                <p><strong>Informacje:</strong> <?php echo $cData['info']; ?></p>

                <div class="action-buttons">
                    <form action="#" method="post">
                        <input type="submit" value="Wyloguj z profilu firmy" name="submitLogoutFromCompanyProf">
                        <input type="submit" value="Edytuj firmę" name="submitEditCompany">
                    </form>
                </div>

                <?php
                if(isset($_POST['submitLogoutFromCompanyProf'])){
                    unset($_SESSION['cId']);
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                } elseif(isset($_POST['submitEditCompany'])){
                    $query = "SELECT * FROM `company` WHERE company_id = '$cId'";
                    $result = $connect->query($query);
                    $row = $result->fetch_object();

                    echo <<< editForm
                        <form action="ProfilePracodawcow.php" method="post" class="mt-3">
                            <div class="mb-3">
                                <label for="companyName" class="form-label">Nazwa firmy:</label>
                                <input type="text" name="companyName" class="form-control" value="$row->company_name">
                            </div>
                            <div class="mb-3">
                                <label for="companyLogin" class="form-label">Login:</label>
                                <input type="text" name="companyLogin" class="form-control" value="$row->company_login">
                            </div>
                            <div class="mb-3">
                                <label for="companyPass" class="form-label">Hasło:</label>
                                <input type="password" name="companyPass" class="form-control">
                                <small class="form-text text-muted">Podaj nowe hasło (jeżeli nie zmieniasz, zostaw puste).</small>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">Miasto:</label>
                                <input type="text" name="city" class="form-control" value="$row->city">
                            </div>
                            <div class="mb-3">
                                <label for="street" class="form-label">Ulica:</label>
                                <input type="text" name="street" class="form-control" value="$row->street">
                            </div>
                            <div class="mb-3">
                                <label for="streetNumber" class="form-label">Numer ulicy:</label>
                                <input type="number" name="streetNumber" class="form-control" value="$row->street_number">
                            </div>
                            <div class="mb-3">
                                <label for="longtitude" class="form-label">Długość geograficzna:</label>
                                <input type="number" step="0.000001" name="longtitude" class="form-control" value="$row->longtitude">
                            </div>
                            <div class="mb-3">
                                <label for="latitude" class="form-label">Szerokość geograficzna:</label>
                                <input type="number" step="0.000001" name="latitude" class="form-control" value="$row->latitude">
                            </div>
                            <div class="mb-3">
                                <label for="desc" class="form-label">Opis:</label>
                                <textarea name="desc" class="form-control" rows="3">$row->info</textarea>
                            </div>
                            <input type="submit" value="Edytuj" name="submitEditData" class="btn btn-primary">
                        </form>
                    editForm;

                    if(isset($_POST['submitEditData'])){
                        $companyName = $_POST['companyName'] ? $_POST['companyName'] : null;
                        $companyLogin = $_POST['companyLogin'] ? $_POST['companyLogin'] : null;
                        $city = $_POST['city'] ? $_POST['city'] : null;
                        $street = $_POST['street'] ? $_POST['street'] : null;
                        $streetNumber = $_POST['streetNumber'] ? $_POST['streetNumber'] : null;
                        $longtitude = $_POST['longtitude'] ? $_POST['longtitude'] : null;
                        $latitude = $_POST['latitude'] ? $_POST['latitude'] : null;
                        $desc = $_POST['desc'] ? $_POST['desc'] : null;

                        $companyPass = ""; 
                        if(!empty($_POST['companyPass'])){
                            $companyPass = $_POST['companyPass'];
                            $companyPass = password_hash($companyPass, PASSWORD_DEFAULT);
                        } else {
                            $companyPass = $row->company_password;
                        }

                        $query = "UPDATE company SET 
                            company_name = '$companyName',
                            company_login = '$companyLogin', 
                            company_password = '$companyPass',
                            city = '$city',
                            street = '$street',
                            street_number = '$streetNumber',
                            longtitude = '$longtitude',
                            latitude = '$latitude',
                            info = '$desc' 
                            WHERE company_id = '$cId'";

                        if ($connect->query($query)) {
                            echo '<div class="alert alert-success mt-3">Dane firmy zostały zaktualizowane.</div>';
                            header("Location: " . $_SERVER['PHP_SELF']);
                            exit();
                        } else {
                            echo '<div class="alert alert-danger mt-3">Aktualizacja nie powiodła się: ' . $connect->error . '</div>';
                        }
                    }
                }
                ?>
            </div>
        <?php
            } else {
                echo '<p class="alert alert-warning">Nie znaleziono danych dla tej firmy.</p>';
            }
        } else {
        ?>
            <div class="login-form">
                <form action="ProfilePracodawcow.php" method="post">
                    <input type="text" placeholder="Login firmy" name="cLogin" required>
                    <input type="password" placeholder="Hasło" name="cPass" required>
                    <input type="submit" value="Zaloguj" name="submit">
                </form>
                <p class="mt-3">Nie posiadasz konta firmowego? <a href="ProfilePracodawcowRejestracja.php">Klinkij tutaj</a></p>
            </div>
        <?php
        }

        if(isset($_POST['submit'])){
            $cLogin = $_POST['cLogin'];
            $cPass = $_POST['cPass'];

            $query = "SELECT * FROM company WHERE company_login = '$cLogin'";
            $result = $connect->query($query);

            if($result->num_rows <= 0){
                echo '<div class="alert alert-danger mt-3">Proszę przejść do rejestracji firmy klikając <a href="ProfilePracodawcowRejestracja.php" class="alert-link">tutaj</a>.</div>';
            } else {
                $row = $result->fetch_object();
                if(!password_verify($cPass, $row->company_password)){
                    echo '<div class="alert alert-danger mt-3">Niepoprawne hasło</div>';
                } else {
                    $_SESSION['cId'] = $row->company_id;
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                }
            }
        }
        $connect->close();
        ob_end_flush();
        ?>
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
