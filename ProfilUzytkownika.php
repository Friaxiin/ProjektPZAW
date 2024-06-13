<?php
@include 'connect.php';
session_start();
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
                <a href="index.php"><img src="logo.png" alt="logo" style="height:100px"></a>
                <a href="index.php" style="font-size: 24px; font-weight:bold">CareerHub</a>
            </header>
            <nav class="col-5">
                <div class="dropdown">
                    <a href="index.php"><i class='bx bx-home-alt-2'></i></a>
                    <i class='bx bx-user-circle userBtn' id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><a href="#"><button class="dropdown-item" type="button">Mój profil</button></li>
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
                                    <a href="PanelAdmina.php"><i class='bx bx-cog'></i></a>
                                <?php
                            }
                        }
                    ?>
                </div>
            </nav>
        </div>
        <main>
            <?php
                if(isset($_SESSION['user_login']))
                {
                    $login = $_SESSION['user_login'];
                    $query = "SELECT * FROM user WHERE user_login = '$login'";
                    $result = $connect->query($query);

                    $row = $result->fetch_object();

                    $src = $row->profile_picture;
                }
                else
                {
                    header("Location: Login.php");
                }
            ?>
            <div class="row">
                <div class="col-4" style="background-color: red; margin: 20px; height:100px">
                    <img src="<?php echo $src;?>" alt="zdjęcie profilowe" style="background-color: blue; margin: 20px">
                </div>

                <div class="col-2" style="backgroung-color: black;">
                </div>

                <div class="col-5">
                <div class="row">
                        <h2>Twoje aplikacje</h2>
                    </div>
                    <div class="row">
                        <?php
                            if(isset($_SESSION['user_id']))
                            {
                                $userId = $_SESSION['user_id'];
                                $query1 = "SELECT * FROM `applications` JOIN job_offer ON (applications.job_offer_id = job_offer.offer_id) WHERE user_id = $userId";
                                $result = $connect->query($query1);

                                while($row = $result->fetch_object())
                                {
                                    echo <<< card
                                        <div class="card col-2" style="height:100%">
                                            <div class="card-body">
                                            <h5 class="card-title">$row->offer_name</h5>
                                            <p class="card-text">$row->job_name</p>
                                            <a href="Oferta.php?id=$row->offer_id" class="card-link">Przejdź do oferty</a>
                                            </div>
                                        </div>
    
                                        <div class="col-2"></div>
                                    card;
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2" style="background-color: yellow; height:200px">
                    <p>Imię:</p>
                    <p>Nazwisko:</p>
                    <p>Data urodzenia:</p>
                    <p>E-mail:</p>
                    <p>Numer telefonu:</p>
                    <p>Miejsce zamieszkania:</p>
                    <p>Obecny zawód:</p>
                    <p>Opis zawodu:</p>
                    <p>Podsumowanie profesji:</p>
                    <p>Znajomość języków:</p>
                    <p>Umiejętności:</p>
                    <p>Certyfikaty:</p>
                    <p>Wykształcenie:</p>
                    <p>Linki:</p>
                </div>
                <div class="col-6">
                    <?php

                    $queryUserInfo = "SELECT * FROM user WHERE user_id = $userId";
                    $result = $connect->query($queryUserInfo);

                    $row = $result->fetch_object();

                    echo <<< info
                        <p>$row->firstname</p>
                        <p>$row->surname</p>
                        <p>$row->date_of_birth</p>
                        <p>$row->email</p>
                        <p>$row->tel_number</p>
                        <p>$row->place_of_residence</p>
                        <p>$row->current_position</p>
                        <p>$row->description_of_position</p>
                        <p>$row->profession_summary</p>
                        <p>$row->knowledge_of_languages</p>
                        <p>$row->skills</p>
                    info;

                    $queryInfo = "SELECT * FROM user JOIN links USING (user_id) JOIN education USING (user_id)  JOIN profession_experience USING (user_id) JOIN courses USING (user_id) WHERE user_login = $login"
                    ?>
                </div>
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