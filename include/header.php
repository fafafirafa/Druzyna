

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" >

<?php
	
	
	$page = $_GET['page'];
	
	if($page == 'Sklad' || $page == 'sklad')
	{
		$page = 1;
	}
	else if($page == 'Informacje' || $page == 'informacje')
	{
		$tytul = "Informacje o drużynie Rubedo Wolves";
	}

	function nazwa_strony($page){
		if($page == 1){
			echo "Skład drużyny Rubedo Wolves";
		}
		else if ($page == 2)
		{
			echo "Informacje o drużynie Rubedo Wolves";
		}
		else
		{
			echo "Strona główna drużyny Rubedo Wolves";
		}
	}
?>

<meta name="Author" content='Norbert "i3ercik" Kulik'>
<meta name="Description" content="Dowiedz się czegoś więcej o graczach jak i samego zespołu Rubedo Wolves">
<meta name="Keywords" content="Rubedo, Wolves, CS, GO, CS:GO, CSGO, Zespół, Gra, Drużyna, Rubedo Wolves" >
<title><?php nazwa_strony($page); ?></title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<link rel="shortuc icon" href="http://rubedo.22web.org/images/rw.png">
<link rel="stylesheet" href="//rubedo.22web.org/style/style.css">


<meta property="og:description" content="Dowiedz się czegoś więcej o graczach jak i samego zespołu Rubedo Wolves" >
<meta property="og:title" content="<?php nazwa_strony($page); ?>" >
<meta property="og:url" content="http://rubedo.22web.org" >
<meta property="og:image" content="http://rubedo.22web.org/images/rw.png" >
<meta property="og:type" content="website">


<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="http://rubedo.22web.org">
<meta name="twitter:title" content="<?php nazwa_strony($page); ?>">
<meta name="twitter:description" content="Dowiedz się czegoś więcej o graczach jak i samego zespołu Rubedo Wolves">
<meta name="twitter:image" content="http://rubedo.22web.org/images/rw.png">