<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<h1 class="title" align="center">Ubah Password</h1>
				<?php echo form_open('accounts/change_password') ?>
					<table class="table">

						<tr class="form-group">
							<td style="width: 30%"><span class="form-label">Masukkan Password Baru</span></td>
							<td >
								<input type="password" name="password" onkeyup="check_pass()" id="pass" placeholder="Password Baru" class="form-control" required>

								<span id="notif1"></span>
							</td>
						</tr>
						<tr class="form-group">
							<td style="width: 30%"><span class="form-label">Ulangi Password</span></td>
							<td>
								<input type="password" name="confirm_password" id="conf" onkeyup="check_pass()" placeholder="Ulangi Password" class="form-control" required>
								<span id="notif2"></span>
							</td>
							
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" id="change_pass" class="btn btn-default pull-right" value="Ubah Password" disabled>
							</td>
						</tr>
					</table>
				<?php echo form_close() ?>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</section>

<script>

	function check_pass1(){
		$('#notif1').empty();
		$('#notif2').empty();
		if($('#pass').val() == ''){
			$('#notif1').append('Password tidak boleh kosong');
		}else if($('#pass').val() == $('#conf').val()){
			$('#change_pass').removeAttr('disabled');
		}else if($('#pass').val() != $('#conf').val()){
			$('#change_pass').attr('disabled','disabled');
		}
	}

	function check_pass(){
		$('#notif1').empty();
		$('#notif2').empty();
		if($('#pass').val() == ''){
			$('#notif1').append('Password tidak boleh kosong');
		}else if($('#pass').val() != $('#conf').val()){
			$('#notif2').append('Konfirmasi password tidak cocok dengan password');
			$('#change_pass').attr('disabled','disabled');
		}else{
			$('#change_pass').removeAttr('disabled');
		}
	}
</script>