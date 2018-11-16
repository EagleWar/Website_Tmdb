
<?php
    echo '  <div class="panel panel-default">
                <div class="panel-body">
                    <ul>';

    echo "</br>";

    $search = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $search = $_POST["search"];
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

	if($search!=null)
	{
		$movies = $tmdb->searchMovie($search, $_GET['language']);

	    if(null!=$movies)
        {
            ?>
            <h2 style="text-align: center;"> Movies </h2>
            <div class='cadre'><?php 
            foreach($movies as $movie)
            {

                if(null!=$movie->getPoster())
                {
                
                    echo "\t<div class='col'> <div class='titre'>" . $movie->getTitle()  . "\t(" . $movie->getYear()  . ")</div>\t</br>" .
                         '<a href = "index.php?zone=movies&item=infoMovie&id=', $movie->getID(), '&language=' . $_GET['language'] . '"> 
                         <block> 
                             <img src="https://image.tmdb.org/t/p/original' . $movie->getPoster() .'"width="220px" height="300px"/>
                         </block> </a> </div> ';
                }
            }
        }

        


        $movies = $tmdb->searchTVShow($search, $_GET['language']);

        if(null!=$movies)
        {
            ?>
            <h2 style="text-align: center;"> TV Shows </h2> 
            <div class='cadre'><?php
            foreach($movies as $movie)
            {

               
                if(null!=$movie->getPoster())
                {
                    echo "\t<div class='col'> <div class='titre'>" . $movie->getName()  . "\t(" . $movie->get('first_air_date')  . ")</div>\t</br>" .
                     '<a href = "index.php?zone=tvShows&item=infoTV&id=', $movie->getID(), '&language=' . $_GET['language'] . '"> 
                     <block> 
                         <img src="https://image.tmdb.org/t/p/original' . $movie->getPoster() .'"width="220px" height="300px"/>
                     </block> </a> </div> ';
                }
                
            }
    }

        $movies = $tmdb->searchPerson($search);

        if(null!=$movies)
        {
            ?>
            <h2 style="text-align: center;"> Persons </h2> 
            <div class='cadre'><?php
            foreach($movies as $movie)
            {

                if(null!=$movie->getProfile())
                {
                    echo "\t<div class='col'> <div class='titre'>" . $movie->getName()  . "</div>\t</br>" .
                     '<a href = "index.php?zone=person&item=person&id=', $movie->getID(), '&language=' . $_GET['language'] . '"> 
                     <block> 
                         <img src="https://image.tmdb.org/t/p/original' . $movie->getProfile() .'"width="220px" height="300px"/>
                     </block> </a> </div> ';
                }
                
            }
    }

        ?></div><?php 

	    echo '          </ul>
	                </div>
	            </div>';
	}
	 
?>
