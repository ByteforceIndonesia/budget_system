<div class="row" style="margin-top:10%;" >
	<div class="col-md-4" id="logo-login">
		
	</div>
	<div class="col-md-4 col-xs-12" style="padding:20px;">
		<div class="row">
			<img src="<?php echo base_url().'img/logo.png' ?>" class="img img-responsive" id="logo" width="400" style="margin:auto" alt="Saerah Logo">
		</div>
		<div class="row">
			<div>
				<form action="<?php echo base_url('accounts/login') ?>" method="post">
					<div class="form-group">
						<div class="input-group">
							
							<span class="input-group-addon" id="username-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
							<input type="text" name="username" placeholder="Username" class="form-control" aria-describedby="username-addon">

						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							
							<span class="input-group-addon" id="username-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
							<input type="password" name="password" placeholder="Password" class="form-control" aria-describedby="username-addon">

						</div>
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-default form-control" name="login" value="LOGIN">
					</div>

				</form>

				
			</div>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>