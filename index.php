<?php
	session_start();
	
	if (!isset($_SESSION['username'])) {
		header("Location: /php/login.php");
		exit();
	} 

	require_once '/home/site/wwwroot/php/functions.php';
	$_SESSION['scenario1_phase']=getUsersPhases($_SESSION['username'],"1");
	$_SESSION['scenario2_phase']=getUsersPhases($_SESSION['username'],"2");
	$_SESSION['scenario3_phase']=getUsersPhases($_SESSION['username'],"3");
	$_SESSION['scenario4_phase']=getUsersPhases($_SESSION['username'],"4");
	$_SESSION['scenario5_phase']=getUsersPhases($_SESSION['username'],"5");
	
	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Your state of knowledge - Attention! It's serious">
        <link rel="stylesheet" media="screen" href="css/stylesheet.css">
		<link rel="icon" href="/images/malware_icon.png">
    </head>
    <body>
		<div id="div_admin">
			<form>
				<?php
					if ($_SESSION['admin'] == "true") {
						echo '<button id="button_admin" formaction="/php/dbmanagement.php">Admin<br></button>';
					}
				?>
			</form>
		</div>        
        <div id = "div_h1">
            	<h1>Your state of knowledge - Attention! It's serious</h1>
        </div>
	<div id="div_logout">
		<form>
                	<button id="button_logout" formaction="php/logout.php">Abmelden<br></button>
		</form>
	</div>
	<div id = "div_h2">
		<h2>Wähle ein Szenario aus:</h2>
	</div>
        <div id="div_gamescreen">
           	<div id="div_gamescreen_left">
				<form action="/php/frage.php" method="post">
						<input type="hidden"
								name="scenarioid"
								value="3">
								<input type="hidden"
								name="phase"
								<?php
								echo 'value="'.$_SESSION['scenario3_phase']; echo'">';
								?>
					<!--<input type="submit" id="button_firmennetz"
								value="Firmennetz">-->
						<button class ="button_menu" id="button_firmennetz">Firmennetz</button>						
				</form>
				<form action="/php/frage.php" method="post">
						<input type="hidden"
								name="scenarioid"
								value="5">
								<input type="hidden"
								name="phase"
								<?php
								echo 'value="'.$_SESSION['scenario5_phase']; echo'">';
								?>
						<!--<input type="submit" id="button_krypto"
								value="Krypto">-->
						<button class ="button_menu" id="button_krypto" disabled="disabled">Krypto</button>
				</form>
        	</div>
            <div id="div_gamescreen_center">
				<form action="/php/frage.php" method="post">
						<input type="hidden"
								name="scenarioid"
								value="2">
								<input type="hidden"
								name="phase"
								<?php
								echo 'value="'.$_SESSION['scenario2_phase']; echo'">';
								?>
						<!--<input type="submit" id="button_social"
								value="Social Engineering">-->
						<button class ="button_menu" id="button_social">Social Engineering</button>
				</form>
				<div id="div_hacker_menu">
					<img id="img_hacker_menu" src="images/hacker_startmenu.jpeg" alt="hacker">
				</div>
            </div>
            <div id="div_gamescreen_right">
				<form action="/php/frage.php" method="post">
					<input type="hidden"
							name="scenarioid"
							value="4">
							<input type="hidden"
							name="phase"
							<?php
								echo 'value="'.$_SESSION['scenario4_phase']; echo'">';
							?>
					<!--<input type="submit" id="button_banking"
							value="Online Banking">-->
					<button class ="button_menu" id="button_banking" disabled="disabled">Online Banking</button>
				</form>
				<form action="/php/frage.php" method="post">
					<input type="hidden"
							name="scenarioid"
							value="1">
							<input type="hidden"
							name="phase"
							<?php
								echo 'value="'.$_SESSION['scenario1_phase']; echo'">';
							?>
					<!--<input type="submit" id="button_passwort"
							value="Passwort">-->
					<button class ="button_menu" id="button_password">Passwort</button>
				</form>
            </div> 
        </div>
        <div id="div_hinweis">
            	<a id ="hinweis">
                	Hinweis!
                	<br>
                	Dies nur ein Quiz!
            	</a>
        </div>
        <div id ="div_copyright">
            	<a id="copyrigth">
                	&copy Your state of knowledge - Attention! It's serious
            	</a>
		</div>
    </body>
</html> 
