<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
			<h1 class="title" align="center">Limit Bulanan Baru</h1>
			<br><br><br>
				<?php echo form_open('new_budget/monthly') ?>
					<table class="table">
						<tr class="form-group">
							<td><span class="form-label">Month</span></td>
							<td>
								<select name="month" class="form-control">
									<option value="january">January</option>
									<option value="february">February</option>
									<option value="march">March</option>
									<option value="april">April</option>
									<option value="may">May</option>
									<option value="june">June</option>
									<option value="july">July</option>
									<option value="august">August</option>
									<option value="september">September</option>
									<option value="october">October</option>
									<option value="november">November</option>
									<option value="december">December</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Year</td>
							<td>
								<select name='year' class="form-control">
								<?php for($i=date('Y'); $i<date('Y')+10; $i++): ?>
									<option value=<?php echo $i ?>><?php echo $i ?></option>
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
							<td><span class="form-label">Budget Amount</span></td>
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
		}else
		{
			$('#amount').empty();
			$('#amount').append('$');
		}
	}
</script>