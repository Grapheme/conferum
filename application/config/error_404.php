<?php $config =&get_config();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Page Not Found :(</title>
	<style>
	body { margin: 0; padding: 0; border-top: 9px solid #5464A7; text-align: center; height: 100%; }
	h1 { margin:0; padding: 0; font-size: 16.6875em; color: #31ab87; font-family: sans-serif; background: url(<?=$config['base_url'];?>img/shadow_404.png) no-repeat bottom; text-align: center; }
	.raccoon-to-main { position: absolute; top: 5%; left: 5%; display: block; width: 123px; height: 132px; background: url(<?=$config['base_url'];?>img/logo.png) no-repeat center center;}
	p { font-size: 2em; color: #4d4d4d; text-align: center; }
	.back-to-main { text-decoration: none; display:inline-block; margin: 0 auto; padding: .25em 1em .35em; border: 1px solid #0f9e74; border-radius: 2px; background-color: #5bbfa1; color: #fff; text-shadow: 1px 1px 0px #53ac92; filter: dropshadow(color=#53ac92, offx=1, offy=1); }
	.container { position: fixed; top:15%; left: 50%; margin-left: -225px; }
	</style>
</head>
<body>
	<a class="raccoon-to-main" href="#"></a>
	<div class="container">
		<h1>404</h1>
		<p>Страница не найдена или не существует</p>
		<a class="back-to-main" href="<?=$config['base_url'];?>">На главную</a>
	</div>
	<script>	
		window.location.href="<?=$config['base_url'];?>";
	</script>	
</body>
</html>
