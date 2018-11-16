<?php
    echo '  <div class="panel panel-default">
                <div class="panel-body">
                    <ul>';

    ini_set("display_errors",0);error_reporting(0);


    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $page = test_input($_GET["page"]);
        $year = test_input($_GET["year"]);
        $genre_id = test_input($_GET["genre"]);
        $director_id = test_input($_GET["productor"]);
        $actor_id = test_input($_GET["actor"]);

        //else $page = 1;
    }

	$page++;


    //$year = $genre = $productor = $actor = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $year = test_input($_POST["year"]);
        $genre = test_input($_POST["genre"]);
        $productor = test_input($_POST["productor"]);
        $actor = test_input($_POST["actor"]);
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $gr = $tmdb->getMovieGenres();
	$genre_name = null;

?>

<form style="text-align: center;"  method="post" action="index.php?zone=movies&item=discoverMovie&language=<?php echo $_GET['language']; ?>">
    <select name="year" style="margin-left: 9px; margin-top: 15px;width:150px; background: transparent;border:0; border-bottom: 2px solid black;  ">
    	<option value="">Year</option>
	    <?php for($i = 2017; $i > 1960; $i--)
		{
			?><option value ="<?php echo $i;?>"> <?php echo $i;?> </option> 
		<?php } ?>
	</select>

    <select name="genre" style="margin-left: 9px; margin-top: 15px;width:150px; background: transparent;border:0; border-bottom: 2px solid black;  ">
    	<option value="None">Genre</option>
	    <?php foreach($gr as $i => $value)
		{
			$genre_name = $value->getName();?>
			<option value ="<?php echo $genre_name;?>"> <?php echo $genre_name;?> </option> 
		<?php } ?>
	</select>

     <input  placeholder="Director" style="margin-left: 9px; margin-top: 15px;width:150px; background: transparent;border:0; border-bottom: 2px solid black;  " type="text" name="productor">
    <input  placeholder="Actor" style="margin-left: 9px; margin-top: 15px;width:150px; background: transparent;border:0; border-bottom: 2px solid black;  " type="text" name="actor">
    <br><br>
    <input type="submit" name="submit" value="Go">

</form>

<?php
	//$actor_id = null;

//ini_set("display_errors",0);error_reporting(0);

	if($actor!=null)
	{
		$act = $tmdb->searchPerson($actor);
		
		foreach($act as $i => $value)
		{
			if($i == 0) $actor_id = $value->getID();
		}
	}
	
	//$director_id = null;

	if($productor!=null)
	{
		$dir = $tmdb->searchPerson($productor);

		foreach($dir as $i => $value)
		{
			if($i == 0) $director_id = $value->getID();
		}
	}
	

	$gr = $tmdb->getMovieGenres();
	//$genre_id = null;

	foreach($gr as $i => $value)
	{
		if($value->getName() == $genre) $genre_id = $value->getID();
	}

	if($year!=null || $genre!=null || $productor!=null || $actor!=null || $actor_id!=null || $director_id!=null || $genre_id!=null)
	{
		$movies = $tmdb->getDiscoverMovies($page, $year, $genre_id, $director_id, $actor_id, $_GET['language']);
		?><div class='cadre'><?php 
		foreach($movies as $movie)
		{

		    echo "\t<div class='col'> <div class='titre'>" . $movie->getTitle()  . "\t(" . $movie->getYear()  . ")</div>\t</br>" .
			     '<a href = "index.php?zone=movies&item=infoMovie&id=', $movie->getID(), '&language=' . $_GET['language'] . '"> 
			     <block> 
			         <img src="https://image.tmdb.org/t/p/original' . $movie->getPoster() .'"width="220px" height="300px"/>
			     </block> </a> </div> ';
		}
		?></div><?php 
		echo '          </ul>
		            </div> <a href="index.php?zone=movies&item=discoverMovie&page=' . $page . '&year=' . $year . '&genre=' . $genre_id . '&productor=' . $director_id . '&actor=' . $actor_id  . '&language=' . $_GET['language'] . '"style="margin-left:85%"
		            	<button> Next Page </button>
		            	</a>
		        </div>';

	}

	 
?>