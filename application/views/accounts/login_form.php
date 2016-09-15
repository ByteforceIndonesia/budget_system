<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="loginForm">
					<?php echo form_open('accounts/login') ?>
						<table class="table">
							<tr>
								<th colspan="2">
									<h2>Login</h2>
								</th>
							</tr>
							<tr>
								<th>Username</th>
								<td><input type="text" id="username" name="username" class="form-control" required></td>
							</tr>
							<tr>
								<th>Password</th>
								<td><input type="password" id="password" name="password" class="form-control" required></td>
							</tr>
							<tr>
								<td colspan="2"><input type="submit" value="Sign In" class="form-control" required></td>
							</tr>
						</table>
					<?php echo form_close() ?>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</section>