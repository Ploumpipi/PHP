<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Valide</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../images/.png"/>
		<link rel="stylesheet" type="text/css" href="../css/valide.css">
	</head>
	<body>
		<a href="../index.php"><< Retour index</a><br>
		<a href="./login2.php"><< Retour connexion</a>
		<?php
			define('USER',"root");
			define('PASSWD',"");
			define('SERVER',"localhost");
			define('BASE',"intranet");

			function connect_bd(){
				$dsn="mysql:dbname=".BASE.";host=".SERVER;
				try{
					$connexion=new PDO($dsn,USER,PASSWD);
				}
				catch(PDOException $e){
					printf("Echec de la connexion : %s\n", $e->getMessage());
					exit();
				}
				$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $connexion;
			}
			$connexion=connect_bd();
		?>

		<!-- LOGGED -->
		<div id="logged" class="panel">
			<h1>Hello [username] !</h1>
			<a href="./Logout.php">Logout -></a>
		</div>

		<!-- NOT LOGGED -->
		<div id="notLogged" class="panel">
			<h1>You are not logged !</h1>
			<a href="./Login2.php">Login -></a>
		</div>

		<script type="text/javascript">
			var logged = document.getElementById("logged");
			var notLogged = document.getElementById("notLogged");

			// --- IF LOGGED ---
			if (localStorage.login == "admin" && localStorage.password == "1234"){
				logged.style.display = "none";
				notLogged.style.display = "none";
			}else{
				logged.style.display = "none";
				notLogged.style.display = "none";
			}
		</script>

		<div>
            <form action="" method="post">
				<label for="std">Qui êtes vous ? </label>
				<input type="text" id="std" name="std">
				<input type="submit">
			</form>
			<?php
				if($_POST['std']){
					$notes="SELECT * FROM Utilisateurs, listenote WHERE Pseudo='$_POST[std]' and id_utilisateur=id_etudiant";
					$sql="SELECT * FROM listeNote";
					$req=$connexion->query($sql);
					$nb=$req->rowCount();
					$moyenne="SELECT id_etudiant, AVG(valeur) as moyenne
								FROM listeNote
								group by id_etudiant
								WHERE id_etudiant=$_POST[std]";
					//var_dump($connexion->query($notes));
					if($nb==0){
						echo'<tr>';
						echo ('<td>---NO DATA FOUND---</td>');
						echo'</tr>';
					}
					if(!empty($_POST)){
						echo '<table>';
						echo '<tr><td>Matière</td><td>Notes</td></tr>';
						foreach($connexion->query($notes) as $row){
							echo '<tr>';
							echo '<td>'.$row['matiere_test'].'</td>';
							echo '<td>'.$row['valeur'].' </td>';
							echo '</tr>';
						}
						/*echo '<tfoot>';
						echo '<td>Moyenne</td><td>'.$moyenne['moyenne'].'</td>';
						echo '</tfoot>';*/
	
					}                    
				}else{
					$notes="SELECT * FROM listeNote, Utilisateurs where id_etudiant=id_utilisateur";
					//echo 'id_etudiant, matière, notes <br>';
					echo '<table>';
					echo '<tr><td>Étudiant</td><td>Pseudo</td><td>Matière</td><td>Notes</td></tr>';
					foreach($connexion->query($notes) as $row){
						echo '<tr>';
						echo '<td>'.$row['id_etudiant'].'</td>';
						echo '<td>'.$row['Pseudo'].'</td>';
						echo '<td>'.$row['matiere_test'].'</td>';
						echo '<td>'.$row['valeur'].' </td>';
						echo '</tr>';
					}
					echo '</table>';
				}
				
            ?>
		</div>

		<?php
			session_start();

			/*echo "
				<script>
					myStorage = localStorage;

					console.log(myStorage.login);
					if (myStorage.login != undefined){
						var title = document.createElement('h1');
						var titleText = document.createTextNode('Hello ' + myStorage.login + ' !');
						title.appendChild(titleText);
						document.body.appendChild(title);
					}else{
						var title = document.createElement('h1');
						var link = document.createElement('a');
						link.setAttribute('href', './TD_Login.php');
						var titleText = document.createTextNode('Your are not logged !');
						var linkText = document.createTextNode('Login ->');
						title.appendChild(titleText);
						link.appendChild(linkText);
						document.body.appendChild(title);
						document.body.appendChild(link);
					}
				</script>
			";*/
		?>
	</body>
</html>