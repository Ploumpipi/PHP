<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Login</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../images/.png"/>
		<link rel="stylesheet" type="text/css" href="../css/login2.css">
	</head>
	<body>

		<?php
			session_start();

			/*if (sizeof($_POST) != 0){
				$login = $_POST["login"];
				$password = $_POST["password"];

				if ($login == "admin" && $password == "1234")
					header("Location:valide.php");
				else
					header("location:login2.php?erreur=1");
			}*/
		?>

		<a href="../index.php"><< Retour index</a>

		<!-- LOGIN FORM -->
		<div id="loginPanel">
			<form id="loginForm" method="post">
				<h1>Login</h1>

				<label for="password">Pseudo</label>
				<input type="text" id="login" name="login" required>
				<label for="password">Mot de passe</label>
				<input type="text" id="password" name="password" required disabled>
				<!--<input type="text" id="fakePassword" name="fakePassword" disabled>-->

				<input type="submit" name="submit" id="submit" value="Submit" onclick="Auth()">
				<input type="reset" name="reset" id="reset" value="Reset"><br><br>
				<div onclick="creaCompte()">
					Pas de compte? Créez-en un
				</div>

				<div id="numberPanel">
					<div class="numberRow">
						<div id="number1" class="numberButton" onclick="PushNumber('number1')"></div>
						<div id="number2" class="numberButton" onclick="PushNumber('number2')"></div>
						<div id="number3" class="numberButton" onclick="PushNumber('number3')"></div>
						<div id="number4" class="numberButton" onclick="PushNumber('number4')"></div>
						<div id="number5" class="numberButton" onclick="PushNumber('number5')"></div>
					</div>
					<div class="numberRow">
						<div id="number6" class="numberButton" onclick="PushNumber('number6')"></div>
						<div id="number7" class="numberButton" onclick="PushNumber('number7')"></div>
						<div id="number8" class="numberButton" onclick="PushNumber('number8')"></div>
						<div id="number9" class="numberButton" onclick="PushNumber('number9')"></div>
						<div id="number0" class="numberButton" onclick="PushNumber('number0')"></div>
					</div>
				</div>
			</form>
			<form id="creationCompte" method="post">
				<h1>Création de compte</h1>

				<label for="Nom">Nom</label>
				<input type="text" id="Nom" name="Nom" required><br>
				<label for="Prénom">Prénom</label>
				<input type="text" id="Prénom" name="Prénom" required><br>
				<label for="Pseudo">Pseudo</label>
				<input type="text" id="Pseudo" name="Pseudo" required><br>
				<label for="rang">Vous êtes : </label>
				<select name="rang" id="rang">
					<option value="prof">Professeur</option>
					<option value="etudiant">Étudiant</option>
				</select><br>
				<label for="mdp">Veuillez saisir un mot de passe avec le pavé </label><br>
				<input type="text" id="mdp" name="mdp" required disabled><br>

				<div id="numberPanel">
					<div class="numberRow">
						<div id="number1" class="numberButton2" onclick="PushNumber2('number1')"></div>
						<div id="number2" class="numberButton2" onclick="PushNumber2('number2')"></div>
						<div id="number3" class="numberButton2" onclick="PushNumber2('number3')"></div>
						<div id="number4" class="numberButton2" onclick="PushNumber2('number4')"></div>
						<div id="number5" class="numberButton2" onclick="PushNumber2('number5')"></div>
					</div>
					<div class="numberRow">
						<div id="number6" class="numberButton2" onclick="PushNumber2('number6')"></div>
						<div id="number7" class="numberButton2" onclick="PushNumber2('number7')"></div>
						<div id="number8" class="numberButton2" onclick="PushNumber2('number8')"></div>
						<div id="number9" class="numberButton2" onclick="PushNumber2('number9')"></div>
						<div id="number0" class="numberButton2" onclick="PushNumber2('number0')"></div>
					</div>
				</div>
				<input type="submit" name="" id="" value="Créer son compte">
			</form>
		</div>

		<!-- ALREADY LOGGED -->
		<div id="alreadyLoggedPanel">
			<h1>You are already logged.</h1>
			<a href="./logout.php">Logout -></a><br>
			<a href="./valide.php">Next -></a>
			
		</div>
		

		<script type="text/javascript">
			var loginPanel = document.getElementById("loginPanel");
			var alreadyLoggedPanel = document.getElementById("alreadyLoggedPanel");

			// --- IF LOGGED ---
			if (localStorage.login == "admin" && localStorage.password == "1234"){
				loginPanel.style.display = "none";
				alreadyLoggedPanel.style.display = "block";
			}else{
				loginPanel.style.display = "flex";
				alreadyLoggedPanel.style.display = "none";
			}

			var numberList = document.getElementsByClassName("numberButton");
			var numberList2 = document.getElementsByClassName("numberButton2");
			var login = document.getElementById("login");
			var password = document.getElementById("password");
			var fakePassword = document.getElementById("fakePassword");

			// --- FILL BUTTONS ---
			for (var i = 0; i <= 9; i++){
				var nButton = Math.floor(Math.random() * 10); // 0 - 9
				while (numberList[nButton].innerHTML != "")
					var nButton = Math.floor(Math.random() * 10);
				numberList[nButton].innerHTML = i;
			}

			for (var i = 0; i <= 9; i++){
				var nButton = Math.floor(Math.random() * 10); // 0 - 9
				while (numberList2[nButton].innerHTML != "")
					var nButton = Math.floor(Math.random() * 10);
				numberList2[nButton].innerHTML = i;
			}

			// --- PUSH IN PASSWORD ---
			function PushNumber(buttonId){
				var button = document.getElementById(buttonId);

				password.value = password.value + button.innerHTML;
				fakePassword.value = fakePassword.value + button.innerHTML;
			}

			function PushNumber2(buttonId){
				var button = document.getElementById(buttonId);

				mdp.value = mdp.value + button.innerHTML;
				mdpVerif.value = mdpVerif.value + button.innerHTML;
			}

			// --- LOCAL STORAGE ---
			/*function Auth(){
				myStorage = localStorage;
				myStorage.clear();
				myStorage.setItem('login', login.value);
				myStorage.setItem('password', password.value);
			}*/

			function creaCompte(){
				//document.write("Test");
				loginForm.style.display = "none";
				creationCompte.style.display = "block";
				loginPanel.style.height = "600px";
			}
			
		</script>

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

			if($_POST['login'] && $_POST['password']){
				$login = $_POST["login"];
				$password = $_POST["password"];
				$users="SELECT Pseudo, mdp from Utilisateurs where Pseudo='$_POST[login]' and mdp=$_POST[password];";
				var_dump($users);
				var_dump($login);
				var_dump($password);
				foreach($connexion->query($users) as $row){
					var_dump($row['Pseudo']);
					var_dump($row['mdp']);
					if($login == $row['Pseudo'] && $password == $row['mdp']){
						header("location:valide.php");
						
					}else{
						header("location:login2.php?erreur=1");
					}
				}
			
				//header("location:valide.php");
			}
		?>
	</body>
</html>