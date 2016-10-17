<?php
	use Zend\Form\View\Helper\FormInput;
	use Zend\Form\View\Helper\FormElementErrors;
	
	$element = new FormInput();
	$errors = new FormElementErrors;
	$form = $data['form'];
?>

		<div class="col-md-12">
	        <div class="box-body">
	        	<form method="post" class"form-horizontal col-md-12">
		            <div class="form-group"> 
		            	<label class="col-sm-3">FirstName</label>
						<div class="col-sm-9">
							<?php echo $element->render($form->get('firstname')); ?>
							<?php echo $errors->render($form->get('firstname')); ?>

						</div>
					</div>

					<div class="form-group"> 
		            	<label class="col-sm-3">Lastname</label>
						<div class="col-sm-9">
							<?php echo $element->render($form->get('lastname')); ?>
							<?php echo $errors->render($form->get('lastname')); ?>
						</div>
					</div>

					<div class="form-group"> 
		            	<label class="col-sm-3">Email Address</label>
						<div class="col-sm-9">
							<?php echo $element->render($form->get('email')); ?>
							<?php echo $errors->render($form->get('email')); ?>
						</div>
					</div>

					<div class="form-group"> 
		            	<label class="col-sm-3">Password</label>
						<div class="col-sm-9">
							<?php echo $element->render($form->get('password')); ?>
							<?php echo $errors->render($form->get('password')); ?>
						</div>
					</div>

					<div class="form-group"> 
		            	<label class="col-sm-3">Re Password</label>
						<div class="col-sm-9">
							<?php echo $element->render($form->get('re-password')); ?>
							<?php echo $errors->render($form->get('re-password')); ?>
						</div>
					</div>
				
					<button class="btn btn-primary center" type="submit">Submit</button>
					<a class="btn btn-primary center" href="/author">Cancel</a>

				</form>
			</div>
		</div>