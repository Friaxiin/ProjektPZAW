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
                <section>
                    <h5>Użytkownicy</h5>
                    <form action="#" method="post">
                        <div class="mb-3">
                            <select size="5" class="form-select" name="userSelect">
                                <?php
                                    $query = "SELECT * FROM user";
                                    $result = $connect->query($query);

                                    if($result->num_rows > 0)
                                    {
                                        while($row = $result->fetch_object())
                                        {
                                            echo "<option value='$row->user_login'>$row->user_login</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-danger me-2" value="Usuń użytkownika" name="userDelete">
                            <input type="submit" class="btn btn-primary" value="Edytuj użytkownika" name="userEdit">
                        </div>
                    </form>
                </section>
            </div>
            <div class="col-md-4">
                <section>
                    <h5>Firmy</h5>
                    <form action="#" method="post">
                        <div class="mb-3">
                            <select size="5" class="form-select" name="companySelect">
                                <?php
                                    $query = "SELECT * FROM company";
                                    $result = $connect->query($query);

                                    if($result->num_rows > 0)
                                    {
                                        while($row = $result->fetch_object())
                                        {
                                            echo "<option>$row->company_name</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-danger me-2" value="Usuń firmę" name="companyDelete">
                            <input type="submit" class="btn btn-primary" value="Edytuj firmę" name="companyEdit">
                        </div>
                    </form>
                </section>
            </div>
            <div class="col-md-4">
                <section>
                    <h5>Oferty</h5>
                    <form action="#" method="post">
                        <div class="mb-3">
                            <select size="5" class="form-select" name="offerSelect">
                                <?php
                                    $query = "SELECT * FROM job_offer";
                                    $result = $connect->query($query);

                                    if($result->num_rows > 0)
                                    {
                                        while($row = $result->fetch_object())
                                        {
                                            echo "<option>$row->offer_name</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-danger me-2" value="Usuń ofertę" name="offerDelete">
                            <input type="submit" class="btn btn-primary" value="Edytuj ofertę" name="offerEdit">
                        </div>
                    </form>
                </section>
            </div>
        </div>

        <?php 
            ////user
            if(isset($_POST['userDelete']) && isset($_POST['userSelect']))
            {
                $value = $_POST['userSelect'];
                $query = "DELETE FROM user WHERE user_login ='$value'";
                $connect->query($query);
                header("Location: PanelAdmina.php");
            }
            if(isset($_POST['userEdit']) && isset($_POST['userSelect']))
            {
                $value = $_POST['userSelect'];
                $query = "SELECT * FROM user WHERE user_login = '$value'";
                $result = $connect->query($query);
                $row = $result->fetch_object();

                echo <<< userForm
                <div class="row mt-5">
                    <div class="col-md-6">
                        <h5>Edytuj informacje o użytkowniku</h5>
                        <form action="PanelAdmina.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="$row->user_id" name="userId">
                            <div class="mb-3">
                                <label for="userLogin" class="form-label">Login</label>
                                <input type="text" class="form-control" id="userLogin" value="$row->user_login" name="userLogin" required>
                            </div>
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Imię</label>
                                <input type="text" class="form-control" id="firstname" value="$row->firstname" name="firstname" required>
                            </div>
                            <div class="mb-3">
                                <label for="surname" class="form-label">Nazwisko</label>
                                <input type="text" class="form-control" id="surname" value="$row->surname" name="surname" required>
                            </div>
                            <div class="mb-3">
                                <label for="dateOfBirth" class="form-label">Data urodzenia</label>
                                <input type="date" class="form-control" id="dateOfBirth" value="$row->date_of_birth" name="dateOfBirth" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="$row->email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="telNumber" class="form-label">Numer telefonu</label>
                                <input type="text" class="form-control" id="telNumber" value="$row->tel_number" name="telNumber" required>
                            </div>
                            <div class="mb-3">
                                <label for="profilePicture" class="form-label">Zdjęcie profilowe</label>
                                <input type="file" class="form-control" id="profilePicture" name="profilePicture" required>
                            </div>
                            <div class="mb-3">
                                <label for="placeOfResidence" class="form-label">Miejsce zamieszkania</label>
                                <input type="text" class="form-control" id="placeOfResidence" value="$row->place_of_residence" name="placeOfResidence" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="updateUser">Zaktualizuj dane</button>
                        </form>
                    </div>
                </div>
                userForm;
            }
            ////company
            if(isset($_POST['companyDelete']) && isset($_POST['companySelect']))
            {
                $value = $_POST['companySelect'];
                $query = "DELETE FROM company WHERE company_name ='$value'";
                $connect->query($query);
                header("Location: PanelAdmina.php");
            }
            if(isset($_POST['companyEdit']) && isset($_POST['companySelect']))
            {
                $value = $_POST['companySelect'];
                $query = "SELECT * FROM company WHERE company_name = '$value'";
                $result = $connect->query($query);
                $row = $result->fetch_object();

                echo <<< companyForm
                <div class="row mt-5">
                    <div class="col-md-6">
                        <h5>Edytuj informacje o firmie</h5>
                        <form action="PanelAdmina.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="$row->company_id" name="companyId">
                            <div class="mb-3">
                                <label for="companyName" class="form-label">Nazwa</label>
                                <input type="text" class="form-control" id="companyName" value="$row->company_name" name="companyName" required>
                            </div>
                            <div class="mb-3">
                                <label for="company_login" class="form-label">Typ</label>
                                <input type="text" class="form-control" id="company_login" value="$row->company_login" name="company_login" required>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">Miasto</label>
                                <input type="text" class="form-control" id="city" value="$row->city" name="city" required>
                            </div>
                            <div class="mb-3">
                                <label for="street" class="form-label">Ulica</label>
                                <input type="text" class="form-control" id="street" value="$row->street" name="street" required>
                            </div>
                            <div class="mb-3">
                                <label for="info" class="form-label">Info</label>
                                <input type="text" class="form-control" id="info" value="$row->info" name="info" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="updateCompany">Zaktualizuj dane</button>
                        </form>
                    </div>
                </div>
                companyForm;
            }
            ////offer
            if(isset($_POST['offerDelete']) && isset($_POST['offerSelect']))
            {
                $value = $_POST['offerSelect'];
                $query = "DELETE FROM job_offer WHERE offer_name ='$value'";
                $connect->query($query);
                header("Location: PanelAdmina.php");
            }
            if(isset($_POST['offerEdit']) && isset($_POST['offerSelect']))
            {
                $value = $_POST['offerSelect'];
                $query = "SELECT * FROM job_offer WHERE offer_name = '$value'";
                $result = $connect->query($query);
                $row = $result->fetch_object();

                echo <<< offerForm
                <div class="row mt-5">
                    <div class="col-md-6">
                        <h5>Edytuj informacje o ofercie</h5>
                        <form action="PanelAdmina.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="$row->offer_id" name="offerId">
                            <div class="mb-3">
                                <label for="offerName" class="form-label">Nazwa</label>
                                <input type="text" class="form-control" id="offerName" value="$row->offer_name" name="offerName" required>
                            </div>
                            <div class="mb-3">
                                <label for="contractType" class="form-label">Typ</label>
                                <input type="text" class="form-control" id="contractType" value="$row->type_of_contract" name="contractType" required>
                            </div>
                            <div class="mb-3">
                                <label for="offerSalary" class="form-label">Wynagrodzenie</label>
                                <input type="text" class="form-control" id="offerSalary" value="$row->salary_range_min." ".$row->salary_range_max" name="offerSalary" required>
                            </div>
                            <div class="mb-3">
                                <label for="responsibilities" class="form-label">Opis</label>
                                <textarea class="form-control" id="responsibilities" name="responsibilities" required>$row->responsibilities</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="requirements" class="form-label">Wymagania</label>
                                <textarea class="form-control" id="requirements" name="requirements" required>$row->requirements</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="updateOffer">Zaktualizuj dane</button>
                        </form>
                    </div>
                </div>
                offerForm;
            }
        ?>
    </div>

    <footer class="footer mt-auto py-3">
        <div class="container">
            <p class="text-center">&copy; 2024 CareerHub. Wszystkie prawa zastrzeżone.</p>
        </div>
    </footer>

    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
