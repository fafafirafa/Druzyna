<html lang="PL">
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		
		<?php
			require_once('databs.php');
			
			
		?>
		
		<style>
			
			#main-menu {
			width: 100%;
			height: 67px;
			background: lightblue;
			}
			#main-menu .submenu {
			display: none;
			position: absolute;
			top: 67px;
			left: 0px;
			width: 100%;
			list-style-type: none;
			background: #fff;
			margin: 0;
			border:solid 1px #eeeeee;
			z-index:5;
			padding:0;
			}
			#main-menu .submenu li {
			display: block;
			border-bottom: solid 1px #eeeeee;
			margin:0;
			}
			#main-menu .submenu li a {
			color: #333;
			height:18px;
			padding:10px 0;
			font-size:13px;
			}
			#main-menu .submenu li a:hover {
			background:#f9f9f9;
			}
			#menu-primary {
			list-style-type: none;
			margin: 0;
			float: left;
			padding:0;
			}
			#menu-primary li {
			float: left;
			position: relative;
			}
			#menu-primary li a {
			float: left;
			color: #000;
			text-align: center;
			font-size: 26px;
			height: 48px;
			padding-top: 22px;
			line-height: 16px;
			width: 164px;
			text-decoration:none;
			}
			#menu-primary li a:hover {
			text-decoration:none;
			}
			#menu-primary li:hover .submenu {
			display: block;
			}
			
			body
			{
			background-image:none;
			width:99%;
			}
			
			#panel
			{
			margin-left: -8px;
			margin-top: -8px;
			width:100%;
			border-top-right-radius: 0px;
			border-top-left-radius: 0px;
			}
			
			#tab tr, #tab td, #tab, #tab th
			{
			margin:10px;
			border:1px solid black;
			text-align:left;
			padding:6px;
			}
			
			#down
			{
			margin-top: 50px;
			clear:both;
			}
			
			a
			{
			margin:2px;
			color:blue;
			}
			
			textarea
			{
			min-width:150px;
			min-height:100px;
			}
			
			#zalogowany
			{
			background-color:gray;
			margin-top:0px;
			margin-bottom:0px;
			font-size:25px;
			padding-top:10px;
			width: 100%;
			height:40px;
			text-align:center;
			}
			
			#log
			{
			margin-top:300px;
			}
		</style>
		
		<head>
			<body>
				
				
				<div id="panel">
					
					<?php
						
						session_start();
						
						if (!isset($_SESSION['zalogowany']) && !isset($_SESSION['dodawarka']))
						{
							
							echo ' <center><form id="log" method="POST" >
							Login: <input type="text" name="login" required><br>
							Hasło: <input type="password" name="haslo" style="margin-top:5px;" required><br>
							<input type="submit" name="zaloguj" value="Zaloguj" style="margin-top:5px;">
							</form>';
							
							if(ISSET($_POST['zaloguj'])){
								///
								if($_POST['login'] == 'uzytkownik' && $_POST['haslo'] == 'dodaj')
								{
									
									$_SESSION['dodawarka'] = true;
									echo '
										<script>window.location.replace("");</script>
										';
									
									
									} else {
									$login = $_POST['login'];
									$haslo = hash('sha256',$_POST['haslo']);
									
									$login = htmlentities($login,ENT_QUOTES, "UTF-8");
									$haslo = htmlentities($haslo,ENT_QUOTES, "UTF-8");
									
									if($rezultat = @$db->query(
									sprintf("SELECT * FROM uzytkownicy WHERE User='%s' AND Pass='%s'",
									mysqli_real_escape_string($db,$login),
									mysqli_real_escape_string($db,$haslo))))
									{
										$ilu_userow = $rezultat->num_rows;
										if($ilu_userow>0)
										{
											$_SESSION['zalogowany'] = true;
											
											$wiersz = $rezultat->fetch_assoc();
											$_SESSION['id'] = $wiersz['Id'];
											$_SESSION['user'] = $wiersz['User'];
											header("Refresh:0");
											
										}else {echo '<br><span style="color:red;">Złe dane logowania.</span>';}
									} 
									
								}
								///
							}
							echo '</center>';
							} else if ($_SESSION['dodawarka']) {
							////////////////////////////////////////////////////////////////////////
							echo '<div style="margin-top:150px;text-align:center;">';
							echo 'Witaj na koncie dzięki któremu możesz dodać konto do systemu,<br>wypełnij poniższy formularz by dodać użytkownika do bazy.';
							echo '<br><br><br>';
							echo '	<form method="POST">
							Login: <input type="text" name="login"'; if(!empty($_POST['login']) && isset($_POST['dodaj'])){echo 'value="' . $_POST['login'] . '" ';} echo '><br><br>
							Hasło: <input type="password" name="haslo"'; if(!empty($_POST['haslo']) && isset($_POST['dodaj'])){echo 'value="' . $_POST['haslo'] . '" ';} echo '><br><br>
							<input type="submit" name="dodaj" value="Dodaj">
							</form>';
							echo '</div>';
							
							if(isset($_POST['dodaj'])){
								$login = $_POST['login'];
								$haslo = hash('sha256',$_POST['haslo']);
								
								$login = htmlentities($login,ENT_QUOTES, "UTF-8");
								$haslo = htmlentities($haslo,ENT_QUOTES, "UTF-8");
								
								if($rezultat = @$db->query(
								sprintf("SELECT * FROM uzytkownicy WHERE User='%s'",
								mysqli_real_escape_string($db,$login))))
								{
									$ilu_userow = $rezultat->num_rows;
									if($ilu_userow>0)
									{
										echo'<p style="text-align:center;color:red;">Wybrana nazwa jest zajęta</p>';
										
										}else {
										$pytanie = "INSERT INTO `uzytkownicy`( `User`, `Pass`) VALUES ('" . $login . "', '" . $haslo . "')";
										echo '<div style="text-align:center;">';
										mysqli_query($db,$pytanie) or die ("Przepraszamy, ale z powodu problemu technicznego wprowadzenie nowego użytkownika nie było możliwe");
										echo 'Gratuluję, konto zostało pomyślnie stworzone,<br>
										teraz możesz wylogować się używając przycisku poniżej<br>
										oraz zalogować się na swoje konto w celu dostępu do panelu<br>';
										echo '<form method="POST"><input type="submit" name="uzylog" value="Wyloguj"></form>';
										echo '</div>';
										
									}
								} 
								
							}
							if(isset($_POST['uzylog'])){
								session_destroy();
							}
							///////////////////////////////////////////////////////////////////////////
							} else {
						?>
						<center>
							<p id="zalogowany">
								<?php
									
									echo 'Witaj, ' . $_SESSION['user'];
									echo '<p style="font-size:15px;margin-top:-40px;text-align:right;margin-right:150px;margin-bottom:25px;"><a href="/">Strona główna</a></p>';
									echo '<form method="POST"><p style="text-align:right;margin-top:-25px;margin-right:15px;margin-bottom:-10px;">
									<button name="logout" style="background:0;border:0px;color:blue;text-decoration:underline;cursor:pointer;">Wyloguj się!</button></p></form>';
									
									if(ISSET($_POST['logout'])){ session_destroy();Header("Refresh:0");}
									
								?>
								
								
							</p>
							
							<div id="up">
								
								<header id="main-menu">
									<ul id="menu-primary">
										<li><a href="panel?page=1">Artykuły</a>
											<ul class="submenu">
												
												<li><a href="?page=1.1">Dodaj artykuł</a>
												</li>
												
											</ul>
											
										</li>
										<li><a href="?page=2">Drużyna</a>
											<ul class="submenu">
												<li><a href="?page=2.1">Info o składzie</a>
												</li>
											</ul>
										</li>
										<li><a href="?page=3">Partnerzy</a>
											<ul class="submenu">
												<li><a href="?page=3.1">Dodaj Partnera</a>
												</li>
											</ul>
										</li>
										<li><a style="cursor:context-menu">Informacje</a>
											
											<ul class="submenu">
												<li><a href="?page=4.1">Informacje o drużynie</a>
												</li>
												<li><a href="?page=4.2">Informacje Główne</a>
												</li>
												<li><a href="?page=4.3">Część Techniczna</a>
												</li>
												
											</ul>
										</li>
									</ul>
								</header>
								
							</div>
							
							<div id="down">
								<center>
									
									<?php
										
										$page = $_GET['page'];
										if($page == 1){
											
											
											
											$edit = $_GET['edit'];
											if($edit > -1 && $edit !== ''){
												
												
												$zap = 'SELECT * FROM newsy WHERE Id=' . $edit; 
												
												$edycja = mysqli_query($db,$zap) or die ('Wystąpił problem z edycją artykułu o Id: ' . $edit);
												
												if (mysqli_num_rows($edycja)) {
													// output data of each row
													while($czw = mysqli_fetch_assoc($edycja)) {
														
														echo '<div><form method="POST"><p style="margin-left:-450px;margin-bottom:-20px;">
														<button name="zapisz" style="padding-right:20px;background:0;border:0px;color:blue;text-decoration:underline;cursor:pointer;">Zapisz</button>
														<a href="?page=1&edit=" >Anuluj</a>
														</p>
														
														<table style="border:1px solid black;padding:20px;margin:30px;"><tbody>
														<tr>
														<td style="text-align:right;">
														
														Id:
														
														</td><td>
														<input type="text" disabled value="' . $czw['Id'] . '" style="width:100px;background:0;text-align:center;padding:10px;font-size:17px;color:black">
														</td>
														</tr><tr>
														<td style="text-align:right;">
														
														Data dodania:
														
														</td><td>
														<input type="text" name="dodal" disabled value="' . $czw['Data'] . '" style="width:100px;background:0;text-align:center;padding:10px;font-size:14px;color:black;">
														
														</tr><tr>
														<td style="text-align:right;">
														
														Dodał:
														
														</td><td><input type="text" name="dodal" disabled value="' . $czw['Dodajacy'] . '" style="width:200px;background:0;text-align:center;padding:10px;font-size:16px;color:black">
														<p style="margin-left:230px;margin-top:-35px;margin-bottom:16px;font-size:10px;width:175px;">Czy chcesz dodać siebie obok dodającego? ( "' . $czw['Dodajacy'] . '/' . $_SESSION['user'] .'")</p><input type="checkbox" name="dodac" style="margin-left:210px;margin-top:-30px;">
														</td></tr><tr>
														<td style="text-align:right;">
														
														Tytuł:
														
														</td><td><textarea name="tytul" style="width:250px;padding:8px;">' . $czw['Tytul'] . '</textarea>
														</td></tr><tr>
														<td style="text-align:right;">
														
														Treść:
														
														</td><td><textarea name="tresc" style="width:500px;height:300px;color:black;padding:8px;">' . $czw['Tresc'] . '</textarea>
														</td></tr>
														</tbody></table>
														</form></div>';
														
													}
												}
												if(ISSET($_POST['zapisz'])){
													
													$ehm = 'SELECT Dodajacy FROM newsy WHERE id=' . $edit;
													$aktualizacja = mysqli_query($db,$ehm);
													
													if (mysqli_num_rows($aktualizacja)) {
														// output data of each row
														while($row = mysqli_fetch_assoc($aktualizacja)) {
															$dodal = $row['Dodajacy'];
															
															
														}
													}
													
													$nick = '';
													$tytul = $_POST['tytul'];
													$dodac = $_POST['dodac'];
													if($dodac == 'on'){$nick = $dodal . '/' . $_SESSION['user'];} else {$nick = $dodal;}
													$tresc= $_POST['tresc'];
													
													$update = "UPDATE `newsy` SET `Tytul`='". htmlspecialchars($tytul, ENT_QUOTES, "UTF-8") ."',`Tresc`='" . htmlspecialchars($tresc, ENT_QUOTES, "UTF-8") . "',`Dodajacy`='" . htmlspecialchars($nick, ENT_QUOTES, "UTF-8") . "' WHERE id=" . $edit;
													$updsql = mysqli_query($db,$update) or die ("Wystąpił problem z aktualizacją newsa, spróbuj ponownie.");
													echo '
													<script>window.location.replace("?page=1");</script>
													';
												}
												
												} else {
												
											?>
											
											
											
											<table id="tab">
												<tbody>
													<tr>
														<th style="border-style:none">
															
														</th>
														<th>
															Id
														</th>
														<th>
															Tytuł
														</th>
														<th>
															Data dodania
														</th>
														<th>
															Treść
														</th>
														<th>
															Dodający
														</th>
													</tr>
													<?php
														
														$zpt = "SELECT * FROM newsy ORDER BY Id desc";
														$info = mysqli_query($db,$zpt);
														if (mysqli_num_rows($info)) {
															// output data of each row
															while($czw = mysqli_fetch_assoc($info)) {
																
																echo '<tr>
																<td>
																<a href="?page=1&edit=' . $czw['Id'] .'">Edytuj</a><a href="?page=1&del='. $czw['Id'] .'">Usuń</a>
																</td>
																<td>
																'. $czw['Id'] .'
																</td>
																<td>
																'. $czw['Tytul'] .'
																</td>
																<td>
																'. $czw['Data'] .'
																</td>
																<td>
																'. $czw['Tresc'] .'
																</td>
																<td>
																'. $czw['Dodajacy'] .'
																</td>
																</tr>';
																
															}
														}
													?>
												</tbody>
											</table>
											<?php
											}
											
											$del = $_GET['del'];
											if($del > -1 && $del !== '' && !empty($del)){
												$usun = 'DELETE FROM newsy WHERE Id=' . $del;
												mysqli_query($db,$usun) or die ("Niestety usunięcie rekordu z bazy danych nie powiodło się");
												echo '
												<script>window.location.replace("?page=1");</script>
												';
											}/////////////////////////////////////////////////////////////////////////////////////
											} else if ($page == 1.1){ 
											
											
											
											
											
										?>
										<form method="POST">
											<button name="dodajart">Dodaj</button><br><br>
											<textarea name="dodajtytul" style="width:250px;padding:8px;" placeholder="Tytuł"></textarea><br><br>
											<input type="text" name="date" value=<?php echo date(d.".".m.".".Y); ?>><br><br>
											<textarea name="dodajtresc" style="width:500px;height:300px;color:black;padding:8px;" placeholder="Treść"></textarea>
										</form>
										
										<?php
											
											if(ISSET($_POST['dodajart']))
											{
												
												$tytulart = $_POST['dodajtytul'];
												$trescart = $_POST['dodajtresc'];
												$dodajacyart = $_SESSION['user'];
												$data = $_POST['date'];
												
												$zapytanie = "INSERT INTO `newsy`(`Tytul`, `Data`, `Tresc`, `Dodajacy`) VALUES ('" . htmlspecialchars($tytulart, ENT_QUOTES, "UTF-8") ."','" . date(d.".".m.".".Y) ."','" . htmlspecialchars($trescart, ENT_QUOTES, "UTF-8") ."','" . htmlspecialchars($dodajacyart, ENT_QUOTES, "UTF-8") ."')";
												mysqli_query($db,$zapytanie) or die ("Przykro nam, ale publikacja newsa nie została ukończona pomyślnie");
												
												echo '
												<script>window.location.replace("?page=1");</script>
												';
											}
											
											
											}else if ($page == 2){
											$edit = $_GET['edit'];
											if ($edit != 0 && !empty($edit)){
												
												$sql = "SELECT * FROM druzyna";
												$esql = mysqli_query($db,$sql);
												echo '<form method="POST"><table style="text-align:center;">
												<tr>
												<td><input name="submit" type="submit" value="Zapisz"></td>
												</tr>
												<tr>
												<td>Id</td>
												<td>Zawodnik</td>
												<td>Rezerwa(?)</td>
												</tr>';
												if (mysqli_num_rows($esql)) {
													
													while ($row = mysqli_fetch_assoc($esql)){
														
														echo '<tr><td name="Id">' . $row['Id'] . '</td>
														<td><input type="text" name="' . $row['Id'] . '" value="' . $row['Zawodnik'] . '"></td>
														<td><input type="checkbox" name="Rez_' . $row['Id'] . '" '; if($row['Rezerwa'] == 1){echo 'checked';} echo '></td>
														</tr>';
														
													}
													
												}
												echo '</table></form>';
												
												if(ISSET($_POST['submit'])){
													$zmienna = '';
													for($test=1;$test<8;$test++){
														$rez = $_POST['Rez_'.$test];
														if($rez == 'on') {$rez = 1;} else {$rez = 'NULL';}
														$id = $_POST[$test];
														$qrey = "UPDATE druzyna SET Zawodnik='" . htmlspecialchars($id, ENT_QUOTES, "UTF-8") ."',Rezerwa=" . $rez . " WHERE Id=" . $test;
														$qry = mysqli_query($db,$qrey) or die ("Wystąpił przy zmienianiu zawodnika o Id " . $test);
														
													}
													echo '
													<script>window.location.replace("?page=2");</script>
													';
												}
												} else {
												
												echo '<table style="border:1px solid; padding:20px;text-align:center;"><tbody>
												<tr>
												<td >
												<a href="?page=2&edit=1">Edytuj</a>
												</td>
												
												</tr>
												<tr></tr>
												<tr>
												<th style="border-bottom:1px solid;">
												Id
												</th>
												<th style="border-bottom:1px solid;">
												Zawodnik
												</th>
												<th style="border-bottom:1px solid;">
												Stan
												</th>
												</tr>
												';
												$drzsql = "SELECT * FROM druzyna";
												$drz = mysqli_query($db,$drzsql) or die ('Problem z wyświetleniem informacji');
												if (mysqli_num_rows($drz)) {
													// output data of each row
													while($nmr = mysqli_fetch_assoc($drz)) {
														
														echo '<tr>
														<td style="border-bottom:1px solid;">
														' . $nmr['Id'] . '
														</td>
														<td style="border-bottom:1px solid;">
														' . $nmr['Zawodnik'] . '
														</td>
														<td>';
														if($nmr['Rezerwa'] == 1){
															echo '<i style="color:red;" class="fa fa-battery-1"></i>';
															} else {
															echo '<i style="color:green;" class="fa fa-battery-4"></i>';
														}
														echo '
														</td>
														</tr>';
														
													}
												}
												
											}
											
											} else if ($page == 2.1) {
											echo 'Pamiętaj by dodać do tekstu znacznik &quot;{%druzyna}&quot;, bo inaczej nie będzie widocznych zawodników.';
											echo '<form method="POST"><table id="tab" style="width:50%">
											<tr><th style="border:0px;text-align:center;"><button name="save">Zapisz</button></th></tr>
											<tr><th td="tab" style="text-align:center;border-bottom:0;">Informacja</th></tr><tr>';
											$drzinfo = "SELECT Informacja FROM druzyna_informacja WHERE Id=0";
											$info = mysqli_query($db,$drzinfo);
											if (mysqli_num_rows($info)) {
												// output data of each row
												while($row = mysqli_fetch_assoc($info)) {
													echo '<td id="tab" style="text-align:center;height:500px"><textarea style="width:90%;height:99%" name="informacja">' . $row['Informacja'] . '</textarea></td>';
												}
											} //else & while	
											
											echo '</td></tr></table></form>';
											if(ISSET($_POST['save'])){
												$info = $_POST['informacja'];
												$updateinfo = "UPDATE druzyna_informacja SET Informacja='" . htmlspecialchars($info, ENT_QUOTES, "UTF-8") ."' WHERE Id=0";
												$infoquery = mysqli_query($db,$updateinfo);
												echo '
												<script>window.location.replace("?page=2.1");</script>
												';
											}
											} else if ($page == 3) {
											
											$edit = $_GET['edit'];
											if($edit > -1 && $edit !== ''){
												
												
												$zap = 'SELECT * FROM partnerzy WHERE Id=' . $edit; 
												
												$edycja = mysqli_query($db,$zap) or die ('Wystąpił problem z edycją artykułu o Id: ' . $edit);
												
												if (mysqli_num_rows($edycja)) {
													// output data of each row
													while($czw = mysqli_fetch_assoc($edycja)) {
														
														echo '<div><form method="POST"><p style="margin-left:-450px;margin-bottom:-20px;">
														<button name="zapisz" style="padding-right:20px;background:0;border:0px;color:blue;text-decoration:underline;cursor:pointer;">Zapisz</button>
														<a href="?page=3" >Anuluj</a>
														</p>
														
														<table style="border:1px solid black;padding:20px;margin:30px;">
														<tr>
														<td style="text-align:right;">
														
														Id:
														
														</td><td>
														<input type="text" disabled value="' . $czw['Id'] . '" style="width:100px;background:0;text-align:center;padding:10px;font-size:17px;color:black">
														</td>
														</tr><tr>
														<td style="text-align:right;">
														
														Nazwa:
														
														</td><td><textarea name="nazwa" style="width:450px;padding:8px;">' . $czw['Nazwa'] . '</textarea>
														</td></tr><tr>
														<td style="text-align:right;">
														
														Link:
														
														</td><td><textarea name="link" style="width:450px;padding:8px;">' . $czw['Strona'] . '</textarea>
														</td></tr><tr>
														<td style="text-align:right;">
														
														Zdjęcie:
														
														</td><td><textarea name="zdjecie" style="width:450px;color:black;padding:8px;">' . $czw['Zdjecie'] . '</textarea>
														</td></tr>
														</table>
														</form></div>';
														
													}
												}
												if(ISSET($_POST['zapisz'])){
													
													
													
													
													$nazwa = $_POST['nazwa'];
													$link = $_POST['link'];
													$zdjecie = $_POST['zdjecie'];
													
													$update = "UPDATE partnerzy SET Nazwa='". htmlspecialchars($nazwa, ENT_QUOTES, "UTF-8") ."',Strona='" . htmlspecialchars($link, ENT_QUOTES, "UTF-8") . "',Zdjecie='" . htmlspecialchars($zdjecie, ENT_QUOTES, "UTF-8") . "' WHERE id=" . $edit;
													$updsql = mysqli_query($db,$update) or die ("Wystąpił błąd przy edycji partnera, zmiany nie zostały zastosowane.");
													echo '
													<script>window.location.replace("?page=3");</script>
													';
												}
												
												} else {
												
												$pnlpart = 'SELECT * FROM partnerzy ORDER BY Id DESC';
												$wyswietl = mysqli_query($db,$pnlpart);
												
												echo "<table id=\"tab\" style=\"border:1px solid black;padding:20px;margin:30px;\"><tr><th style=\"border-style:none\"></th><th>Id</th><th>Nazwa</th><th>Strona</th><th>Zdjęcie</th></tr>";
												
												if (mysqli_num_rows($wyswietl)) {
													while($wsw = mysqli_fetch_assoc($wyswietl)) {
														echo '<tr><td><a href="?page=3&edit=' . $wsw['Id'] .'">Edytuj</a><a href="?page=3&del='. $wsw['Id'] .'">Usuń</a></td><td>' . $wsw["Id"] . '</td><td>' . $wsw["Nazwa"] . '</td><td>' . $wsw["Strona"] . '</td><td>' . $wsw["Zdjecie"] . '</td><br>';
													}
												}
												$del = $_GET['del'];
												if($del > -1 && $del !== '' && !empty($del)){
													$usun = 'DELETE FROM partnerzy WHERE Id=' . $del;
													mysqli_query($db,$usun) or die ("Usuwanie nie przebiegło pomyślnie, spróbuj ponownie");
													echo '
													<script>window.location.replace("?page=3");</script>
													';
												}
												echo '</table>';
											}
											} else if ($page == 3.1) {
										?>
										<form method="POST">
											<button name="dodajprt">Dodaj</button><br><br>Nazwa<br>
											<textarea name="dodajnazwa" style="width:250px;padding:8px;" placeholder="Nazwa"></textarea>
											<br><br>Strona<br>
											<textarea name="dodajstrona" style="width:250px;padding:8px;" placeholder="Strona"></textarea>
											<br><br>Zdjęcie<br>
											<textarea name="dodajzdjecie" style="width:500px;color:black;padding:8px;" placeholder="Zdjęcie"></textarea>
										</form>
										
										<?php
											
											if(ISSET($_POST['dodajprt']))
											{
												
												$newnazwa = $_POST['dodajnazwa'];
												$newstrona = $_POST['dodajstrona'];
												$newzdjecie = $_POST['dodajzdjecie'];
												$partnerwsadz = "INSERT INTO `partnerzy`(`Nazwa`, `Strona`, `Zdjecie`) VALUES ('" . htmlspecialchars($newnazwa, ENT_QUOTES, "UTF-8") . "','" . htmlspecialchars($newstrona, ENT_QUOTES, "UTF-8") ."','" . htmlspecialchars($newzdjecie, ENT_QUOTES, "UTF-8") ."')";
												mysqli_query($db,$partnerwsadz) or die ("Wystąpił problem z publikacją partnera, spróbuj ponownie");
												
												echo '
												<script>window.location.replace("?page=3");</script>
												';
											}
											} else if ($page == 4.1){
											$info = "SELECT Informacja FROM o_druzynie WHERE Id=0";
											$daj_info = mysqli_query($db,$info);
											
											echo 'Ogólne informacje o drużynie<br>';
											echo '<form method="POST"><table><tr><th style="text-align:center;"><button name="save">Zapisz</button></th></tr>
											<tr><th>';
											if (mysqli_num_rows($daj_info)) {
												// output data of each row
												while($row = mysqli_fetch_assoc($daj_info)) {
													echo '<textarea style="width:600px;height:400px;" name="infogol">' . $row['Informacja'] . '</textarea>';
												}
											}
											
											echo '</th></tr></table></form>';
											
											if(ISSET($_POST['save'])){
												$info_o_drz = $_POST['infogol'];
												$zap_upd = "UPDATE o_druzynie SET Informacja='" . htmlspecialchars($info_o_drz, ENT_QUOTES, "UTF-8") . "' WHERE Id=0";
												$zap_upd_query = mysqli_query($db,$zap_upd);
												echo '
												<script>window.location.replace("?page=4.1");</script>
												';
											}
											
											} else if ($page == 4.2){
											echo 'Informacje główne';
											} else if ($page == 4.3){
											echo 'Część techniczna';
											} else {
											echo 'Wybierz jedną z zakładek';
										}
										
										
										
									?>
								</center>
							</div>
							
							<?php
							}
						?>
					</div>
					
					
					
				</body>
			</html>
				