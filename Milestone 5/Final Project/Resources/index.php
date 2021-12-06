<?php
require_once "../php/db_connect.php";
require_once "../php/functions.php";

session_start();

if(isset($_SESSION['username'])){
    $login_logout = '<a href="../php/logout.php" target="_parent"><button type="button" class="btn btn-primary">Logout</button></ul></li></a>'; 
    $profile_url = '../profile/index.php?id='.$_SESSION['userid'];
}

else
{
    $login_logout = '<a href="../Signup/signin.php" target="_parent"><button type="button" class="btn btn-primary">Login</button></ul></li></a>';
    $profile_url = '../Signup/signin.php';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid Connections - Resources</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Days+One" />
    <link rel="icon" href="img/New Project.png">
</head>
<body>
    <!--Navigation Bar-->
    <div class="holder">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="../index.php"><img src="img/New Project.png" alt="CC Pic" style="width:52px;height:52px;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="<?php echo $profile_url.PHP_EOL;?>">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="../forum/index.php">Forum</a></li>
                        <li class="nav-item disabled"><a class="nav-link" href="#!">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="../gms/games.php">Games</a></li>
                        <li class="nav-item active"><a class="nav-link" href="../Resources/index.php">Resources</a></li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <?php
                            echo $login_logout.PHP_EOL;
                            ?>
                        </li>
                    </ul>                    
                </div>
            </div>
        </nav>
    </div>
    
    <!--Covid Connections "Logo"-->
    <div class="banner">
        <header class="banner bottom-border">
            <img class="bg1 img-fluid" src="img/back_image.jpg" alt="bg image">
            <div class="covid">Resources</div>
        </header>
    </div>

    <div class="py-4 bg-dark">
        <div class="container2">
            <div class="text-center my-5">
                <h1 class="resources" style="font-size: 58px; text-transform: uppercase;">COVID-19 Resources</h1>
                <p class="desc mb-0">In these times of struggle, it can be hard to get the assistance and information you need to help you and your family persevere during the COVID-19 pandemic. This <strong>RESOURCES</strong> page is here to help you navigate the services that are available to you in your time of need.</strong></p>
            </div>
        </div>
    </div>

    <div class="py-4 bg-dark bottom-border">
        <div class="links">
            <section class="cdc">
                <a href="https://www.cdc.gov/" target="_blank" rel="noopener noreferrer">
                <img class="mx-auto d-block" src="img/CDC.png" alt="CDC">    
                </a>
                <h1>CDC</h1>
                <p>Looking for official information regarding the SARS-CoV-2 pandemic? visit the offical CDC Website for all the latest news.</p>
            </section>
            <table>        
                <tr>
                    <td class="left">
                        <a href="http://www.ushospitalfinder.com/hospitals-in/Florida" target="_blank" rel="noopener noreferrer">
                            <img src="img/Hospital.jpg" alt="Hospital">
                        </a>
                        <h1>Nearest Hospitals</h1>
                        <p>Are you in need of medical assistance? Experiencing symptoms of COVID-19? Search for the hospitals that are nearest to your current location.</p>
                    </td>
                    <td class="center">
                        <a href="https://www.google.com/search?sa=X&rlz=1C1CHBF_enUS768US769&biw=1536&bih=696&q=nearest+vaccination+center&ved=2ahUKEwi0lN2SrK30AhV8mWoFHeNiCZgQuzEoAHoECAEQAw" target="_blank" rel="noopener noreferrer">
                            <img src="img/Vaccine.jpg" alt="Vaccine">
                        </a>
                        <h2 style="text-align: center; text-transform: uppercase;">Nearest Vaccination Sites</h2>
                        <p>Are you looking to be inoculated against COVID-19? Here's a list of the vaccination sites that are nearest to you.</p>
                    </td>
                    <td class="right">
                        <a href="https://www.google.com/search?rlz=1C1CHBF_enUS768US769&biw=1536&bih=696&q=nearest+covid+testing+site&sa=X&ved=2ahUKEwjgktijra30AhXHRTABHZGTDPoQuzEoAHoECAEQAw" target="_blank" rel="noopener noreferrer">
                            <img src="img/Test.jpg" alt="Testing">
                        </a>
                        <h1>COVID-19 Testing Sites</h1>
                        <p>Exhibiting symptoms of COVID-19? Or have you been in contact with someone who has symptoms/tested positive for the virus? Find the testing sites nearest to you.</p>
                    </td>
                </tr>
            </table>
            <section class="final2">
                <div class="last2">
                    <a href="https://www.usa.gov/food-help" target="_blank" rel="noopener noreferrer">
                        <img src="img/Food.jpg" alt="Food" width="300" height="200">
                    </a>
                    <h1>Food Assistance</h1>
                    <p>In need of assistance in feeding yourself and your family? Here are some government programs that can help feed your family during this time of uncertainty.</p>
                </div>
                <div class="last2">
                    <a href="https://www.floridajobs.org/Reemployment-Assistance-Service-Center/reemployment-assistance/claimants/apply-for-benefits" target="_blank" rel="noopener noreferrer">
                        <img src="img/Employ.jpg" alt="Employ" width="300" height="200">
                    </a>
                    <h1>Unemployement Benefits</h1>
                    <p>For those struggling after a loss of employment, you can find information from the unemployment offices in Florida and how to apply for benefits.</p>
                </div>
            </section>    
        </div>
    </div>
</body>
</html>
