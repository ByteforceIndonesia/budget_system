<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="table-responsive toggle-circle-filled">
	        		<table  class="table table-condensed" data-filter="#filter_gold" data-page-size="10" id="table_gold">
						<thead>
							 <tr>
							 	<th data-toggle="true" data-type="numeric" data-sort-initial="true">No</th>
							 	<th >Tanggal</th>
							 	<th >Harga Emas LM</th>
							 	<th >Harga Emas 24</th>
							 	<th >Harga USD</th>
							 </tr>
						</thead>
						<tbody>
						<?php if($history != NULL): ?>
							<?php $i = 1; foreach($history as $one): ?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo date('d-M-Y',strtotime($one->created)) ?></td>
									<td><?php echo $one->emas_lm ?></td>
									<td><?php echo $one->emas_24 ?></td>
									<td><?php echo $one->dollar?></td>
									
								</tr>
							<?php $i++; endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="7"><h2 align="center">Tidak Ada History</h2></td>
							</tr>
						<?php endif; ?>
						</tbody>
	        		</table>
        		</div>
        	</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</section>
