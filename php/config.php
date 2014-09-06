<?
# * Global constants
define("TTL_HOME", "Steam Game Compare");

# * Scaffold HTML
$SCAFFOLD_HEAD = <<<EOF
<!DOCTYPE html>
<html>
<head>
	<!-- Metadata -->
	<title>Steam Game Compare</title>
	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet/less" type="text/css" href="css/main.less" />
	<!-- Dependencies -->
	<script src="js/less-1.5.0.min.js" type="text/javascript"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
EOF;

$SCAFFOLD_FOOT = <<<HTML
<div class='clear'></div>
		<footer>
			<hr>
			<center>
				<div>Jan.Baykara.co.uk</div>
				<a class="home" href="http://jan.baykara.co.uk">Portfolio</a>&nbsp;&nbsp;&nbsp;
				<a class="home" href="http://jan.baykara.co.uk/blog">Blog</a>&nbsp;&nbsp;&nbsp;
				<a class="twitter" href="https://twitter.com/JanBaykara">@JanBaykara</a>&nbsp;&nbsp;&nbsp;
				<a class="email" href="mailto:jan@baykara.co.uk">Email me</a> 
			</center>
		</footer>
		<!--
		Javascript post-loading
		-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="http://jan.baykara.co.uk/js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
        <script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-47411407-1', 'baykara.co.uk');
		  ga('send', 'pageview');
		</script>
    </body>
</html>
HTML;

define("SCAFFOLD_HEAD", $SCAFFOLD_HEAD);
define("SCAFFOLD_FOOT", $SCAFFOLD_FOOT);
?>