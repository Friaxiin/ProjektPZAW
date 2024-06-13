<?php
    session_start();

    @include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
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
        <main>
            <form action="ProfilePracodawcowRejestracja.php" method="post">
                <input type="text" placeholder="Login firmy" name="cLogin" required><br>
                <span style="color:blue;font-size:12px;">Dana wymagana podczas logowania do profilu firmy</span><br>
                <input type="text" placeholder="Nazwa firmy" name="cName" required><br>
                <input type="password" placeholder="Hasło" name="cPass" required><br>
                <input type="password" placeholder="Powtorz haslo" name="cPassRepeat" required><br>

                <input type="submit" value="Zarejestruj" name="submit">
            </form>
            <p>Jeśli posiadasz już konto firmowe: <a href="ProfilePracodawcow.php">klinkij tutaj</a></p>

            <?php

                $cLogin = $_POST['cLogin'];
                $cName = $_POST['cName'];
                $cPass = $_POST['cPass'];
                $cPassRepeat = $_POST['cPassRepeat'];

                $query = "SELECT * FROM company WHERE company_login = '$cLogin' AND company_name = '$cName'";
                $result = $connect->query($query);

                if(isset($_POST['submit'])){
                    if($result->num_rows > 0){
                        echo <<< alert
                            <div class="container">
                                <div class="alert alert-danger" role="alert">
                                    Taka firma już istnieje!
                                </div>
                            </div>
                        alert;
                    } else {
                        if($cPass != $cPassRepeat){
                            echo <<< alert
                                <div class="container">
                                    <div class="alert alert-danger" role="alert">
                                        Hasła się nie pokrywają!
                                    </div>
                                </div>
                            alert;
                        } else {
                            $cPassHash = password_hash($cPass, PASSWORD_DEFAULT);

                            $query = "INSERT INTO `company` (company_name, company_login, company_password) 
                            VALUES ('$cName', '$cLogin', '$cPassHash')";

                            $connect->query($query);

                            header("Location: ProfilePracodawcow.php");
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