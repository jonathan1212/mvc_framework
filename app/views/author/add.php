<?php 
	use Core\View;
?>

<div class="row">
	<h2>Add form</h2>
	<?php echo View::render('author/_form',array( 'form'=>  $data['form'] )) ?>
</div>

