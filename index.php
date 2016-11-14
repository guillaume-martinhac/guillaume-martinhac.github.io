<!DOCTYPE html>
<html lang="fr"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="apple-touch-icon" sizes="180x180" href="favicons//apple-touch-icon.png">
<link rel="icon" type="image/png" href="favicons//favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="favicons//favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="favicons//manifest.json">
<link rel="mask-icon" href="favicons//safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">
<title>Guillaume Martinhac - Web developper</title>

<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Fichiers CSS -->
<link rel="stylesheet" href="GM_files/reset.css">
<!--[if lt IE 9]> 
	<link rel="stylesheet" href="css/cv.css" media="screen">
<![endif]-->
<link rel="stylesheet" media="screen and (max-width:480px)" href="GM_files/mobile.css">
<link rel="stylesheet" media="screen and (min-width:481px)" href="GM_files/cv.css">
<link rel="stylesheet" media="print" href="GM_files/print.css">

</head>

<body>

	<!-- Header -->
	<header role="banner">
		<div class="container_16">
				<hgroup>
					<h1>Guillaume Martinhac</h1>
					<h2>Web developper</h2>
<!-- 					<h4>    
					<?php 
					    function age($annee_naissance, $mois_naissance, $jour_naissance, $timestamp) {

					    $age = date('Y', $timestamp) - $annee_naissance;
					    return ($mois_naissance > date('n', $timestamp) || ( $mois_naissance == date('n', $timestamp) && $jour_naissance > date('j', $timestamp))) ? $age-1 : $age;
					    }
					    echo '<div class="etatcivil"><span>'.age(1979, 9, 3, $timestamp = time()).' years old</span></div>';
				    ?>
				    </h4> -->
				   	<?php echo '<br><h4><a href="indexfr.php"> French version / version française</a></h4>' ?>
				   	<noscript style="color:red">Please make sure that javascript is turned on to enable all features on my resume.</noscript>
				</hgroup>

