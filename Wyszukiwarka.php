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

                    <a href="#"><i class='bx bx-search-alt-2'></i></a>
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
            <div class="row">
                    <div class="col-1">

                    </div>
                    <div class="col-10">
                        <input type="text" placeholder="tytuł" class="col-2">
                        <input type="text" placeholder="firma" class="col-2">
                        <input type="text" placeholder="kategoria" class="col-2">
                        <input type="submit" value="Szukaj" class="col-2">
                    </div>
                    <div class="col-1">

                    </div>
                    
            </div>
            <div class="row">
                    <div class="col-2">

                    </div>
                    <div class="col-8" style="background-color: red; height: 300px; margin-top: 20px">
                        Zawartość wyszukana
                    </div>
                    <div class="col-2">

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