<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?= Router::webroot('css/materialize/materialize.min.css'); ?>">
  <script type="text/javascript" src="<?= Router::webroot('js/jquery-3.1.1.min.js'); ?>"></script>
  <script defer type="text/javascript" src="<?= Router::webroot('js/materialize/materialize.min.js'); ?>"></script>
  <style type="text/css">
    .home-parallax{
      height: 300px;
    }
  </style>
</head>
<body>
<nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="<?= Router::url('pages/index#about'); ?>">Présentation</a></li>
        <li><a href="<?= Router::url('pages/index#services'); ?>">Nos Services</a></li>
        <li><a href="<?= Router::url('pages/index#teams'); ?>">Notre Equipe</a></li>
        <li><a href="<?= Router::url('pages/index#contact'); ?>">Contact</a></li>
        <li><a href="<?= Router::url('posts/index'); ?>">Actualité</a></li>
        <li><a href="<?= Router::url('events/index'); ?>">Evènement</a></li>
        <li><a href="<?= Router::url('medias/phototheque'); ?>">Photothèque</a></li>
      </ul>
    <div class="container">
      <a href="#" class="brand-logo"><?= WEBSITE_NAME; ?></a>
      
      <ul class="side-nav" id="mobile-demo">
        <li><a href="<?= Router::url('pages/index#about'); ?>">Présentation</a></li>
        <li><a href="<?= Router::url('pages/index#services'); ?>">Nos Services</a></li>
        <li><a href="<?= Router::url('pages/index#teams'); ?>">Notre Equipe</a></li>
        <li><a href="<?= Router::url('pages/index#contact'); ?>">Contact</a></li>
        <li><a href="<?= Router::url('posts/index'); ?>">Actualité</a></li>
        <li><a href="<?= Router::url('events/index'); ?>">Evènement</a></li>
        <li><a href="<?= Router::url('medias/phototheque'); ?>">Photothèque</a></li>
      </ul>
    </div>
      
    </div>
  </nav>

<?= $content_for_layout;  ?>

<footer class="page-footer">
<div class="container-fluid">
<div class="row">
  <div class="col s12 m6 l4">
    <form method="post" action="<?= Router::url('newsletters/register')?>">
      <div class="row">
        <div class="col s12">

        </div>
        <div class="col s12">
          
        </div>
      </div>
      
    </form>
  </div>
  <div class="col s12 m6 l4">
  <h5 class="white-text">Dernières actualité</h5>
  <div class="row">
    <div class="col s12">
      <ul class="collection">
      
  </ul>
    </div>
  </div>
  </div>
  <div class="col s12 m6 l4">
    <h5 class="white-text">Réseaux Sociaux</h5>
    <ul>
 
    </ul>
  </div>
</div>
</div>
<div class="footer-copyright">
  <div class="container">
    Fertibio &copy; <?= date('Y'); ?> Copyright  touts droits reservés
    <a class="grey-text text-lighten-4 right" href="<?= Router::url('pages/copyright'); ?>">Politique de confidentialité</a>
  </div>
</div>
</footer>
<script type="text/javascript">
jQuery(document).ready(function($){
  $('.parallax').parallax();
})
</script>
</body>
</html>