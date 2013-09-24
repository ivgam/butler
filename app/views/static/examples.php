<?php Fw_Module::getModule('masthead', array('active' => 'examples')) ?>
<h1>Examples</h1>
<p>
	Below, some examples of thing that Butler have already developed for
	inspire you and...save your time (you can use it...is FREE!).
</p>
<h3>Login & Register Buttons</h3>
<div class="row">
	<div class="span3" style="margin-top:30px">
		<?php Fw_Module::getModule('login_register') ?>  
	</div>
	<div class="span4 offset3">
		<p>
			Hi! How many websites needs a basic login & register form? Ok, here
			you have a basic example that is fully integrated in the core of
			Butler. If you don't have well configured the mail server, you don't
			receive the confirmation email. But don't worry, the user is created
			and you can change their state to confirmed in the admin panel in 
			the section CRUD/Customers. After that, you can login and continue
			the testing of this example. Good luck!
		</p>
	</div>
</div>
<hr/>
<h3>Contact Form</h3>
<div class="row">
	<div class="span5">
		<h4>Write us a message</h4>
		<div class="well" style="padding-bottom: 35px;">
			<form action="<?= BASE_URI ?>contact/send" method="post" id="contact-form">
				<div class="control-group">
					<label class="control-label">Name</label>
					<div class="controls">
						<input 
							name="contact_name" 
							type="text" 
							class="input-xlarge" 
							value="<?= !empty($form_errors) ? Fw_Filter::getVar('contact_name', 'default', 'post') : '' ?>"
							/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Email (never published)</label>
					<div class="controls">
						<input 
							name="contact_email" 
							type="text" 
							class="input-xlarge" 
							value="<?= !empty($form_errors) ? Fw_Filter::getVar('contact_email', 'default', 'post') : '' ?>"
							/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Subject</label>
					<div class="controls">
						<input 
							name="contact_subject" 
							type="text" 
							class="input-block-level" 
							value="<?= !empty($form_errors) ? Fw_Filter::getVar('contact_subject', 'default', 'post') : '' ?>"
							/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Comment</label>
					<div class="controls">
						<textarea 
							name="contact_comment" 
							class="input-block-level" 
							rows="10"><?= !empty($form_errors) ? Fw_Filter::getVar('contact_comment', 'default', 'post') : '' ?>
						</textarea>
					</div>
				</div>
				<input type="submit" name="form_submision" class="btn btn-inverse pull-right" value="Send Message"/>
			</form>
		</div>
	</div>
	<div class="span4 offset1">
		<p>
			Continuing with the basic functionalities, we believe that the major
			part of the websites that you need to develop, needs a contact form.
			Here you have the functionality and...in the admin panel, a 
			basic "Ticket manager". Isn't the best in the world but allows you
			to reply to your visitors easily and change the status of this 
			contact email for know which are the questions that you solve
			and which are the questions that you need to solve.
		</p>
	</div>
</div>
<hr/>
<div class="row">
	<div class="span3 offset2" style="margin-top:50px">
		<img src="<?= PUBLIC_URI?>icon.png"/>
	</div>
	<div class="span5" >
		<p>
			Well...this is hard to say. You have lots of functionalities already
			developed but is very difficult to show as an example. For example,
			you have CRUD for manage post, that, potentially, is a blog. 
		</p>
		<p>
			Also you have a landing engine, that allows you to manage you
			digital marketing campaigns. In it, you can set your costs, you 
			can view their results with graphics...is nice.
		</p>
		<p>
			But...as we said...you need to explore a little bit in the admin
			panel and view which is the best form to use this functionalities.
			We hope that in a near future, we can offer you in this section
			a more visual information and lots of examples.
		</p>
		<p>
			If you have more questions...you can go to the wiki and learn more
			about Butler and their functionalities. Also you can
			send us an email in our <a href="#">official website</a>. 
			We hope that you enjoy lots developing with it.
		</p>
		<p>Thanks for believe in Butler</p>
	</div>
</div>