<?php
include_once dirname(__DIR__) . '/inc/inc.functions.php'; //inclusion du fichier des fonctions + Coorection du chemin avec dirname(__DIR__)+ ajout de include_once pour éviter les inclusions répétées comme 


// Récuperer l'id de l'article depuis l'URL
	$idArticle = array_key_exists('id', $_GET) ? $_GET['id'] : null;

	// Récuperer l'article correspndant à l'id depuis la fonction getArticleById
	$article = getArticleById($idArticle);

	// Si l'article n'existe pas, on redirige vers la page d'accueil
	if(is_null($article) || empty($article)){
		header('Location:index.php');
	}
?>	
<section class="banner style1 orient-left content-align-left image-position-right fullscreen onload-image-fade-in onload-content-fade-right">
	<div class="content">
		<h1><?php echo $article['titre'];?></h1>
		<p class="major"><?php echo $article['texte'];?></p>
		<ul class="actions stacked">
			<li><a href="index.php" class="button big wide smooth-scroll-middle">Revenir à l'accueil</a></li>
		</ul>
	</div>
	<div class="image">
		<img src="<?php echo $article['image'];?>" alt="" /> // correction de article
	</div>
</section>