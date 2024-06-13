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
</head>
<body>
    <div class="container-fluid height">
        <div class="row height10 nav">
            <header class="col-7 d-flex align-items-center">
                <a href="index.php"><img src="logo.png" alt="logo" style="height:100px"></a>
                <a href="index.php" style="font-size: 24px; font-weight:bold" class="ms-3">CareerHub</a>
            </header>
            <nav class="col-5 d-flex justify-content-end align-items-center">
                <div class="dropdown me-3">
                    <a href="index.php"><i class='bx bx-home-alt-2'></i></a>
                    <i class='bx bx-user-circle userBtn' id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><a href="ProfilUzytkownika.php" class="dropdown-item">Mój profil</a></li>
                        <?php
                            if(isset($_SESSION['account_type']))
                            {
                                echo '<li><a href="logout.php" class="dropdown-item">Wyloguj się</a></li>';
                            }
                            else
                            {
                                echo '<li><a href="Login.php" class="dropdown-item">Zaloguj się</a></li>';
                            }
                        ?>
                    </ul>
                    <a href="Wyszukiwarka.php"><i class='bx bx-search-alt-2'></i></a>
                    <a href="ProfilePracodawcow.php"><i class='bx bx-briefcase-alt-2'></i></a>
                    <?php
                        if(isset($_SESSION['account_type']) && $_SESSION['account_type'] == "admin")
                        {
                            echo '<a href="#"><i class="bx bx-cog"></i></a>';
                        }
                    ?>
                </div>
            </nav>
        </div>

        <main>
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
                                <div class="mb-3">
                                    <label for="accountType" class="form-label">Typ konta</label>
                                    <select id="accountType" class="form-select" name="accountType" required>
                                        <option value="user" ${row->account_type == 'user' ? 'selected' : ''}>User</option>
                                        <option value="admin" ${row->account_type == 'admin' ? 'selected' : ''}>Admin</option>
                                    </select>
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
                                    <label for="companyType" class="form-label">Typ</label>
                                    <input type="text" class="form-control" id="companyType" value="$row->company_type" name="companyType" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Adres</label>
                                    <input type="text" class="form-control" id="address" value="$row->address" name="address" required>
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
                                    <label for="website" class="form-label">Strona internetowa</label>
                                    <input type="url" class="form-control" id="website" value="$row->website" name="website" required>
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
                                    <label for="offerType" class="form-label">Typ</label>
                                    <input type="text" class="form-control" id="offerType" value="$row->offer_type" name="offerType" required>
                                </div>
                                <div class="mb-3">
                                    <label for="offerSalary" class="form-label">Wynagrodzenie</label>
                                    <input type="text" class="form-control" id="offerSalary" value="$row->offer_salary" name="offerSalary" required>
                                </div>
                                <div class="mb-3">
                                    <label for="offerDescription" class="form-label">Opis</label>
                                    <textarea class="form-control" id="offerDescription" name="offerDescription" required>$row->offer_description</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="offerRequirements" class="form-label">Wymagania</label>
                                    <textarea class="form-control" id="offerRequirements" name="offerRequirements" required>$row->offer_requirements</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="updateOffer">Zaktualizuj dane</button>
                            </form>
                        </div>
                    </div>
                    offerForm;
                }
            ?>
        </main>
    </div>

    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>