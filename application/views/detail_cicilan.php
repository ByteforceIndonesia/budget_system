<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="month-picker row">
					

				<h1 class="title" align="center">Seluruh Cicilan Bulan <?php echo $month ?> </h1>
				
				<div class="col-md-8">
						<div class="form-group" style="margin-bottom: 20px">
					<label for="">Search :</label>
					<input type="text" class="form-control" id="filter" style="width: 50%">
				</div>	
					</div>
					<div class="col-md-4 month-pick">
						<div class="input-group date pull-right" id="datepicker" data-date="<?php echo date('Y-m') ?>" data-date-format="yyyy-mm">
							 <span class="input-group-addon add-on"><span class="glyphicon glyphicon-th"></span></span>	
							 <input type="text" name="date" id="datepick" class="form-control" readonly="readonly" placeholder="Select Month">	  
					    </div>
					</div>
				</div>
				<h1 style="margin-top: 10px;"><?php echo ucfirst($type) ?></h1>
				<div class="table-responsive toggle-circle-filled">
	        		<table class="table table-condensed" data-filter="#filter" data-page-size="10" id="table_diamond">
						<thead>
							 <tr>
							 	<th data-type="numeric" data-sort-initial="true">No</th>
							 	<th data-toggle="true">Giro</th>
							 	<th data-hide="phone">Supplier</th>
							 	<?php if ($type == 'diamond'): ?>
							 		<th data-hide="all">Jenis Diamond</th>
							 	<?php else: ?>
							 		<th data-hide="phone">Jumlah Emas(Gr)</th>
							 		<th data-hide="all">Jenis Emas</th>
							 	<?php endif ?>
							 	<th data-hide="phone">Tanggal Pembelian</th>
							 	<th data-hide="all">Keterangan</th>
							 	<th data-hide="phone">Jatuh Tempo Pembayaran</th>
							 	
							 	<?php if ($type == 'diamond'): ?>
							 		<th data-type="numeric">Total</th>
							 	<?php else: ?>
							 		<th data-type="numeric">Perkiraan Total</th>
							 	<?php endif ?>
							 </tr>
						</thead>
						<tbody>
						<?php if($installments != NULL): ?>
							<?php $i = 1; foreach($installments as $one): ?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $one->giro ?></td>
									<td><?php echo $one->name ?></td>
									<?php if ($type == 'diamond'): ?>
								 		<td><?php echo $one->diamond_type ?></td>
								 	<?php else: ?>
								 		<td><?php echo $one->weight.' gr' ?></td>
								 		<td><?php echo $one->diamond_type ?></td>
								 	<?php endif ?>
									<td><?php echo date('d-M-Y',strtotime($one->created)) ?></td>									
									<td><?php echo $one->description ?></td>
									<td><?php echo date('d-M-Y',strtotime($one->due)) ?></td>
									<?php if ($one->type == 'diamond'): ?>
										<td><?php echo NZD($one->amount) ?></td>
									<?php else: ?>
										<?php if($one->diamond_type == 'Logam Mulia'): ?>
											<td><?php echo rupiah($one->amount) ?></td>
										<?php else: ?>
											<td><?php echo rupiah($one->amount) ?></td>
										<?php endif; ?>
									<?php endif; ?>
									
							 		
								</tr>
							<?php $i++; endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="7"><h2 align="center">Tidak Ada Transaksi Bulan Ini</h2></td>
							</tr>
						<?php endif; ?>
						</tbody>
						<tfoot class="hide-if-no-paging">
							<td colspan="6">
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
			window.location.replace("<?php echo base_url('main/detail_cicilan') ?>/"+$('#datepick').val()+ "/" + "<?php echo $type ?>");
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