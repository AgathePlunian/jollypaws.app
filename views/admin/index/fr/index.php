<?php
	require('views/admin/index/fr/sections/write_article.php');

	ob_start();

	$CREATE_ARTICLE_PERM = "CREATE_ARTICLE";

	echo "Hello la team";

	echo "<br>";
	echo "<br>";

	if(in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])){
		echo "<button>Ecrite un article</button>";
	}
?>

<section id='main_section'>

</section>

<script>
	window.onload = function() {
		var sections = new Object();
		create_buttons();

		<?php
			for ( $i = 0; $i < count($_SESSION['permissions']); $i++){
				switch($_SESSION['permissions'][$i]){
					case 'CREATE_ARTICLE':
						?>

						sections['Créer un article'] = """<?= $write_article ?>""";
						
						<?php
						break;
				}
			}
		?>


		function reset_section(){
			var main_section = document.getElementById('main_section');
			main_section.innerHTML = '';
		}


		function create_buttons(){
			for(var i in sections){
				console.log("Section : " + i);
			}
		}


	}
</script>

<?php
	$content = ob_get_clean();
?>