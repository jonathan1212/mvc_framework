<?php
/**
 * Sample layout
 */

use Helpers\Assets;
use Helpers\Url;
use Helpers\Hooks;

//initialise hooks
$hooks = Hooks::get();
?>
		</div>

		<div class="col-md-4">
			<h2> Menu </h2>
			<ul>
				<li><a href="/author"> Author </a></li>
				<li><a href="/post"> Post </a></li>
			</ul>
		</div>
	</div>


</div>

<!-- JS -->
<?php


//hook for plugging in code into the footer
$hooks->run('footer');
?>

</body>
</html>
