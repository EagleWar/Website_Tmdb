<?php
    echo '  <div class="panel panel-default">
                <div class="panel-body">
                    <ul>';

    ini_set("display_errors",0);error_reporting(0);


    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $page = test_input($_GET["page"]);
        //else $page = 1;
    }

	$page++;

	function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

	$movies = $tmdb->getPopularTVShows($page, $_GET['language']);

	//print_r($movies);

	$result;

	?><div class='cadre'><?php 
		foreach($movies as $movie)
		{
		    
		    echo "\t<div class='col'> <div class='titre'>" . $movie->getName()  . "\t(" . $movie->get('first_air_date')  . ")</div>\t</br>" .
			     '<a href = "index.php?zone=tvShows&item=infoTV&id=', $movie->getID(), '&language=' . $_GET['language'] . '"> 
			     <block> 
			         <img src="https://image.tmdb.org/t/p/original' . $movie->getPoster() .'"width="220px" height="300px"/>
			     </block> </a> </div> ';
		}

		?></div><?php 

	echo '          </ul>
		            </div> <a href="index.php?zone=tvShows&item=popularTV&page=' . $page . '&language=' . $_GET['language'] . '"style="margin-left:85%"
		            	<button> Next Page </button>
		            	</a>
		        </div>';
	
	 
?>