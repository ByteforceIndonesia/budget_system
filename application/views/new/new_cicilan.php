<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
			<h1 class="title" align="center">Limit Cicilan Bulanan Baru</h1>
			<br><br><br>
				<?php echo form_open('new_budget/monthly_cicilan') ?>
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
						<tr>
							<td><span class="form-label">Limit Cicilan Bulan Ini</span></td>
							<td>
								<div class="form-group">
								  <div class="input-group">
								      <div class="input-group-addon" id="amount">$</div>
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