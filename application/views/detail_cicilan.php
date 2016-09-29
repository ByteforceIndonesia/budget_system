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
						<div class="input-group date pull-right" id="datepicker" data-date="<?php echo date('Y-m') ?>" data-date-format="yyyy-mm">
							 <span class="input-group-addon add-on"><span class="glyphicon glyphicon-th"></span></span>	
							 <input type="text" name="date" id="datepick" class="form-control" readonly="readonly" placeholder="Select Month">	  
					    </div>
					</div>
				</div>

				<h1 class="title" align="center">Seluruh Cicilan Bulan <?php echo $month ?> </h1>
				
				<h1>Diamond</h1>
        		<table class="table table-hover" id="table_diamond">
					<thead>
						 <tr>
						 	<td>No</td>
						 	<td>Pembelian Bulan</td>
						 	<td>Tanggal Pembelian</td>
						 	<td>Jatuh Tempo Pembayaran</td>
						 	<td>Jumlah Pembayaran</td>
						 </tr>
					</thead>
					<tbody>
					<?php if($installments != NULL): ?>
						<?php $i = 1; foreach($installments as $one): ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $one->month.' '.$one->year ?></td>
								<td><?php echo date('d-m-Y',strtotime($one->created)) ?></td>
								<td><?php echo date('d-m-Y',strtotime($one->due)) ?></td>
								<td><?php echo NZD($one->amount) ?></td>
						 		
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
			window.location.replace("<?php echo base_url('main/detail_cicilan') ?>/"+$('#datepick').val());
		}, 50 );
	});
});
</script>

<script type="text/javascript">
    $("#datepicker").datepicker({
    		format: "yyyy-mm",
		    viewMode: "months", 
		    minViewMode: "months",
		    autoClose: true
		});
</script>