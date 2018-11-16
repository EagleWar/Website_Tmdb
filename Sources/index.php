<?php
session_start();
    $selectedZone = array_key_exists('zone', $_GET) ? $_GET['zone'] : null;
    $selectedItem = array_key_exists('item', $_GET) ? $_GET['item'] : null;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Projet PHP</title>

        <!-- Bootstrap CSS  -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">

        <!-- Inline CSS -->

        <style type="text/css">
            body {
                background-color: #B1B1B1;
            }

            #main-container {
                background-color: #F1F1F1;
                min-height: 550px;
                border-bottom-left-radius: 8px;
                border-bottom-right-radius: 8px;
                padding-top: 60px;
            }

            #page-title {
                margin-top: 0px;
            }
            .col{display: inline-block;margin: 22px;}
            .titre{width: 220px; text-align: center;}
            .cadre{margin: auto;text-align: center;}
            .hide{display: none;}
            .formTop{display: inline-block;}

            /*FORM LEFT*/
            .formLeft{text-align: center; }
            .titreFormLeft{margin-top: 40px;text-align: center;}
            .overview{width: 100%;

                    padding: 12px 20px;
                    box-sizing: border-box;
                    border: 2px solid #ccc;
                    border-radius: 4px;
                    background-color: #f8f8f8;
                    resize: none;}
        </style>
    </head>
    <body>

        <!-- NavBar -->

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php?language=<?php echo $_GET["language"]?>">Projet PHP</a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Movies <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">

                                <li><a href="index.php?zone=movies&item=discoverMovie&language=<?php echo $_GET['language']?>" role="button"> Discover Movies </a></li>

                                 <li><a href="index.php?zone=movies&item=nowPlayingMovie&language=<?php echo $_GET['language']?>" role="button"> Now Playing </a></li>

                                 <li><a href="index.php?zone=movies&item=upcomingMovies&language=<?php echo $_GET['language']?>" role="button"> Upcoming </a></li>

                                 <li><a href="index.php?zone=movies&item=topRatedMovies&language=<?php echo $_GET['language']?>" role="button"> Top Rated</a></li>
                                 <li><a href="index.php?zone=movies&item=popularMovie&language=<?php echo $_GET['language']?>" role="button"> Popular</a></li>
                            </ul>
                            </li>
                         <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> TV Shows <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">

                                <li><a href="index.php?zone=tvShows&item=discoverTV&language=<?php echo $_GET['language']?>" role="button"> Discover TV Shows </a></li>

                                 <li><a href="index.php?zone=tvShows&item=topRatedTV&language=<?php echo $_GET['language']?>" role="button"> Top Rated</a></li>
                                 <li><a href="index.php?zone=tvShows&item=popularTV&language=<?php echo $_GET['language']?>" role="button"> Popular</a></li>
                            </ul>
                        </li>
                        </li>

                         <li>

                            <a class='link' href="forum/forum.php"> Forum</a>
                        </li>

                        <?php if (isset($_SESSION['id'])  && isset($_SESSION['passwd']) ){
                         ?> <li><a class='link' href="forum/user_page.php">  <?php echo $_SESSION['id']; ?></a></li>

                         <?php
                        }
                        else {
                         ?><li><a class='link' href="forum/login.php">Login/Subscribe</a></li> <?php
                        }

                        ?>




                    </ul>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Languages <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">

                           <li> <?php

                            ini_set("display_errors",0);error_reporting(0);

                            if($_GET['item']=='infoMovie' || $_GET['item']=='infoTV')
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item']. '&id=' . $_GET['id'] . '&language=fr" role="button">French </a>';
                            }
                            else if($_GET['item']=='infoSeason')
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item'] .'&id=' . $_GET['id'] . '&season=' . $_GET['season'] . '&language=fr" role="button">French </a>';
                            }
                            else if($_GET['item']=='discoverMovie')
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item']. '&page=' . $_GET['page'] .'&year=' . $_GET['year']. '&genre=' . $_GET['genre'] .'&productor=' . $_GET['productor'] . '&actor=' . $_GET['actor'] . '&language=fr" role="button">French </a>';
                            }

                            else if($_GET['item']=='discoverTV')
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item']. '&page=' . $_GET['page'] .'&year=' . $_GET['year']. '&genre=' . $_GET['genre'] .'&language=fr" role="button">French </a>';
                            }

                            else if($_GET['item']=='popularMovie' || $_GET['item']=='topRatedMovies' || $_GET['item']=='nowPlayingMovie' || $_GET['item']=='upcomingMovies' || $_GET['item']=='upcomingMovies ' || $_GET['item']=='topRatedTV' || $_GET['item']=='popularTV' )
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item']. '&page=' . $_GET['page'] . '&language=fr" role="button">French </a>';
                            }

                            else if($_GET['item']=='person')
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item']. '&id=' . $_GET['id'] . '&language=fr" role="button">French </a>';
                            }

                            else echo '<a href="index.php?&language=fr" role="button">French </a>';

                            ?></li>
                            <li>
                                <?php

                            ini_set("display_errors",0);error_reporting(0);

                            if($_GET['item']=='infoMovie' || $_GET['item']=='infoTV')
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item']. '&id=' . $_GET['id'] . '&language=en" role="button">English </a>';
                            }
                            else if($_GET['item']=='infoSeason')
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item'] .'&id=' . $_GET['id'] . '&season=' . $_GET['season'] . '&language=en" role="button">English </a>';
                            }
                            else if($_GET['item']=='discoverMovie')
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item']. '&page=' . $_GET['page'] .'&year=' . $_GET['year']. '&genre=' . $_GET['genre'] .'&productor=' . $_GET['productor'] . '&actor=' . $_GET['actor'] . '&language=en" role="button">English </a>';
                            }

                            else if($_GET['item']=='discoverTV')
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item']. '&page=' . $_GET['page'] .'&year=' . $_GET['year']. '&genre=' . $_GET['genre'] .'&language=en" role="button">English </a>';
                            }

                            else if($_GET['item']=='popularMovie' ||
                                $_GET['item']=='topRatedMovies' || $_GET['item']=='nowPlayingMovie' || $_GET['item']=='upcomingMovies' || $_GET['item']=='topRatedTV' || $_GET['item']=='popularTV' )
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item']. '&page=' . $_GET['page'] . '&language=en" role="button">English </a>';
                            }

                            else if($_GET['item']=='person')
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item']. '&id=' . $_GET['id'] . '&language=en" role="button">English </a>';
                            }

                            else echo '<a href="index.php?&language=en" role="button">English </a>';

                            ?>
                            </li>

                            <li>
                                  <?php

                            ini_set("display_errors",0);error_reporting(0);

                            if($_GET['item']=='infoMovie' || $_GET['item']=='infoTV')
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item']. '&id=' . $_GET['id'] . '&language=es" role="button">Espagnol </a>';
                            }
                            else if($_GET['item']=='infoSeason')
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item'] .'&id=' . $_GET['id'] . '&season=' . $_GET['season'] . '&language=es" role="button">Espagnol </a>';
                            }
                            else if($_GET['item']=='discoverMovie')
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item']. '&page=' . $_GET['page'] .'&year=' . $_GET['year']. '&genre=' . $_GET['genre'] .'&productor=' . $_GET['productor'] . '&actor=' . $_GET['actor'] . '&language=es" role="button">Espagnol </a>';
                            }

                            else if($_GET['item']=='discoverTV')
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item']. '&page=' . $_GET['page'] .'&year=' . $_GET['year']. '&genre=' . $_GET['genre'] .'&language=es" role="button">Espagnol </a>';
                            }

                            else if($_GET['item']=='popularMovie' ||
                                $_GET['item']=='topRatedMovies' || $_GET['item']=='nowPlayingMovie' || $_GET['item']=='upcomingMovies' || $_GET['item']=='topRatedTV' || $_GET['item']=='popularTV' )
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item']. '&page=' . $_GET['page'] . '&language=es" role="button">Espagnol </a>';
                            }

                            else if($_GET['item']=='person')
                            {
                                echo '<a href="index.php?zone=' . $_GET['zone'] . '&item=' . $_GET['item']. '&id=' . $_GET['id'] . '&language=es" role="button">Espagnol </a>';
                            }

                            else echo '<a href="index.php?&language=es" role="button">Espagnol </a>';

                            ?>
                            </li>

                        </ul>

                    </li>
                </ul>


                <ul class="nav navbar-nav navbar-right">
                        <form class="formTop" method="post" action="index.php?zone=search&item=search&language=<?php echo $_GET['language']; ?>">
                         <input  placeholder="Search..." style="margin-top: 13px;width:200px; background: transparent;border:0; border-bottom: 2px solid black;  " type="text" name="search">
                         <input class="hide" type="submit" name="submit">

                        </form>
                    </ul>


                </div>
            </nav>

            <!-- Container -->

            <div id="main-container" class="container">
                <h3 id="page-title"><?php //echo htmlspecialchars($selectedZone.' '.$selectedItem) ?></h3>

                <?php

                    include("tmdb-api.php");

                    $tmdb = new TMDB();

                    $tmdb->setAPIKey('2528f4bc681bc21d39550a8bdceae653');

                    if(null !== $selectedZone && null !== $selectedItem) {
                        $path = './' . $selectedZone . '/' . $selectedItem . '.php';
                    } else {
                        $path = null;
                    }

                    if(strpos($path,'../') === false && file_exists($path)) {
                        include $path;
                    }
                    else {
                        //echo 'unable to find item ('.$path.')';
                    }
                ?>
            </div>
</div>
        </div>
    </body>
</html>

<!-- Bootstrap JS -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
$( "#accordion" ).accordion({collapsible: true});
} );
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
