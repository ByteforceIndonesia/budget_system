<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<h1 class="title" align="center">Notes Baru</h1>
				<?php echo form_open('notes/add_notes') ?>
					<table class="table">

						<tr class="form-group">
							<td><span class="form-label">Judul Notes</span></td>
							<td>
								<input type="text" name="title" class="form-control" placeholder="Judul">
							</td>
						</tr>
						
						<tr>
							<td>
								<span class="form-label">Isi Notes</span>
							</td>
							<td>
								<textarea name="content" rows="10" placeholder="Isi Notes" class="form-control"></textarea>
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

