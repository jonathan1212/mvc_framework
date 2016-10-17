<?php
	use Zend\Form\View\Helper\FormRadio;
	use Zend\Form\View\Helper\FormDate;
	use Zend\Form\View\Helper\FormFile;
	use Zend\Form\View\Helper\FormTextarea;
	use Zend\Form\View\Helper\FormSelect;
	use Zend\Form\View\Helper\FormInput;
	use Zend\Form\View\Helper\FormElementErrors;

	$formradio = new FormRadio;
	$formdate = new FormDate;
	$formfile = new FormFile;
	$textarea = new FormTextarea;
	$element = new FormSelect;
	$inpupt = new FormInput;
	$errors = new FormElementErrors;
	$form = $data['form'];
?>

		<div class="col-md-12">
	        <div class="box-body">
	        	<form class="form-horizontal col-md-12" method="post" enctype="multipart/form-data">
		            <div class="form-group"> 
		            	<label class="col-sm-3">Author</label>
						<div class="col-sm-9">
							<?php echo $element->render($form->get('author_id')); ?>
							<?php echo $errors->render($form->get('author_id')); ?>
						</div>
					</div>

					<div class="form-group"> 
		            	<label class="col-sm-3">Title</label>
						<div class="col-sm-9">
							<?php echo $inpupt->render($form->get('title')); ?>
							<?php echo $errors->render($form->get('title')); ?>
						</div>
					</div>

					<div class="form-group"> 
		            	<label class="col-sm-3">Content</label>
						<div class="col-sm-9">
							<?php echo $textarea->render($form->get('content')); ?>
							<?php echo $errors->render($form->get('content')); ?>
						</div>
					</div>

					<div class="form-group"> 
		            	<label class="col-sm-3">Image</label>
						<div class="col-sm-9">
							<?php echo $formfile->render($form->get('filename')); ?>
							<?php echo $errors->render($form->get('filename')); ?>
						</div>
					</div>

					<div class="form-group"> 
		            	<label class="col-sm-3">Date Updated</label>
						<div class="col-sm-9">
							<?php echo $formdate->render($form->get('date_updated')); ?>
							<?php echo $errors->render($form->get('date_updated')); ?>
						</div>
					</div>

					<div class="form-group"> 
		            	<label class="col-sm-3">Status</label>
						<div class="col-sm-9">
							<?php echo $formradio->render($form->get('status')); ?>
							<?php echo $errors->render($form->get('status')); ?>
						</div>
					</div>

					
					<button class="btn btn-primary center" type="submit">Submit</button>
					<a class="btn btn-primary center" href="/post">Cancel</a>

				</form>
			</div>
		</div>