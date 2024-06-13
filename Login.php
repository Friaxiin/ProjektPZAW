<?php
    session_start();
    ob_start();
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
    <?php
        //error_reporting(0);
        $connect = new mysqli("localhost", "root", "", "4tp_1-projektphp");

        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }
    ?>
    <div class="container-fluid height">
        <div class="row height10 nav">
            <header class="col-7">
                <a href="index.php"><img src="" alt="logo"></a>
                <a href="index.php">Nazwa serwisu</a>
            </header>
            <nav class="col-5">
                <div class="dropdown">
                    <a href="index.php"><i class='bx bx-home-alt-2'></i></a>
                    <i class='bx bx-user-circle userBtn' id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><a href="ProfilUzytkownika.php"><button class="dropdown-item" type="button">Mój profil</button></li>
                        <li><a href="#"><button class="dropdown-item" type="button">Zaloguj się</button></li>
                    </ul>

                    <a href="Wyszukiwarka.php"><i class='bx bx-search-alt-2'></i></a>
                    <a href="ProfilePracodawcow.php"><i class='bx bx-briefcase-alt-2'></i></a>
                
                </div>
            </nav>
        </div>

        <main>
            <div class="row">
                <div class="col-4">
                    <h2>FAQ</h2>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Accordion Item #1
                            </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Acc 1</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Accordion Item #2
                            </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Acc 2</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Accordion Item #3
                            </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Acc 3</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <form action="" method="POST">
                        <input type="text" placeholder="Login" name="login">
                        <input type="password" placeholder="Hasło" name="password" id="password">
                        
                        <input type="submit" value="Zaloguj">
                    </form>
                    <a href="Rejestracja.php"><p>Nie masz konta? Zarejestruj się</p></a>
                </div>
                <?php
                    if($_SERVER["REQUEST_METHOD"] == "POST")
                    {
                        $login = mysqli_real_escape_string($connect, $_POST["login"]);
                        $password = mysqli_real_escape_string($connect, $_POST["password"]);

                        $query = "SELECT * FROM user WHERE user_login = '$login'";
                        $result = $connect->query($query);

                        if(mysqli_num_rows($result) > 0)
                        {
                            $row = $result->fetch_object();

                            if(password_verify($password, $row->user_password))
                            {
                                if($row->account_type == 'admin')
                                {
                                    $_SESSION['admin_login'] = $login;
                                    $_SESSION['account_type'] = 'admin';
                                }
                                if($row->account_type == 'user')
                                {
                                    $_SESSION['user_login'] = $login;
                                    $_SESSION['account_type'] = 'user';
                                }
                                header("Location: index.php");
                            }
                        }
                        else
                        {
                            echo "Niepoprawna nazwa użytkownika lub hasło";
                        }
                    }
                ?>
            </div>
            
        </main>
    
    
        <footer>
            stopka
        </footer>
    </div>

    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>