<?php

    echo '  <div class="panel panel-default">
                    <div class="panel-body">
                        <ul>';

	if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $id = test_input($_GET['id']);
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

	$movie = $tmdb->getMovie($id,null, $_GET['language']);

  $backdrop = 'https://image.tmdb.org/t/p/original' . $movie->get('backdrop_path');


    //print_r($movie);

	$title = $movie->getTitle();
    echo '<h1 style="text-align: center;">' . $title . '</h1>';
    echo "</br>";

    $poster =  'https://image.tmdb.org/t/p/original' . $movie->getPoster();
    echo '<center> <img src="', $poster, '"style="width360:px;height:400px;"> </center>';
    echo "</br></br>";

    $cast = $movie->getCrew();
    foreach ($cast as $i => $person) 
    {
        if($i==0) echo "<u><center> Director</u> : ", $person->getName(), "</center>" . PHP_EOL;
    }

    $cast = $movie->getCast();
    echo "<u><center> Actors</u> : ";
    foreach ($cast as $i => $person) 
    {
        if($i==0 || $i==1) echo $person->getName() . ", ";
        if($i==2) echo $person->getName();
    }
    echo "</center>";

    echo "<u><center> Genres</u> : ";
    $genres = $movie->getGenres();
    foreach ($genres as $i => $type) 
    {
        if($i == 0) echo $type->getName();
        else echo ', ' . $type->getName();
    }

    $year = $movie->getYear();
    echo "<u><center> Release Date</u> : ", $year . "</center>", PHP_EOL;

   
    echo "<u><center> Companies</u> : ";
    $companies = $movie->getCompanies();
    foreach ($companies as $i => $name) 
    {
        if($i==0 || $i==1) echo $name->getName() . ", ";
        if($i==2) echo $name->getName();
    }

    $vote_avg = $movie->getVoteAverage();
    echo "<u><center> Vote Average</u> : ", $vote_avg . "</center>", PHP_EOL;

    $vote_count = $movie->getVoteCount();
    echo "<u><center> Vote Count</u> : ", $vote_count . "</center>", PHP_EOL;
    echo "</br></br>";

    $synopsy = $movie->get('overview');
    echo '<center>' . $synopsy . '</center>';

    echo "</br></br>";

    $trailer = $movie->getTrailer();
    echo ' <iframe width="420" height="315" allowfullscreen="allowfullscreen" 
                src="https://www.youtube.com/embed/' . $trailer . '?autoplay=0">
           </iframe>';

   ?>


