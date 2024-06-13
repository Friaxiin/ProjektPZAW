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
    <title>Strona główna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
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
                        <?php
                            if(isset($_SESSION['account_type']))
                            {
                                ?>
                                    <li><a href="logout.php"><button class="dropdown-item" type="button">Wyloguj się</button></li>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <li><a href="Login.php"><button class="dropdown-item" type="button">Zaloguj się</button></li>
                                <?php
                            }
                        ?>
                    </ul>

                    <a href="Wyszukiwarka.php"><i class='bx bx-search-alt-2'></i></a>
                    <a href="ProfilePracodawcow.php"><i class='bx bx-briefcase-alt-2'></i></a>

                    <?php
                        if(isset($_SESSION['account_type']))
                        {
                            if($_SESSION['account_type'] == "admin")
                            {
                                ?>                    
                                    <a href="#"><i class='bx bx-cog'></i></a>
                                <?php
                            }
                        }
                    ?>
                </div>
            </nav>
        </div>

        <main>
            <section>
                <p>Użytkownicy</p>
                <form action="#" method="post">
                <select size="5" class="col-4" name="userSelect">
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

                <input type="submit" value="Usuń użytkownika" name="userDelete">
                <input type="submit" value="Edytuj użytkownika" name="userEdit">
                </form>
            </section>

            <section>
                <p>Firmy</p>
                <form action="#" method="post">
                <select size="5" class="col-4" name="companySelect">
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

                <input type="submit" value="Usuń firmę" name="companyDelete">
                <input type="submit" value="Edytuj firmę" name="companyEdit">
                </form>
            </section>

            <section>
                <p>Oferty</p>
                <form action="#" method="post">
                <select size="5" class="col-4" name="offerSelect">
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
                
                <input type="submit" value="Usuń ofertę" name="offerDelete">
                <input type="submit" value="Edytuj ofertę" name="offerEdit">
                </form>
                
            </section>
            
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
                    <div class="row">
                        <div class="col-3">
                            <p>Edytuj informacje o firmie</p>
                            <form action="PanelAdmina.php" method="POST">
                                <input type="number" value="$row->user_id" name="userId" hidden>
                                <p>Login <input type="text" value="$row->user_login" name="userLogin" required></p>
                                <p>Imię <input type="text" value="$row->firstname" name="firstname" required></p>
                                <p>Nazwisko <input type="text" value="$row->surname" name="surname" required></p>
                                <p>Data urodzenia <input type="date" value="$row->date_of_birth" name="dateOfBirth" required></p>
                                <p>Email <input type="text" value="$row->email" name="email" required></p>
                                <p>Numer telefonu <input type="text" value="$row->tel_number" name="telNumber" required></p>
                                <p>Zdjęcie profilowe <input type="file" value="$row->profile_picture" name="profilePicture" required></p>
                                <p>Miejsce zamieszkania <input type="text" value="$row->place_of_residence" name="placeOfResidence" required></p>
                                <p>Obecne stanowisko <input type="text" value="$row->current_position" name="currentPosition" required></p>
                                <p>Opis stanowiska <input type="text" value="$row->description_of_position" name="descriptionOfPosition" required></p>
                                <p>Podsumowanie zawodowe<input type="text" value="$row->profession_summary" name="professionSummary" required></p>
                                <p>Znajomość języków <input type="text" value="$row->knowledge_of_languages" name="knowledgeOfLanguages" required></p>
                                <p>Umiejętności <input type="text" value="$row->skills" name="skills" required></p>
                                <p>Certyfikaty<br>
                                <select size="2" class="col-3">
                    userForm;
                    $userId = $post['userId'];
                    $userQuery = "SELECT * FROM user JOIN courses USING (user_id) WHERE user_id = $userId";
                    $userResult = $connect->query($userQuery);

                    if($userResult->num_rows > 0)
                    {
                        while($row = $userResult->fetch_object())
                        {
                            echo "<option value='$row->course_name'>$row->course_name</option>";
                        }
                    }
                    echo <<< userForm2
                                </select></p>

                                <p>Linki<br>
                                <select size="3" class="col-3">
                    userForm2;
                    $userQuery1 = "SELECT * FROM user JOIN links USING (user_id) WHERE user_id = $userId";
                    $userResult1 = $connect->query($userQuery1);

                    if($userResult1->num_rows > 0)
                    {
                        while($row = $userResult1->fetch_object())
                        {
                            echo "<option value='$row->link'>$row->link</option>";
                        }
                    }
                    echo <<< userForm3
                                </select></p>

                                <p>Wykształcenie<br>
                                <select size="3" class="col-3">
                    userForm3;
                    $userQuery2 = "SELECT * FROM user JOIN education USING (user_id) WHERE user_id = $userId";
                    $userResult2 = $connect->query($userQuery1);

                    if($userResult2->num_rows > 0)
                    {
                        while($row = $userResult2->fetch_object())
                        {
                            echo "<option value='$row->level'>$row->level.' '.$row->school_name</option>";
                        }
                    }    
                    echo <<<userForm4
                                </select>
                                <p><input type="submit" value="Edytuj" name="editBtn"></p>
                            </form>
                        </div>
                    userForm4;


                    echo <<<passwordForm
                        <div class="col-3">
                            <p>Edytuj hasło</p>
                            <form action="PanelAdmina.php" method="POST">
                                <p>Obecne hasło <input type="password" name="oldPassword"></p>
                                <p>Nowe hasło <input type="password" name="newPassword"></p>
                                <p>Powtórz hasło <input type="password" name="repeatNewPassword"></p>
                                <input type="submit" value="Zmień hasło" name="editPasswordBtn">
                            </form>
                        </div>
                    </div>
                    passwordForm;

                    if(isset($_POST['editPaswwordBtn']))
                    {
                        $oldPassword = $_POST['oldPassword'];
                        $newPassword = $_POST['newPassword'];
                        $newPassword2 = $_POST['repeatNewPassword'];

                        if(password_verify($oldPassword, $row->company_password))
                        {
                        if($newPassword == $newPassword2)
                        {
                            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                            $passwordQuery = "UPDATE user SET user_password = $newPasswordHash WHERE user_id = $userId";
                            $connect->query($passwordQuery);
                        }
                        else
                        {
                            echo "Hasła się różnią";
                        }
                        }
                        else
                        {
                        echo "Podano nieprawidłowe hasło";
                        }

                    }
                    if(isset($_POST['editBtn']))
                    {
                        $userId = $_POST['userId'];
                        $userLogin = $_POST['userLogin'];
                        $firstname = $_POST['firstname'];
                        $surname = $_POST['surname'];
                        $dateOfBirth = $_POST['dateOfBirth'];
                        $email = $_POST['email'];
                        $telNumber = $_POST['telNumber'];
                        $profilePicture = $_FILES['profilePicture'];
                        $placeOfResidence = $_POST['placeOfResidence'];
                        $currentPosition = $_POST['currentPosition'];
                        $descriptionOfPosition = $_POST['descriptionOfPosition'];
                        $professionSummary = $_POST['professionSummary'];
                        $knowledgeOfLanguages = $_POST['knowledgeOfLanguages'];
                        $skills = $_POST['skills'];
                        
                        $queryUserEdit = "UPDATE user SET user_login = $userLogin, user_password = $userPassword, firstname = $firstname, surname = $surname, date_of_birth = $dateOfBirth, email = $email, tel_number = $telNumber, profile_picture = '.../userProfilePicture/$profilePicture', place_of_residence = $placeOfResidence, current_position = $currentPosition, description_of_position, = $descriptionOfPosition, profession_summary = $professionSummary, knowledge_of_languages = $knowledgeOfLanguages, skills = $skills";
                        $connect->query($queryUserEdit);
                    }
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
                    <div class="row">
                        <div class="col-3">
                            <p>Edytuj informacje o firmie</p>
                            <form action="PanelAdmina.php" method="POST">
                                <input type="number" value="$row->company_id" name="companyId" hidden>
                                <p>Nazwa <input type="text" value="$row->company_name" name="companyName" required></pre>
                                <p>Login <input type="text" value="$row->company_login" name="companyLogin" required></p>
                                <p>Miasto <input type="text" value="$row->city" name="city" required></p>
                                <p>Ulica <input type="text" value="$row->street" name="street" required></p>
                                <p>Numer budynku <input type="number" value="$row->street_number" name="streetNumber" required></p>
                                <p>Info <input type="text" value="$row->info" name="info" required></p>
                                <p><input type="submit" value="Edytuj" name="editBtn"></p>
                            </form>
                        </div>
                    companyForm;
                    echo <<<passwordForm
                        <div class="col-3">
                            <p>Edytuj hasło</p>
                            <form action="PanelAdmina.php" method="POST">
                                <p>Obence hasło <input type="password" name="oldPassword"></p>
                                <p>Nowe hasło <input type="password" name="newPassword"></p>
                                <p>Powtórz hasło <input type="password" name="repeatNewPassword"></p>
                                <input type="submit" value="Zmień hasło" name="editPasswordBtn">
                            </form>
                        </div>
                    </div>
                    passwordForm;
                    
                }
                if(isset($_POST['editBtn']))
                {
                    $companyId = $_POST['companyId'];
                    $companyName = $_POST['companyName'];
                    $companyLogin = $_POST['companyLogin'];
                    $city = $_POST['city'];
                    $street = $_POST['street'];
                    $streetNumber = $_POST['streetNumber'];
                    $info = $_POST['info'];

                    $queryInfo = "UPDATE company SET company_name = '$companyName', company_login = '$companyLogin', city = '$city', street = '$street', street_number = '$streetNumber', info = '$info' WHERE company_id = $companyId";
                    $connect->query($queryInfo);
                }
                if(isset($_POST['editPaswwordBtn']) && isset($_POST['oldPassword']) && isset($_POST['newPassword']) && isset($_POST['repeatNewPassword']))
                {
                    $oldPassword = $_POST['oldPassword'];
                    $newPassword = $_POST['newPassword'];
                    $newPassword2 = $_POST['repeatNewPassword'];

                    if(password_verify($oldPassword, $row->company_password))
                    {
                        if($newPassword == $newPassword2)
                        {
                            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                            $passwordQuery = "UPDATE company SET company_password = $newPasswordHash";
                            $connect->query($passwordQuery);
                        }
                        else
                        {
                            echo "Hasła się różnią";
                        }
                    }
                    else
                    {
                        echo "Podano nieprawidłowe hasło";
                    }
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
                    $query = "SELECT * FROM job_offer WHERE offer_id = '$value'";
                    $result = $connect->query($query);
                    $row = $result->fetch_object();
                    
                    echo <<< userForm
                    <div class="row">
                        <div class="col-3">
                            <p>Edytuj informacje o ofercie</p>
                            <form action="PanelAdmina.php" method="POST">
                                <input type="number" value="$row->offer_id" name="offerId" hidden>
                                <p>Login <input type="text" value="$row->user_login" name="companyName" required></p>
                                <p>Imię <input type="text" value="$row->firstname" name="city" required></p>
                                <p>Nazwisko <input type="text" value="$row->surname" name="street" required></p>
                                <p>Data urodzenia <input type="date" value="$row->date_of_birth" name="streetNumber" required></p>
                                <p>Email <input type="text" value="$row->email" name="info" required></p>
                                <p>Numer telefonu <input type="text" value="$row->tel_number" name="info" required></p>
                                <p>Zdjęcie profilowe <input type="file" value="$row->profile_picture" name="info" required></p>
                                <p>Miejsce zamieszkania <input type="text" value="$row->place_of_residence" name="info" required></p>
                                <p>Obecne stanowisko <input type="text" value="$row->current_position" name="info" required></p>
                                <p>Opis stanowiska <input type="text" value="$row->description_of_position" name="info" required></p>
                                <p>Podsumowanie zawodowe<input type="text" value="$row->profession_summary" name="info" required></p>
                                <p>Znajomość języków <input type="text" value="$row->knowledge_of_languages" name="info" required></p>
                                <p>Umiejętności <input type="text" value="$row->skills" name="info" required></p>
                                <p>Certyfikaty<br>
                                <select size="2" class="col-3">
                    userForm;
                    $userId = $post['userId'];
                }
            ?>
        </main>

        <?php
            ob_end_flush();
            $connect->close();
        ?>
    </div>

    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>