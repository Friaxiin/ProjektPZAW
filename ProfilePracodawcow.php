<?php
    session_start();
    @include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-fluid height">
        <div class="row height10 nav">
            <header class="col-7">
                <a href="index.php"><img src="logo.png" alt="logo" style="height:100px"></a>
                <a href="index.php" style="font-size: 24px; font-weight:bold">CareerHub</a>
            </header>
            <nav class="col-5">
                <div class="dropdown">
                    <a href="index.php"><i class='bx bx-home-alt-2'></i></a>
                    <i class='bx bx-user-circle userBtn' id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><a href="ProfilUzytkownika.php"><button class="dropdown-item" type="button">Mój profil</button></li>
                        <li><a href="Login.php"><button class="dropdown-item" type="button">Zaloguj się</button></li>
                    </ul>

                    <a href="Wyszukiwarka.php"><i class='bx bx-search-alt-2'></i></a>
                    <a href="#"><i class='bx bx-briefcase-alt-2'></i></a>
                
                </div>
            </nav>
        </div>
        <main class="container-fluid">
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
                        
                <div class="row">
                    <div class="col">
                        <h1><?php echo $cData['company_name']; ?></h1>
                    </div>
                </div>
                        
                <div class="row">
                    <div class="col">
                        <p>Login twojej firmy: <strong><?php echo $cData['company_login']; ?></strong></p>   
                    </div>
                        
                    <div class="col">
                        <p>Miasto: <strong><?php echo $cData['city']; ?></strong></p>
                        <p>Ulica: <strong><?php echo $cData['street']; ?></strong></p>
                        <p>Numer ulicy: <strong><?php echo $cData['street_number']; ?></strong></p>
                    </div>
                        
                    <div class="col">
                        <p>Longitude: <strong><?php echo $cData['longtitude']; ?></strong></p>
                        <p>Latitude: <strong><?php echo $cData['latitude']; ?></strong></p>
                        <p>Info: <strong><?php echo $cData['info']; ?></strong></p>
                    </div>
                    </div>
                        <div class="row">
                            <div class="col">
                                <form action="#" method="post">
                                    <input type="submit" value="Wylogoj z profilu firmy" name="submitLogoutFromCompanyProf">
                                    <input type="submit" value="Edytuj firme" name="subminEditCompany">
                                </form>

                                <?php
                                    if(isset($_POST['submitLogoutFromCompanyProf'])){
                                        unset($_SESSION['cId']);
                                        header("Location: " . $_SERVER['PHP_SELF']);
                                        exit();
                                    } else if(isset($_POST['subminEditCompany'])){
                                        $query = "SELECT * FROM `company` WHERE company_id = '$cId'";
                                        $result = $connect->query($query);
                                        $row = $result->fetch_object();

                                        $cId = $_SESSION['cId'];

                                        echo <<< editForm
                                            <form action="ProfilePracodawcow.php" method="post">
                                                <p>
                                                    Nazwa firmy: <input type="text" name="companyName" value="$row->company_name">
                                                </p>
                                                <p>
                                                    Login: <input type="text" name="companyLogin" value="$row->company_login">
                                                </p>
                                                <p>
                                                    Hasło:
                                                    <input type="password" name="companyPass"><br>
                                                    <span style="font-size: 10px;">Podaj nowe hasło (jeżeli nie zmieniasz zostaw puste)</span>
                                                </p>
                                                
                                                <p>
                                                    Miasto: <input type="text" name="city" value="$row->city">
                                                </p>
                                                <p>
                                                    Ulica: <input type="text" name="street" value="$row->street">
                                                <p>
                                                    Numer ulicy: <input type="number" name="streetNumber" value="$row->street_number">
                                                </p>
                                                <p> 
                                                    Wysokość geograficzna: <input type="number" name="longtitude" value="$row->longtitude">
                                                </p>
                                                <p>
                                                    Szerokość geograficzna: <input type="number" name="latitude" value="$row->latitude">
                                                </p>
                                                <p>
                                                    Opis: <textarea name="descrip" cols="22"></textarea>
                                                </p>
                                                <input type="submit" value="Edytuj" name="submitEditData">
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
                                            $desct = $_POST['descrip'] ? $_POST['descrip'] : null;

                                            $companyPass = ""; 
                                            if(!empty($_POST['companyPass'])){
                                                $companyPass = $_POST['companyPass'];
                                                $companyPass = password_hash($companyPass, PASSWORD_DEFAULT);
                                            } else {
                                                $companyPass = $row->company_password;
                                            }
                                            //UPDATE `company` SET `company_name` = 'Apple1' WHERE `company`.`company_id` = 4;
                                            $query = "UPDATE company SET company_name = '$companyName',
                                                        company_login = '$companyLogin', 
                                                        company_password = '$companyPass',
                                                        city = '$city',
                                                        street = '$street',
                                                        street_number = '$streetNumber',
                                                        longtitude = '$longtitude',
                                                        latitude = '$latitude',
                                                        info = '$desct' 
                                                        WHERE company.company_id = '$cId'";

                                            echo $query;
                                            echo $connect->query($query);

                                            if ($connect->query($query)) {
                                                echo "Update successful";
                                                header("Location: " . $_SERVER['PHP_SELF']);
                                                exit();
                                            } else {
                                                echo "Update failed: " . $connect->error;
                                            }
                                        }
                                    }
                                ?>
                            </div>
                        </div>      
                <?php
                } else {
                    echo '<p>No data found for the specified company.</p>';
                }
                ?>
                    </div>
                <?php
                } else {
                    ?>
                        <form action="ProfilePracodawcow.php" method="post">
                            <input type="text" placeholder="Login firmy" name="cLogin" required>
                            <input type="password" placeholder="Hasło" name="cPass" required>

                            <input type="submit" value="Zalogoj" name="submit">
                        </form>
                        <p>Nie posiadasz konta firmowego? <a href="ProfilePracodawcowRejestracja.php">Klinkij tutaj</a></p>
                    <?php
                }
            ?>

            <?php
                if(isset($_POST['submit'])){
                    $cLogin = $_POST['cLogin'];
                    $cPass = $_POST['cPass'];
    
                    $query = "SELECT * FROM company WHERE company_login = '$cLogin'";
                    $result = $connect->query($query);
    
                    
                    if($result->num_rows <= 0){
                        echo <<< alert
                            <div class="container">
                                <div class="alert alert-danger" role="alert">
                                    Proszę przejść do rejestracji firmy klikając <a href="ProfilePracodawcowRejestracja.php" class="alert-link">tutaj</a>.
                                </div>
                            </div>
                        alert;
                    } else {
                        $row = $result->fetch_object();
                        if(!password_verify($cPass, $row->company_password)){
                            echo <<< alert
                                <div class="container">
                                    <div class="alert alert-danger" role="alert">
                                        Niepoprawne haslo
                                    </div>
                                </div>
                            alert;
                            
                        } else {
                            $_SESSION['cId'] = $row->company_id;
                            header("Location: " . $_SERVER['PHP_SELF']);
                            exit();
                        }

                    }
                }
                $connect->close();
            ?>
        </main>

        <footer>
            stopka
        </footer>
    </div>

    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>