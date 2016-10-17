<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $breaks = array("<br />","<br>","<br/>"); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<h1 class="title" align="center">Ubah Supplier</h1>
				<?php echo form_open('supplier/edit/'.$supplier->id) ?>
					<table class="table">

						<tr class="form-group">
							<td><span class="form-label">Nama Supplier</span></td>
							<td>
								<input type="text" name="name" class="form-control" required="required" value="<?php echo $supplier->name ?>" placeholder="Nama Supplier">
							</td>
						</tr>
						<tr class="form-group">
							<td><span class="form-label">Telp. Supplier</span></td>
							<td>
								<input type="text" name="phone" class="form-control" required="required" value="<?php echo $supplier->phone ?>" placeholder="No. Telp">
							</td>
						</tr>
						<tr>
							<td>
								<span class="form-label">Alamat</span>
							</td>
							<td>
								<textarea name="address"  placeholder="Alamat" required="required" class="form-control"><?php echo str_replace($breaks, "", $supplier->address) ?></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" name="update" class="btn btn-default pull-right" value="Simpan">
							</td>
						</tr>
					</table>
				<?php echo form_close() ?>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</section>

