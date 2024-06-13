<?php
@include 'connect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerHub - Oferta Pracy</title>
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
        .job-details {
            margin-top: 20px;
        }
        .job-title {
            font-size: 24px;
            font-weight: bold;
        }
        .company-name {
            font-size: 20px;
            color: #555;
        }
        .job-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .job-card p {
            margin: 5px 0;
        }
        .apply-btn {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .apply-btn input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        .apply-btn input[type="submit"]:hover {
            background-color: #0056b3;
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
    <div class="container job-details">
        <?php
            $offerId = isset($_GET['id']) ? $_GET['id'] : 0;
            $query = "SELECT * FROM job_offer 
                      JOIN category USING (category_id) 
                      JOIN company USING (company_id) 
                      WHERE offer_id = '{$offerId}'";
            $result = $connect->query($query);

            if($result && $result->num_rows > 0) {
                while($row = $result->fetch_object()) {
                    echo <<<jobdetails
                    <div class="row">
                        <div class="col-lg-8 job-card">
                            <h2 class="job-title">$row->offer_name</h2>
                            <p class="company-name">$row->company_name</p>
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>Zawód:</strong> $row->job_name</p>
                                    <p><strong>Poziom:</strong> $row->job_level</p>
                                    <p><strong>Typ kontraktu:</strong> $row->type_of_contract</p>
                                    <p><strong>Wymiar zatrudnienia:</strong> $row->employment_dimension</p>
                                    <p><strong>Typ pracy:</strong> $row->type_of_work</p>
                                    <p><strong>Wynagrodzenie:</strong> $row->salary_range_min zł - $row->salary_range_max zł</p>
                                    <p><strong>Dni pracy:</strong> $row->days_of_work</p>
                                    <p><strong>Godziny pracy:</strong> $row->work_hours_min - $row->work_hours_max</p>
                                    <p><strong>Wygaśnięcie ogłoszenia:</strong> $row->end_of_recrutation</p>
                                    <p><strong>Kategoria:</strong> $row->category_name</p>
                                </div>
                                <div class="col-6">
                                    <p><strong>Obowiązki:</strong></p>
                                    <p>$row->responsibilities</p>
                                    <p><strong>Wymagania:</strong></p>
                                    <p>$row->requirements</p>
                                    <p><strong>Benefity:</strong></p>
                                    <p>$row->benefits</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2434.2907640568674!2d16.915563717484464!3d52.40140631068507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47045b30521deb93%3A0xfe133a1f0df4613e!2zUGFya2luZyBQb3puYcWEIEfFgsOzd255!5e0!3m2!1spl!2spl!4v1710795224912!5m2!1spl!2spl" 
                                width="100%" 
                                height="450" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="row apply-btn">
                        <form action="Oferta.php?id={$offerId}" method="post">
                            <input type="submit" value="Aplikuj" name="apply">
                        </form>
                    </div>
                    jobdetails;

                    if(isset($_POST['apply'])) {
                        $userId = $_SESSION['user_id'];
                        $date = date('Y-m-d');
                        $applyQuery = "INSERT INTO applications (user_id, job_offer_id, application_date) VALUES ($userId, $offerId, '$date')";
                        $connect->query($applyQuery);
                        echo "<p class='alert alert-success'>Aplikacja złożona pomyślnie!</p>";
                    }
                }
            } else {
                echo "<p class='alert alert-danger'>Nie znaleziono takiej oferty pracy.</p>";
            }
        ?>
    </div>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2024 CareerHub. Wszystkie prawa zastrzeżone.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>