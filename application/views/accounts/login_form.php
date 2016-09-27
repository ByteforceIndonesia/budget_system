<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4 col-xs-12">
				<div class="loginForm">
					<?php echo form_open('accounts/login') ?>
						<div class="form-group">
							<h2 class="text-center">Sign In</h2>
							<label for="username">Username</label>
							<div class="input-group">
								<span class="input-group-addon" id="username-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
								<input type="text" id="username" name="username" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label for="username">Password</label>
							<div class="input-group">
								<span class="input-group-addon" id="username-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
								<input type="password" id="password" name="password" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" value="Sign In" class="form-control btn-primary" required>
						</div>
					<?php echo form_close() ?>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</section>