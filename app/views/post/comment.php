<?php
	use Zend\Form\View\Helper\FormDate;
	use Zend\Form\View\Helper\FormTextarea;
	use Zend\Form\View\Helper\FormInput;
	use Zend\Form\View\Helper\FormElementErrors;

	$formdate = new FormDate;
	$textarea = new FormTextarea;
	$inpupt = new FormInput;
	$errors = new FormElementErrors;
	
	$form = $data['form'];
?>

<div class="row">

<h2> Add Comment </h2>
	<a href="#close" title="Close" class="close">X</a>

	<form class="form-horizontal" id="comment" method="post" enctype="multipart/form-data">
		
		<div class="form-group"> 
        	<label class="col-sm-3">Content</label>
			<div class="col-sm-9">
				<?php echo $textarea->render($form->get('content')); ?>
				<?php echo $errors->render($form->get('content')); ?>
			</div>
		</div>

		<div class="form-group"> 
        	<label class="col-sm-3">Date</label>
			<div class="col-sm-9">
				<?php echo $formdate->render($form->get('date')); ?>
				<?php echo $errors->render($form->get('date')); ?>
			</div>
		</div>

		<div class="form-group"> 
        	<label class="col-sm-3">Author</label>
			<div class="col-sm-9">
				<?php echo $inpupt->render($form->get('author')); ?>
				<?php echo $errors->render($form->get('author')); ?>
			</div>
		</div>
	

		<div class="pull-left">
	        <button type="submit" class="btn btn-primary">Save</button>
	        <a href="#close" class="btn btn-primary">Cancel</a>
	    </div>

	</form>

</div>