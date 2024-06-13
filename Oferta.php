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
    <?php
        /*
        $getdata = http_build_query(
            array(
               'latitude' => $row->latitude,
               'longitude'=> $row->longtitude,
            )
            );
            $result=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.$getdata['latitude'].','.$getdata['longitude'].'&sensor=false')
        */
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
                $query = "SELECT * FROM job_offer JOIN category USING (category_id) JOIN company USING (company_id) WHERE offer_id = '{$_GET['id']}'";
                $result = $connect->query($query);

                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_object())
                    {
                        echo <<< opis
                            <div class="row">
                                <div class="col-3">
                                    <p>Tytuł</p>
                                    <p>Firma</p>
                                    <p>Zawód</p>
                                    <p>Poziom</p>
                                    <p>Typ kontraktu</p>
                                    <p>Wymiar zatrudnienia</p>
                                    <p>Typ pracy</p>
                                    <p>Wynagrodzenie</p>
                                    <p>Dni pracy</p>
                                    <p>Godziny pracy</p>
                                    <p>Wygaśnięcie ogłoszenia</p>
                                    <p>Kategoria</p>
                                    <p>Obowiązki</p>
                                    <p>Wymagania</p>
                                    <p>Benefity</p>
                                </div>
                                <div class="col-4">
                                    <p>$row->offer_name</p>
                                    <p>$row->company_name</p>
                                    <p>$row->job_name</p>
                                    <p>$row->job_level</p>
                                    <p>$row->type_of_contract</p>
                                    <p>$row->employment_dimension</p>
                                    <p>$row->type_of_work</p>
                                    <p>$row->salary_range_min zł - $row->salary_range_max zł</p>
                                    <p>$row->days_of_work</p>
                                    <p>$row->work_hours_min - $row->work_hours_max</p>
                                    <p>$row->end_of_recrutation</p>
                                    <p>$row->category_name</p>
                                    <p>$row->responsibilities</p>
                                    <p>$row->requirements</p>
                                    <p>$row->benefits</p>
                                </div>
                                <div class="col-4">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2434.2907640568674!2d16.915563717484464!3d52.40140631068507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47045b30521deb93%3A0xfe133a1f0df4613e!2zUGFya2luZyBQb3puYcWEIEfFgsOzd255!5e0!3m2!1spl!2spl!4v1710795224912!5m2!1spl!2spl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                            <div class="row">
                                <form action="Oferta.php" method="post">
                                    <input type="submit" value="Aplikuj" name="apply">
                                </form>
                            </div>
                        opis;

                        if(isset($_POST['apply']))
                        {
                            $userId = $_SESSION['user_id'];
                            $date = date('Y-m-d');
                            $offerId = $_GET['id'];
                            $applyQuery = "INSERT INTO applications (user_id, job_offer_id, application_date) VALUES ($userId, $offerId, $date)";
                            $connect->query($applyQuery);
                            echo $applyQuery;
                        }
                    }
                }
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