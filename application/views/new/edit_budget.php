<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
			<h1 class="title" align="center">Edit Budget</h1>
			<br><br><br>
				<?php echo form_open('new_budget/edit') ?>
					<table class="table">
						<tr class="form-group">
							<td><span class="form-label">Month</span></td>
							<td>
								<input type="text" disabled class="form-control" value="<?php echo $month ?>" placeholder="<?php echo $month ?>">
								<input type="hidden" name="month" value="<?php echo $month ?>">
							</td>
						</tr>
						<tr class="form-group">
							<td><span class="form-label">Year</span></td>
							<td>
								<input type="text" disabled class="form-control" value="<?php echo $year ?>" placeholder="<?php echo $year ?>">
								<input type="hidden" name="year" value="<?php echo $year ?>">
							</td>
						</tr>
						<tr class="form-group">
							<td><span class="form-label">Type</span></td>
							<td>
								<input type="text" class="form-control" id="type" placeholder="<?php echo $type ?>" onchange="ganti()" disabled value="<?php echo $type ?>">
								<input type="hidden" name="type" value="<?php echo $type ?>">
							</td>
						</tr>
						<tr>
							<td><span class="form-label">Budget Amount</span></td>
							<td>
								<div class="form-group">
								  <div class="input-group">
								      <div class="input-group-addon" id="amount"><?php echo ($type == 'diamond') ? '$' : 'Gr.' ?></div>
								      <input type="text" class="form-control" id="exampleInputAmount" placeholder="<?php echo $amount ?>" value="<?php echo $amount ?>" required disabled>
										<input type="hidden" name="amount" value="<?php echo $amount ?>">
								      <div class="input-group-addon">.00</div>
								  </div>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" class="btn btn-primary pull-right" value="Finalize">
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
	function ganti()
	{
		if($('#type').val() == "gold")
		{
			$('#amount').empty();
			$('#amount').append('Gr.');
		}else
		{
			$('#amount').empty();
			$('#amount').append('$');
		}
	}
</script>