<?php
	$drz = "SELECT Zawodnik,Rezerwa FROM druzyna WHERE Rezerwa IS NULL";
						$graczeg = mysqli_query($db,$drz);
						$zmiana = '<br>';
						$zmiana = $zmiana . 'Zawodnicy priorytetowi:<ul>';
						if (mysqli_num_rows($graczeg)) {
							// output data of each row
							while($row = mysqli_fetch_assoc($graczeg)) {
								$zmiana = $zmiana . '<li>'. $row['Zawodnik']  . '</li>';
							}
							} //else & while
							$zmiana = $zmiana . '</ul>';
	$drz = "SELECT Zawodnik,Rezerwa FROM druzyna WHERE Rezerwa IS NOT NULL";
						
						$graczer = mysqli_query($db,$drz);
						$zmiana = $zmiana . 'Zawodnicy rezerwowi:<ul>';
						if (mysqli_num_rows($graczer)) {
							// output data of each row
							while($row = mysqli_fetch_assoc($graczer)) {
								$zmiana = $zmiana . '<li>'. $row['Zawodnik']  . '</li>';
							}
							} //else & while
							$zmiana = $zmiana .  '</ul>';