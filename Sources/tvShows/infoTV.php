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

	$movie = $tmdb->getTVShow($id,null, $_GET['language']);


    //print_r($movie);

	$title = $movie->getName();
    echo '<h1 style="text-align: center;">' . $title . '</h1>';
    echo "</br>";

    $poster =  'https://image.tmdb.org/t/p/original' . $movie->getPoster();
    echo '<center> <img src="', $poster, '"style="width360:px;height:400px;"> </center>';
    echo "</br></br>";

    echo '<center> <img src="https://www.zone-telechargement.ws/uploads/infos_upload.png" style="width:360px;height:31px;"> </center>';
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
    $genres = $movie->get('genres');
    foreach ($genres as $i => $type) 
    {
        if($i == 0) echo $type['name'];
    }

    $year = $movie->get('first_air_date');
    echo "<u><center> First Release Date</u> : ", $year . "</center>", PHP_EOL;

   
    
    echo "<u><center> Companies</u> : ";
    $companies = $movie->get('production_companies');

    if(null!=$companies)
    {
        foreach ($companies as $i => $name) 
        {
            if($i==0 || $i==1) echo $name['name'] . ", ";
        }
    }
    else echo 'Unknown';
    

    $production_sea = $movie->get('in_production');
    if(null!=$production_sea)
    {
         echo "<u><center> Season in Production</u> : ", $production_sea . "</center>", PHP_EOL;
    }
    else echo "<u><center> Season in Production</u> : Unknown";

    $nb_sea = $movie->getNumSeasons();
    echo "<u><center> Number of Season</u> : ", $nb_sea . "</center>", PHP_EOL;

    $nb_ep = $movie->getNumEpisodes();
    echo "<u><center> Number of Episode</u> : ", $nb_ep . "</center>", PHP_EOL;

    $vote_avg = $movie->getVoteAverage();
    echo "<u><center> Vote Average</u> : ", $vote_avg . "</center>", PHP_EOL;

    $vote_count = $movie->getVoteCount();
    echo "<u><center> Vote Count</u> : ", $vote_count . "</center>", PHP_EOL;
    echo "</br></br>";

    echo '<center> <img src="https://www.zone-telechargement.ws/uploads/synopsis.png" style="width:360px;height:31px;"> </center>', PHP_EOL;
    echo "</br></br>";

    $synopsy = $movie->get('overview');
    echo '<center>' . $synopsy . '</center>';

    echo "</br></br>";

    $season = $movie->get('seasons');
    ?><div class='cadre'><?php 
        foreach($season as $i => $value)
        {
            
        
            echo "\t<div class='col'> <div class='titre'><h3> Season " . $value['season_number']  . "</h3>\t(" . $value['air_date']  . ")</div>\t</br>" .
                 '<a href = "index.php?zone=tvShows&item=infoSeason&id=', $_GET['id'], '&season=' .  $value['season_number'] .'&language=' . $_GET['language'] . '&ep=1"> 
                 <block> 
                     <img src="https://image.tmdb.org/t/p/original' . $value['poster_path'] .'"width="220px" height="300px"/>
                 </block> </a> </div> ';
        
        }

        ?></div><?php

?>



