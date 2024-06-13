<?php
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        //error_reporting(0);

    ?>
    <div class="container-fluid height">
        <div class="row height10 nav">
            <header class="col-7">
                <a href="index.php"><img src="" alt="logo"></a>
                <a href="index.php">Nazwa serwisu</a>
            </header>
            <nav class="col-5">
                <div class="dropdown">
                    <a href="#"><i class='bx bx-home-alt-2'></i></a>
                    <i class='bx bx-user-circle userBtn' id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><a href="ProfilUzytkownika.php"><button class="dropdown-item" type="button">Mój profil</button></li>
                        <li><a href="Login.php"><button class="dropdown-item" type="button">Zaloguj się</button></li>
                    </ul>

                    <a href="Wyszukiwarka.php"><i class='bx bx-search-alt-2'></i></a>
                    <a href="ProfilePracodawcow.php"><i class='bx bx-briefcase-alt-2'></i></a>
                
                </div>
            </nav>
        </div>
        
        <div class="row">
            <main>
            <section class="" style="padding:15px">
                    <div class="row">
                        <h2>Najnowsze oferty</h2>
                    </div>
                    <div class="row">
                        <?php
                            $query = "SELECT * FROM job_offer ORDER BY end_of_recrutation DESC LIMIT 3";
                            $result = $connect->query($query);

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
                        ?>
                    </div>
                </section>

                <section class="" style="padding:15px">
                    <div class="row">
                        <h2>Polecane</h2>
                    </div>
                    <div class="row">
                        <?php
                            $query = "SELECT * FROM job_offer LIMIT 3";
                            $result = $connect->query($query);

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
                        ?>
                    </div>
                </section>

                <section>
                    <div class="row">
                        <h2>Ostatnio aplikowane</h2>
                    </div>
                    <div class="row">
                        <?php
                            echo $_SESSION['user_id'];
                            if(isset($_SESSION['user_id']))
                            {
                                $userId = $_SESSION['user_id'];
                                $query = "SELECT * FROM `applications` JOIN job_offer ON (applications.job_offer_id = job_offer.offer_id)  WHERE user_id = $userId ORDER BY application_date DESC LIMIT 3";
                                echo $query;
                                $result = $connect->query($query);
    
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
                           // }
                        ?>
                    </div>
                </section>
            </main>
        </div>
            
        <div class="row footer">
            <footer>
                <div class="col-8">

                </div>
                <div class="col-4">
                    <p>Kontakt:</p>
                    <p>E-mail: email@gmail.com<br>
                    Tel: 123123123</p>
                </div>
            </footer>
        </div>
    </div>

    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>