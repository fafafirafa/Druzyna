<!DOCTYPE html>
<html>
	
	<head>
		<?php
			require_once('include/databs.php');
			require_once('include/bbcode.php');
			require_once('include/header.php');
		?>
	</head>
	
	<body>
		<?php
			session_start();
			if (isset($_SESSION['zalogowany']))
			{
				echo '<div style="width: 103.5%;height:45px;font-size:20px;padding:2px;background-color:gray;margin:-2%;padding-top:4px;text-align:center;margin-bottom:6px;">Witaj, ' . $_SESSION['user'] . '<div style="text-align:right;float:right;margin-right:180px;font-size:16px;padding-top:0px;margin-left:-300px;"><a href="panel">Przejście do panelu</a></div></div>';
				echo '<form method="POST"><p style="text-align:right;margin-top:-38px;margin-right:15px;margin-bottom:20px;">
				<button name="logout" style="background:0;border:0px;color:blue;text-decoration:underline;cursor:pointer;">Wyloguj się!</button></p></form>';
				
				if(ISSET($_POST['logout'])){ session_destroy();Header("Refresh:0");}
			}
		?>
		
		<main>
			
			<header>
				<img id="logo" src="//rubedo.22web.org/obrazy/logo.png"/>
				<h1>RUBEDO WOLVES</h1>
			</header>
			
			<nav>
				<a <?php if($page == 'Glowna' || $page == 'glowna' || empty($page)){ echo 'class="active" ';} ?>href="/">Strona Główna</a>
				<a <?php if($page == 'Sklad' || $page == 'sklad' || $page == 1){ echo 'class="active" ';} ?>href="/Sklad">Skład</a>
				<a <?php if($page == 'Informacje' || $page == 'informacje' || $page == 2){ echo 'class="active" ';} ?>href="/Informacje">O drużynie</a>
			</nav>
			
			<section>
				<?php
					
					
					//////////////////////////////////////////////////////////////
					
					
					
					
					echo '<div id="srd">';
					switch($page){
						
						case 1:
						echo '<article>';
						(include('include/druzyna.php')) || die('Jeżeli widzisz ten komunikat to zgłoś nam to na naszego FaceBooka a my postaramy się rozwiązać problem jak najszybciej.
						Kod Błędu: iclDrc1 ');
						(include('include/druzyna_info.php')) || die('Jeżeli widzisz ten komunikat to zgłoś nam to na naszego FaceBooka a my postaramy się rozwiązać problem jak najszybciej.
						Kod Błędu: iclDIc1 ');
						$vars = array(
						'{%druzyna}' => $zmiana
						);
						$wyswietl = strtr($do_zmiany, $vars);
						echo bbcode($wyswietl);
						
						echo '</article>';
						break;
						
						
						case 2:
						echo '<article>';
						(include('include/informacje.php')) || die('Jeżeli widzisz ten komunikat to zgłoś nam to na naszego FaceBooka a my postaramy się rozwiązać problem jak najszybciej.
						Kod Błędu: iclIcs2 ');
						echo '</article>';
						break;
						
						default:
						$nws = 'SELECT Tytul,Data,Dodajacy,Tresc FROM newsy ORDER BY Id DESC';
						
						$artykuly = mysqli_query($db,$nws);
						
						if (mysqli_num_rows($artykuly)) {
							// output data of each row
							while($row = mysqli_fetch_assoc($artykuly)) {
								echo '
								<article>
								<p><i class="fa fa-calendar"></i> ' . $row['Data'] . '&nbsp;&nbsp;<i class="fa fa-user-o"></i>&nbsp;' . $row['Dodajacy'] . '</p>
								<h1>' . $row['Tytul'] . '</h1>
								<p>' . bbcode($row['Tresc']) . '</p>
								</article>
								';
								
								
								
							}
						} //else & while
						break;
						
					} //switch
					echo '</div>';
				?>
				
				
				</section>
				
							</main>
							
							<aside>
								<div id="nag"><center>Partnerzy</center></div>
								<div id="zaw"><center>
									<?php
										
										
										
										$prt = 'SELECT Nazwa,Strona,Zdjecie FROM partnerzy';
										$loga = mysqli_query($db,$prt);
										
										if (mysqli_num_rows($loga)) {
											// output data of each row
											while($czw = mysqli_fetch_assoc($loga)) {
												
												echo '<a href="' . $czw["Strona"] . '" target="_blank"><img src="' . $czw["Zdjecie"] .'" title="'. $czw["Nazwa"] .'" /></a>';
												
											}
										}
										
									?>
								</center></div>
								<br/>
								<div id="nag"><center>YouTube</center></div>
								<div id="zaw">
									<center><?php
										require_once('include/lista.php');
									?>
									</center>
								</div>
							</aside>
							
							<footer>
								Rubedo Wolves - Wszystkie prawa zastrzeżone © Zakaz kopiowania <?php echo date(Y); ?>&copy;
							</footer>
							
	</body>
	
</html>							