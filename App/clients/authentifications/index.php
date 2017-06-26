<div class="container">
<h2>Page d'authentification</h2>
<div class="row">
<div class="col s12 m6">
<form method="POST" action="" id="managerLogin">
<div class="input-field">
    <input id="email" type="text" class="validate">
    <label for="email">Email</label>
</div>
<div class="input-field">
    <input id="passphrase" type="password" class="validate">
    <label for="passphrase">Mot de passe</label>
</div>
<input type="submit" class="btn" value="Se Connecter">
</form>

<script type="text/javascript">
$(document).ready(function(){
	$('#managerLogin').submit(function(){
		let mail = $('#email').val();
		let pass = $('#passphrase').val();
		if (mail == '') {
			console.log('mail incorrecte')
		}

		if (passphrase == '') {
			console.log('mail incorrecte')
		}
		$.post("<?= Router::url('authentifications/manager') ?>", {email:mail, password:pass}, function(){
			alert('ok')
		})
		return false
	})
})
</script>
</div>
</div>
</div>