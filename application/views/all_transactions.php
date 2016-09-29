<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Data Tables -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jqc-1.12.3/dt-1.10.12/af-2.1.2/b-1.2.2/b-print-1.2.2/cr-1.3.2/kt-2.1.3/r-2.1.0/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jqc-1.12.3/dt-1.10.12/af-2.1.2/b-1.2.2/b-print-1.2.2/cr-1.3.2/kt-2.1.3/r-2.1.0/datatables.min.js"></script>
<script>

$(document).ready( function () {
    $('#table_gold').DataTable();
} );

$(document).ready( function () {
    $('#table_diamond').DataTable();
} );

</script>
 -->


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
				<h1>Gold</h1><br>
        		<table class="table table-hover" id="table_gold">
					<thead>
						 <tr>
						 	<td>No</td>
						 	<td>Jumlah Emas (gr)</td>
						 	<td>Harga Emas / gr</td>
						 	<td>Total Yang Dibayarkan</td>
						 	<td>Action</td>
						 </tr>
					</thead>
					<tbody>
					<?php if($gold != NULL): ?>
						<?php $i = 1; foreach($gold as $one): ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $one['weight'] ?></td>
								<td><?php echo rupiah($one['gold_price'])?></td>
								<td><?php echo rupiah($one['amount']) ?></td>
						 		<td>
						 			<a href="<?php echo base_url('main/delete/' . $one['id']) ?>">Delete</a>
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
        		<br><br><br>
				<h1>Diamond</h1><br>
        		<table class="table table-hover" id="table_diamond">
					<thead>
						 <tr>
						 	<td>No</td>
						 	<td>Panjang Cicilan</td>
						 	<td>Cicilan Perbulan</td>
						 	<td>Mulai Pembayaran Cicilan</td>
						 	<td>Amount</td>
						 	<td>Action</td>
						 </tr>
					</thead>
					<tbody>
					<?php if($diamond != NULL): ?>
						<?php $i = 1; foreach($diamond as $one): ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $one['spanning_month'].' bulan' ?></td>
								<td><?php echo NZD($one['amount']/$one['spanning_month'] )?></td>
								<td><?php echo $one['start_payment'] ?></td>
								<td><?php echo NZD($one['amount']) ?></td>
						 		<td>
						 			<a href="<?php echo base_url('main/delete/' . $one['id']) ?>">Delete</a>
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