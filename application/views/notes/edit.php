<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $breaks = array("<br />","<br>","<br/>"); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<h1 class="title" align="center">Edit Notes</h1>
				<?php echo form_open('notes/edit/'.$note->id) ?>
					<table class="table">

						<tr class="form-group">
							<td><span class="form-label">Judul Notes</span></td>
							<td>
								<input type="text" name="title" value="<?php echo $note->title ?>" required="required" class="form-control" placeholder="Judul">
							</td>
						</tr>
						
						<tr>
							<td>
								<span class="form-label">Isi Notes</span>
							</td>
							<td>
								<textarea name="content" rows="10" placeholder="Isi Notes" required="required" class="form-control"><?php echo str_replace($breaks, "", $note->content) ?></textarea>
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



