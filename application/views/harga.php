<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
	.input-group-addon{
		width: 50px;
	}
	.input-group{
		width: 100%;
	}
</style>

<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<!-- Content -->
				<div class="month-picker row">
					<div class="col-md-8">
						<h1>Masukkan Harga Emas dan Dollar Hari Ini.</h1>

					</div>
					<div class="col-md-4 month-pick">
						
					</div>
				</div>
				
						

					
				<div class="row">
				<!-- Loading Bars -->
				<section class="bar">
					<div class="col-md-2">
						
					</div>
					<div class="col-md-8">
					<?php echo form_open('rate') ?>
						<table style="width: 100%" class="table">
							<thead>
								<tr>
									<th colspan="2">Update Harga</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><label for="">Harga LM :</label></td>
									<td><div class="input-group"><span class="input-group-addon">Rp.</span><input type="text" pattern="\d*" name="emaslm" title="input hanya boleh angka" value="<?php echo $emaslm ?>" class="form-control"></div></td>
								</tr>
								<tr>
									<td><label for="">Harga Emas 24 :</label></td>
									<td><div class="input-group"><span class="input-group-addon">Rp.</span><input type="text" pattern="\d*" name="emas24" title="input hanya boleh angka" value="<?php echo $emas24 ?>" class="form-control"></div></td>
								</tr>
								<tr>
									<td><label for="">Harga USD :</label></td>
									<td><div class="input-group"><span class="input-group-addon">$  </span><input type="text" pattern="\d*" name="dollar" title="input hanya boleh angka" value="<?php echo $dollar ?>" class="form-control"></div></td>
								</tr>
								<tr>
									<td colspan="2">
										<input type="submit" name="update" value="UPDATE HARGA" class="btn btn-primary pull-right">
									</td>
								</tr>
							</tbody>
						</table>
						<?php echo form_close(); ?>
					</div>
					<div class="col-md-2">
						
					</div>
				</section>
				</div>
				
			</div>	
			<div class="col-md-1"></div>
		</div>
		
	</div>
</section>
