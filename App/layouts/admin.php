<!DOCTYPE html>
<html>
<head>
	<title></title>
  <link rel="stylesheet" type="text/css" href="<?= Router::webroot('css/materialize/materialize.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= Router::webroot('css/master2017.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?= Router::webroot('css/font-awesome.min.css'); ?>">
  <script type="text/javascript" src="<?= Router::webroot('js/jquery-3.1.1.min.js'); ?>"></script>
  <script defer type="text/javascript" src="<?= Router::webroot('js/materialize/materialize.min.js'); ?>"></script>
  <style type="text/css">
    .home-parallax{
      height: 300px;
    }
  </style>
</head>
<body>
<div class="site-container">
  <header class="header">
    <a href="" class="header__icon" id="header__icon"></a>
    <a href="" class="header__logo">Administration <?= WEBSITE_NAME; ?>  </a>
    <ul class="navbar-right">
      <li><a href="" ><i class="fa fa-dashboard"></i> Tableau de Bord</a></li>
      <li> <a href="" ><i class="fa fa-user"></i></a></li>
      <li> <a href="" ><i class="fa fa-users"></i></a></li>
      <li> <a href="" ><i class="fa fa-cloud"></i></a></li>
      <li> <a href="" ><i class="fa fa-phone"></i></a></li>
      <li> <a href="" ><i class="fa fa-newspaper-o"></i></a></li>
      <li> <a href="" ><i class="fa fa-modx"></i></a></li>
      <li><a href=""> <img src="" alt=""></a></li>
    </ul>  
  </header>
<div class="site-content">
<?= $content_for_layout;  ?>
    
</div>

<!-- AUTRE COMPTENUE DU SITE -->

<script type="text/javascript">
jQuery(document).ready(function($){
  $('.parallax').parallax();
})

</script>
</body>
</html>