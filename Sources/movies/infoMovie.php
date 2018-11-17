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

    echo "</br></br>";

    $title = str_replace(' - ', ' ', $title);

    $title = str_replace(' : ', ' ', $title);

    $title = str_replace("'", '', $title);

    $title = str_replace('ème', 'e', $title);

    $title = str_replace(' & ', ' ', $title);

    $title = str_replace(', ', ' ', $title);

    $title = str_replace(': ', ' ', $title);

    $title = str_replace(' ', '-', $title);

    $title = htmlentities($title, ENT_NOQUOTES, $charset);

    $title = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $title);
    $title = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $title); // pour les ligatures e.g. '&oelig;'

    $title = preg_replace('#&[^;]+;#', '', $title); // supprime les autres caractères

    $title = mb_strtolower($title);

    if($_GET[language]=="fr") 
      {
        $stream = 'http://www.hds.to/films/'. $title . '-' . substr($year, 0, -6). '-streaming.php';

        $sn_search = $title;

        $title = $title . ' VF';
      }
    else 
      {
        $movie = $tmdb->getMovie($id,null, 'fr');

        $title = $movie->getTitle();

        $title = str_replace(' - ', ' ', $title);

        $title = str_replace(' : ', ' ', $title);

        $title = str_replace(' & ', ' ', $title);

        $title = str_replace('ème', 'e', $title);

        $title = str_replace("'", '', $title);

        $title = str_replace(', ', ' ', $title);

        $title = str_replace(': ', ' ', $title);

        $title = str_replace(' ', '-', $title);

        $title = htmlentities($title, ENT_NOQUOTES, $charset);

        $title = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $title);
        $title = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $title); // pour les ligatures e.g. '&oelig;'

        $title = preg_replace('#&[^;]+;#', '', $title); // supprime les autres caractères

        $title = mb_strtolower($title);

        $year = substr($year, 0, -6);

        $stream = 'http://www.hds.to/films/'. $title . '-' . $year. '-streaming.php?v=vo';

        $sn_search = $title;

        $title = $title . ' VOSTF';


      }

      //echo $stream;

      $url=$stream;

      echo $url;

      $essais = get_headers($url, 1);

      if(preg_match("#[^a-z0-9]2[0-9]{2}([^a-z0-9].*)$#i",$essais[0])) $url=$url;

      else 
      {
          $year = (int)$year - 1;

          if($_GET['language'] == 'fr') $url='http://www.hds.to/films/'. $sn_search . '-' . $year. '-streaming.php';

          else  $url = 'http://www.hds.to/films/'. $sn_search . '-' . $year. '-streaming.php?v=vo';
      }

      echo '<br>' . $url;

      $curl_handle=curl_init();
      curl_setopt($curl_handle, CURLOPT_URL,$url);
      curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
      curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Mozilla/5.0');
      $resultat = curl_exec($curl_handle);
      curl_close($curl_handle);

      $i = strpos ( $resultat , "hh()");

      $j = strpos ( $resultat , 'de;(');

      $sub = $j - $i;

      $start = $i;

      $function1 = substr (  $resultat , $start-9, $sub-25);

      $i = strpos ( $resultat , "subs/");

      $j = strpos ( $resultat , "-fr.vtt");

      $sub = $j - $i;

      $start = $i;

      $cc = substr (  $resultat , $start+5, $sub-5);

      if(strlen($cc)>100) $cc = null;

      echo $cc;




?>

<script src="https://cdn.radiantmediatechs.com/rmp/v4/latest/js/rmp.min.js"></script>   
<div class="vid-container" style="box-shadow: h-pos v-pos (blur) (spread) (color) (inset);"> 
<div id='mediaplayer' style="box-shadow: h-pos v-pos (blur) (spread) (color) (inset); "> </div>  
<script>
function hhdanr() {
var values = ["","","","","","","","","",""],
vd = values[Math.floor(Math.random() * values.length)];
return de(vd);
}
function hhiosdanr() {
var values = ["","","","","","","","","",""],
vd = values[Math.floor(Math.random() * values.length)];
return de(vd);
}

<?php echo $function1; ?>

</script>


