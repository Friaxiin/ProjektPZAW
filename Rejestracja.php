<?php
session_start();
@include "connect.php";
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
                    <form action="" method="post">
                        <input type="text" placeholder="Login" name="login">
                        <input type="password" placeholder="Hasło" name="password">
                        <p>Dane osobowe</p>
                        <input type="text" placeholder="Imię" name="firstName">
                        <input type="text" placeholder="Nazwisko" name="surname">
                        <input type="text" placeholder="Data urodzenia" onfocus="(this.type='date')" onblur="(this.type='text')" name="dateOfBirth">
                        <input type="" placeholder="Email" name="email">
                        <input type="" placeholder="Numer telefonu" name="telNumber">
                        <input type="" placeholder="Miejsce zamieszkania" name="placeOfResidence">
                        
                        <input type="submit" name="rejestruj" value="Zarejestruj">
                    </form>
                </div>

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

                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                        $duplicate = mysqli_query($connect, "SELECT * FROM user WHERE email = '$email' AND user_login = '$login'");

                        if(mysqli_num_rows($duplicate) > 0)
                        {
                            echo "Podany e-mail lub nazwa użytkownika jest już w użyciu";
                        }
                        else
                        {
                            if(!empty($login) || !empty($password) || !empty($firstName) || !empty($surname) || !empty($dateOfBirth) || !empty($email) || !empty($telNumber) || !empty($placeOfResidence))
                            {
                                $defaultImg = "../userProfileImages/default.jpg";
                                
                                $query = "INSERT INTO user (user_login, user_password, firstname, surname, date_of_birth, email, tel_number, profile_picture, place_of_residence, current_position, description_of_position, profession_summary, knowledge_of_languages, skills, courses_certificates, links, account_type) 
                                                    VALUES ('$login', '$passwordHash', '$firstName', '$surname', '$dateOfBirth', '$email', '$telNumber', '$defaultImg', '$placeOfResidence', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user')";

                                $connect->query($query);
                                //echo $query;

                                //$row = mysqli_fetch_array($q);
                                //print_r($row);
                                //echo "Rejestracja udana";
                                header("Location: Login.php");
                            }
                        }

                    }
                ?>
            </div>
            
        </main>
    
    
        <footer>
            stopka
        </footer>
        <?php
            ob_end_flush();
            $connect->close();
        ?>
    </div>

    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>