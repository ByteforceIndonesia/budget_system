<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
			<h1 class="title" align="center">Limit Budget Bulanan Baru</h1>
				<?php echo form_open('new_budget/monthly') ?>
					<table class="table">
						<tr class="form-group">
							<td><span class="form-label">Bulan</span></td>
							<td>
								<select name="month" class="form-control">
									<option value="january">Januari</option>
									<option value="february">Februari</option>
									<option value="march">Maret</option>
									<option value="april">April</option>
									<option value="may">Mei</option>
									<option value="june">Juni</option>
									<option value="july">Juli</option>
									<option value="august">Agustus</option>
									<option value="september">September</option>
									<option value="october">Oktober</option>
									<option value="november">November</option>
									<option value="december">Desember</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Tahun</td>
							<td>
								<select name='year' class="form-control">
								<?php for($i=date('Y'); $i<date('Y')+10; $i++): ?>
									<option value=<?php echo $i ?>><?php echo $i ?></option>
								<?php endfor; ?>
								</select>
							</td>
						</tr>
						<tr class="form-group">
							<td><span class="form-label">Tipe Barang</span></td>
							<td>
								<select name="type" class="form-control" id="type" onchange="ganti()">
									<option value="gold">Gold</option>
									<option value="diamond">Diamond</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><span class="form-label">Jumlah Budget</span></td>
							<td>
								<div class="form-group">
								  <div class="input-group">
								      <div class="input-group-addon" id="amount">Gr.</div>
								      <input type="text" class="form-control" id="exampleInputAmount" name="amount" placeholder="Nominal" required>
								      <div class="input-group-addon" id="gram">.00</div>
								  </div>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" class="btn btn-default pull-right" value="Submit">
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