<!-- 				<figure>
					<img src="GM_files/avatar.jpg" alt="Guillaume Martinhac">
				</figure> -->
		</div>
	</header>
	
	<!-- Contact -->
	<section class="contactform clearfix">
		<div class="container_16">
			<h3>Contact me</h3>
			<p>Please make sure that you fill in all the fields below. I will reply in a timely manner.
			<br></p>
			        <?php
        if( isset( $_POST ) && !empty( $_POST ) && array_key_exists( 'submitFrmAlt', $_POST ) ) :
            $_err = array();
            if( ( isset( $_POST['1'] ) && $_POST['1']=='' ) || ( isset( $_POST['2'] ) && $_POST['2']=='Ne pas remplir' ) ) :
                if( isset( $_POST['emetteur'] ) && $_POST['emetteur']!='' ) :
                    if( isset( $_POST['objet'] ) && $_POST['objet']!='' ) :
                        $contenuTxt = 'Vous avez reçu un message depuis votre formulaire le ' . date( 'd/m/Y' ) . ' à ' . date( 'H:i:s' ) . PHP_EOL . '------------------------------------------------------------------' . PHP_EOL . PHP_EOL . 'Objet : ' . htmlentities( $_POST['objet'] ) . PHP_EOL . htmlentities( $_POST['message'] );
                        $contenuHtml = '<html><head></head><body><table style="width:100%;"><tr><td colspan="2">Vous avez reçu un message depuis votre formulaire le ' . date( 'd/m/Y' ) . ' à ' . date( 'H:i:s' ) . '<br /><hr /><br /></td></tr><tr><td width="50"><strong>Objet</strong></td><td>' . htmlentities( $_POST['objet'] ) . '<br /></td></tr><tr><td colspan="2">' . nl2br( $_POST['message'] ) . '</td></tr></table></body></html>';
                        
                        $boundary = '-----=' . md5( uniqid( microtime(), TRUE ) );

                        $headers = 'From:'. $_POST['emetteur'] . PHP_EOL;
                        $headers .= 'MIME-Version: 1.0' . PHP_EOL;
                        $headers .= 'Priority: normal' . PHP_EOL;
                        $headers .= 'Reply-To: '. $_POST['emetteur'] . PHP_EOL;
                        // $headers .= 'X-Confirm-Reading-To: contact@localhost' . PHP_EOL;
                        $headers .= 'X-Mailer: PHP/' . phpversion() . PHP_EOL;
                        $headers .= 'X-Priority: 3' . PHP_EOL;
                        if( isset( $_POST['cc'] ) && $_POST['cc']!='' ) :
                            $headers .= 'Cc: ' . $_POST['cc'] . PHP_EOL;
                        endif;
                        if( isset( $_POST['cci'] ) && $_POST['cci']!='' ) :
                            $headers .= 'Bcc: ' . $_POST['cci'] . PHP_EOL;
                        endif;
                        $headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"" . PHP_EOL;

                        $message = PHP_EOL . '--' . $boundary . PHP_EOL;
                            $message .= 'Content-Type: text/html; charset=utf-8' . PHP_EOL;
                            $message .= 'Content-Transfer-Encoding: 8bit' . PHP_EOL;
                            $message .= PHP_EOL . $contenuHtml . PHP_EOL;
                        $message .= PHP_EOL . '--' . $boundary . '--' . PHP_EOL;
                            $message .= 'Content-Type: text/plain; charset=utf-8' . PHP_EOL;
                            $message .= 'Content-Transfer-Encoding: quoted-printable' . PHP_EOL;
                            $message .= PHP_EOL . $contenuTxt . PHP_EOL;
                        $message .= PHP_EOL . '--' . $boundary . '--' . PHP_EOL;
                        $message .= PHP_EOL . '--' . $boundary . '--' . PHP_EOL;

                        if( mail( $_POST['emetteur'], htmlentities( $_POST['objet'] ), $message, $headers ) ) :
                            $_err = array( 'code'=>'done', 'msg'=>array( '<span class="titre-action">Message envoyé !</span><br />L\'envoi de votre message s\'est déroulé correctement.<br />Merci pour votre intérêt.' ) );
                        else :
                            $_err['code'] = 'error';
                            $_err['msg'][] = '<span class="titre-action">Échec de l\'envoi !</span><br />Veuillez nous excuser pour ce désagrément.';
                        endif;
                    else :
                        $_err['code'] = 'incomplete';
                        $_err['msg'][] = '<span class="titre-action">Envoi interrompu !</span><br />Veuillez préciser l\'objet du message.';
                    endif;
                else :
                    $_err['code'] = 'incomplete';
                    $_err['msg'][] = '<span class="titre-action">Envoi interrompu !</span><br />Veuillez préciser votre adresse mail.';
                endif;
            else :
                $_err = array( 'code'=>'spam', 'msg'=>array( '<span class="titre-action">Envoi interrompu !</span><br />Vous avez été identifié en tant que spam ! Votre message n\'a donc pas été envoyé.<br />Nous vous présentons nos excuses si votre message ne devait pas être considéré comme tel.' ) ); // On renseigne le code et le message de retour.
            endif;

            if( isset( $_err ) && array_key_exists( 'code', $_err ) ) :
                if( array_key_exists( 'msg', $_err ) ) :
                    foreach( $_err['msg'] as $value ) :
                        echo $value;
                    endforeach;
                endif;
            endif;
        endif;
        ?>
        <form action="#html" class="grid_16" data-role="formulaire" method="post" name="frmContactAlt">
            <p class="grid_6">
	            <span data-role="wrapper">
	                <label class="required" for="txt-destFrmAlt">Your email*</label>
	                <input id="txt-destFrmAlt" name="emetteur" required="required" type="email" value="<?php if( isset( $_POST['emetteur'] ) && array_key_exists( 'submitFrmAlt', $_POST ) ) { echo htmlentities( $_POST['emetteur'] ); } ?>" />
	            </span>
	<!--             <span data-role="wrapper">
	                <label for="txt-ccFrmAlt">emetteurs en copie (séparés par des virgules en respectant le formatage de la norme RFC 2822)</label>
	                <input id="txt-ccFrmAlt" name="cc" type="text" value="<?php if( isset( $_POST['cc'] ) && array_key_exists( 'submitFrmAlt', $_POST ) ) { echo htmlentities( $_POST['cc'] ); } ?>" />
	            </span> -->
	<!--             <span data-role="wrapper">
	                <label for="txt-cciFrmAlt">emetteurs en copie cachée invisible (séparés par des virgules en respectant le formatage de la norme RFC 2822)</label>
	                <input id="txt-cciFrmAlt" name="cci" type="text" value="<?php if( isset( $_POST['cci'] ) && array_key_exists( 'submitFrmAlt', $_POST ) ) { echo htmlentities( $_POST['cci'] ); } ?>" />
	            </span> -->
	            <span data-role="wrapper">
	                <label class="required" for="txt-objetFrmAlt">Subject* (50 characters max)</label>
	                <input id="txt-objetFrmAlt" maxlength="50" name="objet" required="required" type="text" value="<?php if( isset( $_POST['objet'] ) && array_key_exists( 'submitFrmAlt', $_POST ) ) { echo htmlentities( $_POST['objet'] ); } ?>" />
	            </span>
	            <span class="text-quote">(*) Required fields</span>
            </p>
            <p class="grid_10">
	            <span data-role="wrapper">
	                <label for="txt-msgFrmAlt">Your message*</label>
	                <textarea id="txt-msgFrmAlt" name="message" rows="20"><?php if( isset( $_POST['message'] ) && array_key_exists( 'submitFrmAlt', $_POST ) ) { echo htmlentities( $_POST['message'] ); } ?></textarea>
	            </span>
            </p>
            <br />
            
            <br /><input data-role="submit" name="submitFrmAlt" type="submit" value="Send" />
            <input name="1" type="hidden" value="" /><input name="2" style="display:none;" type="text" value="Ne pas remplir" />
        </form>
