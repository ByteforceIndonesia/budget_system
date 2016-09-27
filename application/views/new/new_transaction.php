<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<?php echo form_open('new_budget/transaction') ?>
					<table class="table">
						<tr class="form-group">
							<td><span class="form-label">Mulai Cicilan</span></td>
							<td>
								<input type="date" name="start_payment" placeholder="Start Payment" class="form-control" required>
							</td>
						</tr>
						<tr class="form-group">
							<td><span class="form-label">How Many Month For Installment</span></td>
							<td>
								<select name="spanning" class="form-control">
									<?php for($i=1; $i<12; $i++): ?>
										<option value="<?php echo $i ?>"><?php echo $i ?></option>
									<?php endfor; ?>
								</select>
							</td>
						</tr>
						<tr class="form-group">
							<td><span class="form-label">Type</span></td>
							<td>
								<select name="type" class="form-control" id="type" onchange="ganti()">
									<option value="gold">Gold</option>
									<option value="diamond">Diamond</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><span class="form-label">Transaction Amount</span></td>
							<td>
								<div class="form-group">
								  <div class="input-group">
								      <div class="input-group-addon" id="amount">Gr.</div>
								      <input type="text" class="form-control" id="exampleInputAmount" name="amount" placeholder="Amount" required>
								      <div class="input-group-addon">.00</div>
								  </div>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" class="btn btn-primary pull-right" value="Submit">
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
			$('#gold').append('<td><span class="form-label">Gold Price as of Today</span></td><td><div class="form-group"><div class="input-group"><div class="input-group-addon" id="amount">$</div><input type="text" class="form-control" name="gold" placeholder="Gold Price" required><div class="input-group-addon">.00</div></div></div></td>');
		}else
		{
			$('#amount').empty();
			$('#amount').append('$');
			$('#gold').empty();
		}
	}
</script>