<?php
    session_start();
    @include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerHub - Wyszukiwarka</title>
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
        <form action="" method="post" class="mb-5">
            <div class="row mb-4">
                <div class="col text-center">
                    <input type="text" name="searchedText" class="form-control" placeholder="Search" aria-label="search">
                </div>
            </div>
            <div class="accordion" id="accordionFilters">
                <!-- Firma Filter -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Firma
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFilters">
                        <div class="accordion-body">
                            <select class="form-select" name="companySelect">
                                <option value="">Wybierz firmę</option>
                                <?php
                                    $query = "SELECT company_id, company_name FROM `company`";
                                    $result = $connect->query($query);

                                    while ($row = $result->fetch_object()) {
                                        echo "<option value='$row->company_id'>$row->company_name</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Stanowisko Filter -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Stanowisko
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFilters">
                        <div class="accordion-body">
                            <select class="form-select" name="jobName">
                                <option value="">Wybierz stanowisko</option>
                                <?php
                                    $query = "SELECT DISTINCT job_name FROM `job_offer`";
                                    $result = $connect->query($query);

                                    while ($row = $result->fetch_object()) {
                                        echo "<option value='$row->job_name'>$row->job_name</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Typ umowy Filter -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Typ umowy
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFilters">
                        <div class="accordion-body">
                            <select class="form-select" name="typeOfContract">
                                <option value="">Wybierz typ umowy</option>
                                <?php
                                    $query = "SELECT DISTINCT type_of_contract FROM `job_offer`";
                                    $result = $connect->query($query);

                                    while ($row = $result->fetch_object()) {
                                        echo "<option value='$row->type_of_contract'>$row->type_of_contract</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Kategoria Filter -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Kategoria
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionFilters">
                        <div class="accordion-body">
                            <select class="form-select" name="category">
                                <option value="">Wybierz kategorię</option>
                                <?php
                                    $query = "SELECT * FROM `category`";
                                    $result = $connect->query($query);

                                    while ($row = $result->fetch_object()) {
                                        echo "<option value='$row->category_id'>$row->category_name</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Poziom stanowiska Filter -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Poziom stanowiska
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionFilters">
                        <div class="accordion-body">
                            <select class="form-select" name="jobLevel">
                                <option value="">Wybierz poziom stanowiska</option>
                                <?php
                                    $query = "SELECT DISTINCT job_level FROM `job_offer`";
                                    $result = $connect->query($query);

                                    while ($row = $result->fetch_object()) {
                                        echo "<option value='$row->job_level'>$row->job_level</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Tryb pracy Filter -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            Tryb pracy
                        </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionFilters">
                        <div class="accordion-body">
                            <select class="form-select" name="typeOfWork">
                                <option value="">Wybierz tryb pracy</option>
                                <?php
                                    $query = "SELECT DISTINCT type_of_work FROM `job_offer`";
                                    $result = $connect->query($query);

                                    while ($row = $result->fetch_object()) {
                                        echo "<option value='$row->type_of_work'>$row->type_of_work</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Wymiar etatu Filter -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            Wymiar etatu
                        </button>
                    </h2>
                    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionFilters">
                        <div class="accordion-body">
                            <select class="form-select" name="employmentDimension">
                                <option value="">Wybierz wymiar etatu</option>
                                <?php
                                    $query = "SELECT DISTINCT employment_dimension FROM `job_offer`";
                                    $result = $connect->query($query);

                                    while ($row = $result->fetch_object()) {
                                        echo "<option value='$row->employment_dimension'>$row->employment_dimension</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col text-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Szukaj</button>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-12">
                <?php 
                    if (isset($_POST['submit'])) {
                        $query = "SELECT *, category.category_name, company.company_name FROM `job_offer` 
                                  JOIN category USING(category_id) 
                                  JOIN company USING(company_id) 
                                  WHERE 1";

                        if (!empty($_POST['searchedText'])) {
                            $searchText = $_POST['searchedText'];
                            $query .= " AND (offer_name LIKE '%$searchText%' OR job_name LIKE '%$searchText%')";
                        }

                        if (!empty($_POST['companySelect'])) {
                            $companyId = $_POST['companySelect'];
                            $query .= " AND company_id = '$companyId'";
                        }

                        if (!empty($_POST['jobName'])) {
                            $jobName = $_POST['jobName'];
                            $query .= " AND job_name = '$jobName'";
                        }

                        if (!empty($_POST['typeOfContract'])) {
                            $typeOfContract = $_POST['typeOfContract'];
                            $query .= " AND type_of_contract = '$typeOfContract'";
                        }

                        if (!empty($_POST['category'])) {
                            $category = $_POST['category'];
                            $query .= " AND category_id = '$category'";
                        }

                        if (!empty($_POST['jobLevel'])) {
                            $jobLevel = $_POST['jobLevel'];
                            $query .= " AND job_level = '$jobLevel'";
                        }

                        if (!empty($_POST['typeOfWork'])) {
                            $typeOfWork = $_POST['typeOfWork'];
                            $query .= " AND type_of_work = '$typeOfWork'";
                        }

                        if (!empty($_POST['employmentDimension'])) {
                            $employmentDimension = $_POST['employmentDimension'];
                            $query .= " AND employment_dimension = '$employmentDimension'";
                        }

                        $result = $connect->query($query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_object()) {
                                echo <<<DATA
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <h5 class="card-title">$row->offer_name</h5>
                                            <p class="card-text">$row->responsibilities</p>
                                            <p class="card-text"><small class="text-muted">Godziny pracy: $row->work_hours_min - $row->work_hours_max</small></p>
                                            <a href="Oferta.php?id={$row->offer_id}" class="btn btn-primary">Odwiedz stronę ogłoszenia</a>
                                        </div>
                                    </div>
                                DATA;
                            }
                        } else {
                            echo "<p class='text-center'>Nie znaleziono ofert spełniających podane kryteria.</p>";
                        }
                    }
                ?>
            </div>
        </div>
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
