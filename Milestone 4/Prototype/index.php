<?php
session_start();
if(isset($_SESSION['username'])){    
    $login_logout = '<a href="php/logout.php" target="_parent"><button type="button" class="btn btn-primary">Logout</button></ul></li></a>';
}

else
{
    $login_logout = '<a href="Signup/signin.php" target="_parent"><button type="button" class="btn btn-primary">Login</button></ul></li></a>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Front Page</title>
    <link rel="stylesheet" href="css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Days+One" />
</head>
<body>
    <!--Navigation Bar-->
    <div class="holder">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#!"><img src="images/New Project.png" alt="CC Pic" style="width:52px;height:52px;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="forum/index.php">Forum</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Games</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Resources</a></li>
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
            <img class="bg1 img-fluid" src="images/back_image.jpg" alt="bg image">
            <div class="covid">Covid Connections</div>
        </header>
    </div>
    
    <!--Welcome to Covid Connections-->
    <div class="py-4 bg-dark">
        <div class="container2">
            <div class="text-center my-5">
                <h1 class="welcome" style="font-size: 58px; text-transform: uppercase;">Welcome to Covid Connections!</h1>
                <p class="desc mb-0">The advent of SARS-CoV-2 is a true testament to the unprecedented times we are living in. While many difficulties have arisen along with the pandemic, it has helped us all to realize the more important things in life. Among these things, is the connections that we develop amongst each other. That is why the overall goal of building Covid Connections is to create a platform for Floridians to communicate, learn, relax, and – most importantly – connect with others so we can collectively assist one another in enduring through these times, and putting these sorrowful days behind us once and for all.</p>
            </div>
        </div>
    </div>

    <!--Features-->
    <div class="py-4 bg-dark bottom-border">
        <div class="features">
            <h1>Features:</h1>
            <section class="featpics">
                <table>
                    <tr>
                        <td>
                            <a href="forum/index.php">
                            <img src="images/Forum.jpg" alt="forum">
                            </a>
                            Forum
                        </td>
                        <td>
                            <a href="#">
                                <img src="images/Gallery.jpg" alt="gallery">
                            </a>
                            Gallery
                        </td>
                        <td>
                            <a href="#">
                                <img src="images/Games.jpg" alt="games">
                            </a>
                            Games
                        </td>
                        <td>
                            <a href="#">
                                <img src="images/Resources.jpg" alt="resources">
                            </a>
                            Resources
                        </td>
                    </tr>
                </table>
            </section>
        </div>
        
    </div>

    <!--Sign Up-->
    <div class="py-4 bg-dark bottom-border">
        <div class="sign_up">
            <h1>Sign Up with us!</h1>
            <div class="form-container">
                <form action="">
                    <p class="sinput">
                        <div class="forms">
                            <label for="email">Enter your email address:</label>
                            <input type="email" name="email" id="email" placeholder="Enter valid e-mail">

                            <label for="password">Enter your password:</label>
                            <input type="password" name="password" id="password" placeholder="Enter Password">
                        </div>
                        <input class="button" type="button" value="Create Account">
                    </p>
                </form>
            </div>
        </div>
    </div>

    
</body>
</html>
