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

	$movie = $tmdb->getPerson($id,null, $_GET['language']);


    //print_r($movie);

	$title = $movie->getName();
    echo '<h1 style="text-align: center;">' . $title . '</h1>';
    echo "</br>";

    $poster =  'https://image.tmdb.org/t/p/original'. $movie->getProfile();

    echo '<center> <img src="', $poster, '"style="width360:px;height:400px;"> </center>';
    echo "</br></br>";

    $birthday = $movie->getBirthday();
    echo "<u><center> Birthday Date</u> : ", $birthday . "</center>", PHP_EOL;

    $death = $movie->get('deathday');
    if(null!=$death)
    echo "<u><center> Death Date</u> : ", $death . "</center>", PHP_EOL;
    else echo "<u><center> Death Date</u> : Not yet</center>", PHP_EOL;

    $placebirth = $movie->getPlaceOfBirth();
    echo "<u><center> Place of Birth</u> : ", $placebirth . "</center>", PHP_EOL;

    $popularity = $movie->getPopularity();
    if(null!=$popularity) echo "<u><center> Popularity</u> : ", $popularity . "</center>", PHP_EOL;
    else echo "<u><center> Popularity</u> : Unknown</center>";

    echo '<br>';

    $biography = $movie->get('biography');
    echo '<div id="accordion"><h3>Biography</h3><div><p>'. $biography.' .</p></div></div>';

    $bestmovie = $movie->getMovieRoles();

    echo '<br>';

 // print_r($bestmovie);

    $array = array();

    foreach($bestmovie as $i => $value)
    {
        $array[$i] = $value->get('popularity');
    }

    rsort($array);

    echo '<h2 style="text-align: center;"> BEST MOVIES </h2>'
    ?><div class='cadre'><?php 
        foreach($bestmovie as $i => $value)
        {
            if($value->get('popularity') == $array[0] || $value->get('popularity') == $array[1] || $value->get('popularity') == $array[2] || $value->get('popularity') == $array[3])
            {

                echo "\t<div class='col'> <div class='titre'>" . $value->get('title')  . "\t(" . $value->get('release_date')  . ")</div>\t</br>" .
                 '<a href = "index.php?zone=movies&item=infoMovie&id=', $value->get('id'), '&language=' . $_GET['language'] . '"> 
                 <block> 
                     <img src="https://image.tmdb.org/t/p/original' . $value->get('poster_path') .'"width="220px" height="300px"/>
                 </block> </a> </div> ';
            }
            
            
        
        }

        ?></div><?php

?>

