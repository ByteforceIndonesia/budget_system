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
				<div class="form-group" style="margin-bottom: 20px">
					<label for="">Search :</label>
					<input type="text" class="form-control" id="filter" style="width: 25%">
				</div>
				<h1>Diamond</h1>
				<div class="table-responsive toggle-circle-filled">
	        		<table class="table table-condensed" data-filter="#filter" data-page-size="10" id="table_diamond">
						<thead>
							 <tr>
							 	<th data-type="numeric" data-sort-initial="true">No</th>
							 	<th data-toggle="true">Pembelian Bulan</th>
							 	<th data-hide="phone">Tanggal Pembelian</th>
							 	<th data-hide="phone">Keterangan</th>
							 	<th data-hide="phone">Jatuh Tempo Pembayaran</th>
							 	<th data-type="numeric">Jumlah Pembayaran</th>
							 </tr>
						</thead>
						<tbody>
						<?php if($installments != NULL): ?>
							<?php $i = 1; foreach($installments as $one): ?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $one->month.' '.$one->year ?></td>
									<td><?php echo date('d-m-Y',strtotime($one->created)) ?></td>
									<td><?php echo $one->description ?></td>
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
						<tfoot class="hide-if-no-paging">
							<td colspan="5">
								<div class="pagination"></div>
							</td>
							
						</tfoot>
	        		</table>
        		</div>
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

<script>
	$(document).ready(function() {
   	 $('#table_diamond').footable();
	} );
</script>