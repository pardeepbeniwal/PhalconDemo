<h2>Signup form</h2>
<?php
if(isset($msg))
{	
	if(is_object($msg))
	{ 
		foreach ($msg->getMessages() as $message) {			
				echo $message->getMessage(), "<br/>";
			}
	}	
}
echo $this->flashSession->output();
?>
<?php echo $this->tag->form('signup/register') ?>

	<div class="form-group">
		<label for="name">Name</label>
		<?php echo $this->tag->textField(array("name", 'class' => 'form-control')) ?>
	</div>

	<div class="form-group">
		<label for="name">E-Mail</label>
		<?php echo $this->tag->textField(array("email", 'class' => 'form-control')) ?>
	</div>
	<div class="form-group">
		<label for="name">Password</label>
		<?php echo $this->tag->textField(array("password", 'class' => 'form-control')) ?>
	</div>
		<?php echo $this->tag->submitButton(array("Register", 'class' => 'btn btn-default')) ?>
	

</form>
