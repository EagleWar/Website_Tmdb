<?php

    echo '  <div class="panel panel-default">
                    <div class="panel-body">
                        <ul>';

	if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $id = test_input($_GET['id']);
        $season = test_input($_GET['season']);
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

	$movie = $tmdb->getSeason($id, $season, null, $_GET['language']);


    //print_r($movie);
  $backdrop = 'https://image.tmdb.org/t/p/original' . $movie->get('poster_path');


	$title = $movie->getName();
    echo '<h1 style="text-align: center;">' . $title . '</h1>';
    echo "</br>";

    $poster =  'https://image.tmdb.org/t/p/original' . $movie->getPoster();
    echo '<center> <img src="', $poster, '"style="width360:px;height:400px;"> </center>';
    echo "</br></br>";

    echo '<center> <img src="https://www.zone-telechargement.ws/uploads/infos_upload.png" style="width:360px;height:31px;"> </center>';
    echo "</br></br>";

    $year = $movie->get('air_date');
    echo "<u><center> First Release Date</u> : ", $year . "</center>", PHP_EOL;

    $nb_ep = $movie->getNumEpisodes();
    echo "<u><center> Number of Episode</u> : ", $nb_ep . "</center>", PHP_EOL;

    echo "</br></br>";

    $synopsy = $movie->get('overview');
    if(null!=$synopsy)
    {
        echo '<center>' . $synopsy . '</center>';

        echo "</br></br>";
    } 

    $episodes = $movie->get('episodes');

    //print_r($episodes);
     
     echo '<div id="accordion">';
        foreach($episodes as $i => $value)
        {
            if(null!=$value['overview'])
            {
                $tmp = $i + 1;
                    echo '
                    <h3><a href = "index.php?zone=tvShows&item=infoSeason&id=', $_GET['id'], '&season=' .  $value['season_number'] .'&language=' . $_GET['language'] . '&ep=' . $tmp .  '">Episode n°'. $tmp .'</a><center> ' .  $value['name'] . ' (vote = ' . $value['vote_average'] . ')</center></h3><div><p>'. $value['overview'] .' .</p></div>'
                  ;
              }

        } 
       

    ?>