<!-- 			<?php 
					/*include('contact.php');*/

				?> -->
<!-- 			<form novalidate="novalidate" method="post" action="#" name="contact" class="grid_16">
				<p class="grid_10"><textarea name="message" placeholder="Votre message" class="required"></textarea></p>
				<p class="grid_6">
					<input name="nom" placeholder="Nom - Prénom" class="required" type="text">
					<input name="email" placeholder="Adresse email" class="required" type="email">	
					<input name="envoi" value="Envoyer le message" class="required" type="submit">
					<span class="messageform"></span>
				</p>
			</form> -->
		</div>
	</section>
	
	<!-- Corps -->
	<section role="main" class="container_16 clearfix">
		<div class="grid_16">
			<!-- A propos -->
			<div class="grid_8 apropos">
				<h3>About me</h3>
				<p>Hard-working, efficient and proactive. I'm currently looking for an position as a back-end developper. I am an energetic person, excellent in working with others, who has developed a responsible approach to any task that I undertake, or situation I am presented with.</p>
			</div>
			
			<!-- Compétences -->
			<div class="grid_8 competences">
				<h3>Technical knowledge</h3>
				<ul class="barres">
					<li data-skills="50">HTML<span style="width: 1%;"></span></li>
					<li data-skills="25">CSS<span style="width: 1%;"></span></li>
					<li data-skills="30">PHP<span style="width: 1%;"></span></li>
					<li data-skills="20">SQL<span style="width: 1%;"></span></li>
					<li data-skills="10">JavaScript<span style="width: 1%;"></span></li>
				</ul>
			</div>
		</div>
		
			<!-- Expériences -->
			<div class="grid_16 experiences">
				<h3>Career history</h3>
				<ul>
					<li>
						<h4><strong>Product manager - Smartphones category</strong> / Expansys Europe</h4>
						<span class="lieu">Montpellier</span>
						<span class="dates">2013 - 2016</span>
						<p>Purchasing, online listings creation, B2B and B2C teams support(both technical and commercial), handling transportation issues and financial disputes.</p>
					</li>
					<li>
						<h4><strong>Marketplaces sales assistant</strong> / Expansys Europe</h4>
						<span class="lieu">Montpellier</span>
						<span class="dates">2010 - 2013</span>
						<p>Listing goods on partners' websites, customer communication management.</p>
					</li>
					<li>
						<h4><strong>Store clerk</strong> / Little Extra (Home furnitures and decoration)</h4>
						<span class="lieu">Montpellier</span>
						<span class="dates">2009 - 2010</span>
						<p>Sales, deliveries management, stocktakes and stock management, payment collection.</p>
					</li>
				</ul>
			</div>
		
			<!-- Formations -->
			<div class="grid_16 formations">
				<h3>Education</h3>
				<ul>
					<li>
						<h4><strong>Web developper / Level 2 professional title</strong> Objectif 3W</h4>
						<span class="lieu">Montpellier</span>
						<span class="dates">2016 - 2017</span>
					</li>
					<li>
						<h4><strong>Langue et Littérature des Civilisations Etrangères / Bachelor's degree</strong> Paul Valéry university</h4>
						<span class="lieu">Montpellier</span>
						<span class="dates">2004 - 2005</span>
					</li>
				</ul>
			</div>
		
			<!-- Loisirs -->
<!-- 			<div class="grid_8 divers">
				<h3>Divers</h3>
				<p>Titulaire du permis B, véhicule personnel.</p>
				<p>Pratique des sports de glisse, cyclisme.</p>
				
			</div> -->
		
			<!-- Contact -->
			<div class="grid_16 contact">
				<h3>Contact me</h3>
<!-- 				<p>Si mon profil vous intéresse, n'hésitez pas à me contacter :</p> -->
				<ul>
					<li class="lieu">7, impasse du verger d'Eole, 34670 Baillargues, France</li>
					<li class="phone">+33 6 45 15 46 59</li>
					<li class="form"><a class="toContactform">Use the contact form</a></li>
					<!-- <li class="site"><a href="http://www.mon-site.fr/">www.mon-site.fr</a></li> -->
<!-- 					<li class="form"><a class="toContactform">via le formulaire de contact</a></li> -->
				</ul>
			</div>
	</section>

<!-- Scripts JavaScript -->
<script src="GM_files/jquery-1.js"></script>
<script src="GM_files/validate.js"></script>
<!--[if lt IE 9]>
<script src="scripts/placeholder.js"></script>
<![endif]-->
<script src="GM_files/plugins.js"></script>

</body></html>
