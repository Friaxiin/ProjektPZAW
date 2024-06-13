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
                <a href="index.php"><img src="" alt="logo"></a>
                <a href="index.php">Nazwa serwisu</a>
            </header>
            <nav class="col-5">
                <div class="dropdown">
                    <a href="index.php"><i class='bx bx-home-alt-2'></i></a>
                    <i class='bx bx-user-circle userBtn' id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><a href="ProfilUzytkownika.php"><button class="dropdown-item" type="button">Mój profil</button></li>
                        <li><a href="Login.php"><button class="dropdown-item" type="button">Zaloguj się</button></li>
                    </ul>

                    <a href="#"><i class='bx bx-search-alt-2'></i></a>
                    <a href="ProfilePracodawcow.php"><i class='bx bx-briefcase-alt-2'></i></a>
                
                </div>
            </nav>
        </div>
        <main class="container">
            <div class="row">
                <form action="" method="post">
                    <div class="col text-center">
                        <input type="text" name="searchedText" class="form-control" placeholder="Search" aria-label="search" aria-describedby="basic-addon1">
                    </div>
                
                    <div class="row">
                        <div class="col text-center">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false " aria-controls="collapseOne">
                                        Firma
                                    </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <select class="form-select" name="companySelect" aria-label="Default select example">
                                            <option value="" select>Default value</option>
                                            <?php
                                                $query = "SELECT company_id, company_name FROM `company`";
                                                $result = $connect->query($query);

                                                while ($row = $result->fetch_object()){
                                                    echo "<option value='$row->company_id'>$row->company_name</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Stanowisko
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <select class="form-select" name="jobName" aria-label="Default select example">
                                                <option value="" select>Default value</option>
                                                <?php
                                                    $query = "SELECT job_name FROM `job_offer`";
                                                    $result = $connect->query($query);

                                                    while ($row = $result->fetch_object()){
                                                        echo "<option value='$row->job_name'>$row->job_name</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Typ umowy
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <select class="form-select" name="typeOfContract" aria-label="Default select example">
                                                <option value="" select>Default value</option>
                                                <?php
                                                    $query = "SELECT type_of_contract FROM `job_offer`";
                                                    $result = $connect->query($query);

                                                    while ($row = $result->fetch_object()){
                                                        echo "<option value='$row->type_of_contract'>$row->type_of_contract</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Kategoria
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <select class="form-select" name="category" aria-label="Default select example">
                                                <option value="" select>Default value</option>
                                                <?php
                                                    $query = "SELECT * FROM `category`";
                                                    $result = $connect->query($query);

                                                    while ($row = $result->fetch_object()){
                                                        echo "<option value='$row->category_id'>$row->category_name</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            Poziom stanowiska
                                        </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <select class="form-select" name="jobLevel" aria-label="Default select example">
                                                <option value="" select>Default value</option>
                                                <?php
                                                    $query = "SELECT job_level FROM `job_offer`";
                                                    $result = $connect->query($query);

                                                    while ($row = $result->fetch_object()){
                                                        echo "<option value='$row->job_level'>$row->job_level</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            Tryb pracy
                                        </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <select class="form-select" name="typeOfWork" aria-label="Default select example">
                                                <option value="" select>Default value</option>
                                                <?php
                                                    $query = "SELECT type_of_work FROM `job_offer`";
                                                    $result = $connect->query($query);

                                                    while ($row = $result->fetch_object()){
                                                        echo "<option value='$row->type_of_work'>$row->type_of_work</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                            Wymiar etatu
                                        </button>
                                    </h2>
                                    <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <select class="form-select" name="employmentDimension" aria-label="Default select example">
                                                <option value="" select>Default value</option>
                                                <?php
                                                    $query = "SELECT employment_dimension FROM `job_offer`";
                                                    $result = $connect->query($query);

                                                    while ($row = $result->fetch_object()){
                                                        echo "<option value='$row->employment_dimension'>$row->employment_dimension</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="btn btn-dark btn-lg btn-block">
                            <input type="submit" name="submit" value="Szukaj" class="btn btn-dark">
                        </div>
                    </div>
                </form>

                <?php

                ?>

            </div>
            <div class="row">
                <div class="col-8">
                    <?php 

                        if(isset($_POST['submit'])){
                            
                            $query = "SELECT *, category.category_name, company.company_name FROM `job_offer` 
                            JOIN category USING(category_id) 
                            JOIN company USING(company_id) 
                            WHERE 1";

                            if(!empty($_POST['searchedText'])){
                                $searchText = $_POST['searchedText'];
                                $query .= " AND offer_name LIKE '%$searchText%' OR offer_name LIKE '%$searchText' OR offer_name LIKE '$searchText%'";
                            }

                            if(!empty($_POST['companySelect'])){
                                $companyId = $_POST['companySelect'];
                                $query .= " AND company_id = '$companyId'";
                            }

                            if(!empty($_POST['jobName'])){
                                $jobName = $_POST['jobName'];
                                $query .= " AND job_name = '$jobName'";
                            }

                            if(!empty($_POST['typeOfContract'])){
                                $typeOfContract = $_POST['typeOfContract'];
                                $query .= " AND type_of_contract = '$typeOfContract'";
                            }

                            
                            if(!empty($_POST['category'])){
                                $category = $_POST['category'];
                                $query .= " AND category_id = '$category'";
                            }

                            if(!empty($_POST['jobLevel'])){
                                $jobLevel = $_POST['jobLevel'];
                                $query .= " AND job_level = '$jobLevel'";
                            }

                            if(!empty($_POST['typeOfWork'])){
                                $typeOfWork = $_POST['typeOfWork'];
                                $query .= " AND type_of_work = '$typeOfWork'";
                            }

                            if(!empty($_POST['employmentDimension'])){
                                $employmentDimension = $_POST['employmentDimension'];
                                $query .= " AND job_level = '$employmentDimension'";
                            }

                            //echo $query;
                
                            $result = $connect->query($query);  

                            if($result->num_rows > 0){
                                while($row=$result->fetch_object()){
                                    echo <<< data
                                        <div class="jumbotron">
                                            <h1 class="display-4">$row->offer_name</h1>
                                            <p class="lead">$row->responsibilities</p>
                                            <hr class="my-4">
                                            <p>$row->work_hours_min do $row->work_hours_max</p>
                                            <p class="lead">
                                                <a class="btn btn-primary btn-lg" href="Oferta.php?" role="button">Odwiedz strone ogłoszenia</a>
                                            </p>
                                        </div>
                                    data;
                                }
                            }
                        }
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