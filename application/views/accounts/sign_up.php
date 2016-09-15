<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="loginForm">
					<?php echo form_open('accounts/signup') ?>
						<table class="table loginForm">
							<tr>
								<th colspan="2">
									<h2>Sign Up</h2>
								</th>
							</tr>
							<tr>
								<th><i class="fa fa-user fa-2x" aria-hidden="true"></i></th>
								<td><input type="text" id="username" name="username" class="form-control" placeholder="Username" required></td>
							</tr>
							<tr>
								<th><i class="fa fa-lock fa-2x" aria-hidden="true"></i></th>
								<td><input type="password" id="password" name="password" class="form-control" placeholder="Password" required></td>
							</tr>
							<tr>
								<th><i class="fa fa-user fa-2x" aria-hidden="true"></i></th>
								<td><input type="text" id="fullname" name="fullname" placeholder="Full Name" class="form-control" required></td>
							</tr>
							<tr>
								<td colspan="2">
									<p align="center">
										<input type="submit" id="submit" value="Sign Up" class="form-control" required>
									</p>
								</td>
							</tr>
						</table>
					<?php echo form_close() ?>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</section>