<script type="text/javascript"> 
var de;(function(){var _0x1755E=["\x61\x48\x52","\x4D","\x6A\x6F\x69\x6E","\x37\x41\x34\x63\x31\x59\x39\x54\x38\x63","\x73\x70\x6C\x69\x74","\x56","\x38\x41\x35\x64\x31\x59\x58\x38\x34\x41\x34\x32\x38\x73","","\x24","\x66\x72\x6F\x6D\x43\x68\x61\x72\x43\x6F\x64\x65","\x6C\x65\x6E\x67\x74\x68","\x63\x68\x61\x72\x41\x74","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39\x2B\x2F"];function _0x1759E(_0x175DE){var _0x175DE=_0x1755E[0]+ _0x175DE;var _0x175DE=_0x175DE[_0x1755E[4]](_0x1755E[3])[_0x1755E[2]](_0x1755E[1]);var _0x175DE=_0x175DE[_0x1755E[4]](_0x1755E[6])[_0x1755E[2]](_0x1755E[5]);var _0x175DE=_0x175DE[_0x1755E[4]](_0x1755E[8])[_0x1755E[2]](_0x1755E[7]);var _0x1761E,_0x1765E,_0x1769E,_0x176DE={},_0x1771E=0,_0x1775E=0,_0x1779E=_0x1755E[7],_0x177DE=String[_0x1755E[9]],_0x1781E=_0x175DE[_0x1755E[10]];for(_0x1761E= 0;64> _0x1761E;_0x1761E++){_0x176DE[_0x1755E[12][_0x1755E[11]](_0x1761E)]= _0x1761E};for(_0x1765E= 0;_0x1781E> _0x1765E;_0x1765E++){for(_0x1761E= _0x176DE[_0x175DE[_0x1755E[11]](_0x1765E)],_0x1771E= (_0x1771E<< 6)+ _0x1761E,_0x1775E+= 6;_0x1775E>= 8;){((_0x1769E= 255& _0x1771E>>> (_0x1775E-= 8))|| _0x1781E- 2> _0x1765E)&& (_0x1779E+= _0x177DE(_0x1769E))}};return _0x1779E}de= _0x1759E;})()
</script> 
<script>
var bitrates = { 
  hls:hh(), 
  mp4: [ 
    ht() 
  ], 
};

var ccFiles = [
            ['fr', 'Français', 'http://www.hds.to/films/subs/<?php echo $cc; ?>-fr.vtt'],
            ['en', 'English', 'http://www.hds.to/films/subs/<?php echo $cc; ?>-en.vtt'],
            ['es', 'Español', 'http://www.hds.to/films/subs/<?php echo $cc; ?>-es.vtt'],
            ['it', 'Italiano', 'http://www.hds.to/films/subs/<?php echo $cc; ?>-it.vtt'],
            ['ar', 'عربي', 'http://www.hds.to/films/subs/<?php echo $cc; ?>-ar.vtt'],
];

    var labels = {
  bitrates: {
    renditions: ['Basse qualité', 'Haute qualité']
  },
  hint: {
    sharing: 'Partager',
    quality: 'Qualité',
    speed: 'Vitesse',
    captions: 'Sous-titres',
    cast: 'Chromecast',
    airplay: 'AirPlay'
  },
  captions: {
    off: 'Arrêt'
  }
};
 
var settings = {
  licenseKey: 'Kl8lYnowMjdlP3JvbTVkYXNpczMwZGIwQSVfKg==',
  bitrates: bitrates,
  ccFiles: ccFiles, 
  delayToFade: 1000,
  autoHeightMode: true,
  contentTitle: '<?php echo $title; ?>', 
  autoHeightModeRatio: 2.4,
  skinAccentColor: 'CF6306',
  skinButtonColor: 'fd9a31',
  googleCast: false,
  skinBackgroundColor: 'rgba(0, 0, 0, 0.9)',
  skin: 's2',
  labels: labels,
  poster: '<?php echo $backdrop; ?>'
};
var elementID = 'mediaplayer';
var counter = 0;
var rmp = new RadiantMP(elementID);
var rmpContainer = document.getElementById(elementID);
rmpContainer.addEventListener('ready', function() {
  rmp.fw.addClass(rmpContainer, 'rmp-custom-icon-2');
});
rmpContainer.addEventListener('ready', function() {
  rmp.setVolume(1);
});
rmp.init(settings);
</script> </div>    <script> 

