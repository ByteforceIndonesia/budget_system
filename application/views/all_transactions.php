<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="month-picker row">
					<div class="col-md-8">
						
					</div>
					<div class="col-md-4 month-pick">
						<div class="input-group date pull-right" id="datepicker" data-date="<?php echo date('m-Y') ?>" data-date-format="mm-yyyy">
							 <span class="input-group-addon add-on"><span class="glyphicon glyphicon-th"></span></span>	
							 <input type="text" name="date" id="datepick" class="form-control" readonly="readonly" placeholder="Select Month">	  
					    </div>
					</div>
				</div>

				<h1 class="title" align="center">Seluruh Transaksi Bulan <?php echo $month ?></h1>
				<h1>Gold</h1>
				<div class="form-group" style="margin-bottom: 20px">
					<label for="">Search :</label>
					<input type="text" class="form-control" id="filter_gold" style="width: 25%">
				</div>
				<div class="table-responsive toggle-circle-filled">
	        		<table  class="table table-condensed" data-filter="#filter_gold" data-page-size="10" id="table_gold">
						<thead>
							 <tr>
							 	<th data-type="numeric" data-sort-initial="true">No</th>
							 	<th data-toggle="true">Keterangan</th>
							 	<th data-hide="phone">Jumlah Emas (gr)</th>
							 	<th data-hide="phone">Supplier</th>
							 	<th data-hide="phone">Tanggal Pembayaran</th>
							 	<th data-hide="phone">Action</th>
							 </tr>
						</thead>
						<tbody>
						<?php if($gold != NULL): ?>
							<?php $i = 1; foreach($gold as $one): ?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $one->description ?></td>
									<td><?php echo $one->weight ?></td>
									<td><?php echo $one->name?></td>
									
									<td><?php echo date('d-M-Y',strtotime($one->start_payment)) ?></td>
							 		<td>
							 			<a href="<?php echo base_url('main/delete/' . $one->id) ?>">Delete</a>
							 		</td>
								</tr>
							<?php $i++; endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="7"><h2 align="center">Tidak Ada Transaksi Bulan Ini</h2></td>
							</tr>
						<?php endif; ?>
						</tbody>
	        		</table>
        		</div>

        		<h1>Diamond</h1>
				<div class="form-group" style="margin-bottom: 20px">
					<label for="">Search :</label>
					<input type="text" class="form-control" id="filter" style="width: 25%">
				</div>
				
				<div class="table-responsive toggle-circle-filled">
	        		<table class="table table-condensed" data-filter="#filter" data-page-size="10" id="table_diamond">
					<thead>
						 <tr>
						 	<th data-type="numeric" data-sort-initial="true">No</th>
						 	<th data-toggle="true">Keterangan</th>
						 	<th data-hide="phone">Supplier</th>
						 	<th data-hide="phone">Panjang Cicilan</th>
						 	<th data-hide="phone">Cicilan Perbulan</th>
						 	<th data-hide="phone">Mulai Pembayaran Cicilan</th>
						 	<th data-type="numeric">Total</th>
						 	<th data-hide="phone">Action</th>
						 </tr>
					</thead>
					<tbody>
					<?php if($diamond != NULL): ?>
						<?php $i = 1; foreach($diamond as $one): ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $one->description ?></td>
								<td><?php echo $one->name ?></td>
								<td><?php echo $one->spanning_month.' bulan' ?></td>
								<td><?php echo NZD($one->amount/$one->spanning_month )?></td>
								<td><?php echo date('d-M-Y',strtotime($one->start_payment)) ?></td>
								<td><?php echo NZD($one->amount) ?></td>
						 		<td>
						 			<a href="<?php echo base_url('main/delete/' . $one->id) ?>">Delete</a>
						 		</td>
							</tr>
						<?php $i++; endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="7"><h2 align="center">Tidak Ada Transaksi Bulan Ini</h2></td>
						</tr>
					<?php endif; ?>
					</tbody>
					<tfoot class="hide-if-no-paging">
						<td colspan="7">
							<div class="pagination"></div>
						</td>
						
					</tfoot>
        		</table>
        	</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</section>

<script>
$(document).ready(function(){
	$('#datepicker').on("changeDate", function(){
		window.setTimeout(function(){
			window.location.replace("<?php echo base_url('main/all_transactions') ?>/"+$('#datepick').val());
		}, 50 );
	});
});
</script>

<script type="text/javascript">
    $("#datepicker").datepicker({
    		format: "mm-yyyy",
		    viewMode: "months", 
		    minViewMode: "months",
		    autoClose: true
		});
</script>

<script>
	$(document).ready(function() {
   	 $('#table_diamond').footable();
   	 $('#table_gold').footable();
	} );
</script>