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
<title>Guillaume Martinhac - Développeur Web</title>

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
					<h2>Développeur Web</h2>
					<h4>    
					<?php 
					    function age($annee_naissance, $mois_naissance, $jour_naissance, $timestamp) {

					    $age = date('Y', $timestamp) - $annee_naissance;
					    return ($mois_naissance > date('n', $timestamp) || ( $mois_naissance == date('n', $timestamp) && $jour_naissance > date('j', $timestamp))) ? $age-1 : $age;
					    }
					    echo '<div class="etatcivil"><span>'.age(1979, 9, 3, $timestamp = time()).' ans - 2 enfants - Pacsé</span></div>';
					    echo '<br><a href="index.php"> English version / Version anglaise</a>'
				    ?>
				    </h4>
				    <noscript style="color:red">Merci d'activer Javascript sur votre navigateur pour profiter des éléments présents sur mon CV.</noscript>
				</hgroup>
<!-- 
				<figure>
					<img src="GM_files/avatar.jpg" alt="Guillaume Martinhac">
				</figure> -->
		</div>
	</header>
	
	<!-- Contact -->
	<section class="contactform clearfix">
		<div class="container_16">
			<h3>Contactez-moi</h3>
			<p>Merci de remplir le formulaire ci-dessous afin de m'envoyer un message. Je vous répondrai dans les plus brefs délais.
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

                        $headers = 'From: noreply@localhost' . PHP_EOL;
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
	                <label class="required" for="txt-destFrmAlt">Votre email*</label>
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
	                <label class="required" for="txt-objetFrmAlt">Objet* (max. 50 caractères)</label>
	                <input id="txt-objetFrmAlt" maxlength="50" name="objet" required="required" type="text" value="<?php if( isset( $_POST['objet'] ) && array_key_exists( 'submitFrmAlt', $_POST ) ) { echo htmlentities( $_POST['objet'] ); } ?>" />
	            </span>
	            <span class="text-quote">(*) Champs requis</span>
            </p>
            <p class="grid_10">
	            <span data-role="wrapper">
	                <label for="txt-msgFrmAlt">Corps du message*</label>
	                <textarea id="txt-msgFrmAlt" name="message" rows="20"><?php if( isset( $_POST['message'] ) && array_key_exists( 'submitFrmAlt', $_POST ) ) { echo htmlentities( $_POST['message'] ); } ?></textarea>
	            </span>
            </p>
            <br />
            
            <br /><input data-role="submit" name="submitFrmAlt" type="submit" value="Envoyer le message" />
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
				<h3>A propos</h3>
				<p>Opini&acirc;tre, efficace et organis&eacute;, je suis actuellement à la recherche d'un poste en tant que d&eacute;veloppeur back-end. D'un naturel &eacute;nergique, capable de travailler en &eacute;quipe, j'ai fait preuve d'une approche rationnelle quant aux t&acirc;ches qui me sont confi&eacute;es, et sais r&eacute;pondre à toutes les situations. </p>
			</div>
			
			<!-- Compétences -->
			<div class="grid_8 competences">
				<h3>Compétences</h3>
				<ul class="barres">
					<li data-skills="50">HTML<span style="width: 0%;"></span></li>
					<li data-skills="30">CSS<span style="width: 0%;"></span></li>
					<li data-skills="45">PHP<span style="width: 0%;"></span></li>
					<li data-skills="20">SQL<span style="width: 0%;"></span></li>
					<li data-skills="15">JavaScript<span style="width: 0%;"></span></li>
				</ul>
			</div>
		</div>
		
			<!-- Expériences -->
			<div class="grid_16 experiences">
				<h3>Expériences</h3>
				<ul>
					<li>
						<h4><strong>Product manager/ Chef de produit</strong> chez Expansys Europe</h4>
						<span class="lieu">Montpellier</span>
						<span class="dates">2010 - 2016</span>
						<p>Achats des produits mis au catalogue, mise en ligne, SEO et référencement sur les marketplaces, support des équipes B2B et B2C, suivi logistique et comptable, gestion des litiges - Vente en ligne de produits high-tech.</p>
					</li>
					<li>
						<h4><strong>Vendeur</strong> chez Little Extra</h4>
						<span class="lieu">Montpellier</span>
						<span class="dates">2009 - 2010</span>
						<p>Vente, réception commandes, mise en rayon, inventaires et régulations de stocks, encaissements, ouvertures et fermetures du magasin - Vente de produits de décoration et d'équipement de la maison.
</p>
					</li>
					<li>
						<h4><strong>Responsable magasin</strong> chez Charlie Vidéo</h4>
						<span class="lieu">Montpellier</span>
						<span class="dates">2008 - 2009</span>
						<p>Location de films, conseil et fidélisation clients, mise en rayon, encaissements, fermetures quotidiennes - Vidéoclub.</p>
					</li>
					<li>
						<h4><strong>Fondateur/ Dirigeant</strong> de la Galerie virtuelle Aparté</h4>
						<span class="lieu">Montpellier</span>
						<span class="dates">2006 - 2008</span>
						<p>Développement commercial et informatique du site galerieaparte.com - Vente en ligne d’oeuvres de jeunes créateurs et d’artistes confirmés et organisation d’expositions dans les locaux d’entreprises partenaires - Galerie virtuelle d'art contemporain.</p>
					</li>
				</ul>
			</div>
		
			<!-- Formations -->
			<div class="grid_16 formations">
				<h3>Formations</h3>
				<ul>
					<li>
						<h4><strong>Développeur-Administrateur de sites Web / Titre de niveau 2 </strong> au centre de formation Objectif3W</h4>
						<span class="lieu">Montpellier</span>
						<span class="dates">2016 - 2017</span>
					</li>
					<li>
						<h4><strong>Langue et Littérature des Civilisations Etrangères / Licence d'Anglais</strong> à l'université Paul Valéry/ Montpellier 3</h4>
						<span class="lieu">Montpellier</span>
						<span class="dates">2004 - 2005</span>
					</li>
				</ul>
			</div>
		
			<!-- Loisirs -->
			<div class="grid_8 divers">
				<h3>Divers</h3>
				<p>Titulaire du permis B, véhicule personnel.</p>
				<p>Pratique des sports de glisse, cyclisme.</p>
				
			</div>
		
			<!-- Contact -->
			<div class="grid_8 contact">
				<h3>Contact</h3>
				<p>Si mon profil vous intéresse, n'hésitez pas à me contacter :</p>
				<ul>
					<li class="lieu">Baillargues, France</li>
					<li class="phone">06 45 15 46 59</li>
					<li class="mail"><a href="mailto:mon.adresse@email.fr">mon.adresse@email.fr</a></li>
					<!-- <li class="site"><a href="http://www.mon-site.fr/">www.mon-site.fr</a></li> -->
					<li class="form"><a class="toContactform">via le formulaire de contact</a></li>
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