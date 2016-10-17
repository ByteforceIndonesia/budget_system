<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<h1 class="title" align="center">Supplier Baru</h1>
				<?php echo form_open('supplier/add_supplier') ?>
					<table class="table">

						<tr class="form-group">
							<td><span class="form-label">Nama Supplier</span></td>
							<td>
								<input type="text" name="name" class="form-control" required="required" placeholder="Nama Supplier">
							</td>
						</tr>
						<tr class="form-group">
							<td><span class="form-label">Telp. Supplier</span></td>
							<td>
								<input type="text" name="phone" class="form-control" required="required" placeholder="No. Telp">
							</td>
						</tr>
						<tr>
							<td>
								<span class="form-label">Alamat</span>
							</td>
							<td>
								<textarea name="address" placeholder="Alamat" class="form-control"></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" name="add" class="btn btn-default pull-right" value="Tambah">
							</td>
						</tr>
					</table>
				<?php echo form_close() ?>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</section>

