<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="row">
				
				<a href="<?php echo base_url('main/cicilan_tahunan/gold') ?>" class="btn btn-default" style="padding: 5px 15px;">Gold</a>
				<a href="<?php echo base_url('main/cicilan_tahunan/diamond') ?>" class="btn btn-primary">Diamond</a>


				<?php if ($this->uri->segment(4) == '') {
					$year = date('Y');
				}else{
					$year = $this->uri->segment(4);
					} 

					?>
        		<h1><?php echo $year.' '.ucfirst($type) ?></h1>
				<div class="form-group" style="margin-bottom: 20px">
					<label for="">Search :</label>
					<input type="text" class="form-control" id="filter" style="width: 40%;display: inline;">
					<select name="year" id="select_year" onchange="change_year()" class="form-control pull-right" style="width: 30%;display: inline;">
						<option value="">--Select Year--</option>
						<?php for($i = 2016; $i < 2050; $i++): ?>
							<option value="<?php echo $i ?>"><?php echo $i ?></option>
						<?php endfor; ?>
					</select>
				</div>
				
				<div class="table-responsive toggle-circle-filled">
	        		<table class="table table-condensed" data-filter="#filter" data-page-size="12" id="cicilan">
					<thead>
						 <tr>
						 	<th data-sort-ignore="true">Bulan</th>
						 	<th data-type="numeric">Jumlah Cicilan</th>
						 	<th data-hide="phone">Action</th>
						 </tr>
					</thead>
					<tbody>
					
					<?php if($cicilan != NULL): ?>
						<?php $i = 1; foreach($cicilan as $one): ?>
							<tr>
								<td><?php echo date('F',strtotime($year.'-'.$i)) ?></td>
								<?php if ($this->uri->segment(3)=='diamond'): ?>
									<td><?php echo NZD($one) ?></td>
								<?php else: ?>
									<td><?php echo rupiah($one) ?></td>
								<?php endif ?>
								<td><a href="<?php echo base_url().'main/detail_cicilan/'.date('Y-m',strtotime($year.'-'.$i)).'/'.$type ?>">Lihat Detail &raquo;</a></td>
							</tr>
						<?php $i++; endforeach; ?>
					
					<?php endif; ?>
					</tbody>
					
        		</table>
        	</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function(){
		$('#cicilan').footable();
	});
</script>

<script>
	function change_year(){
		
		var year = $('#select_year').val();
		base_url = "<?php echo base_url() ?>"; 

		location.replace(base_url+"main/cicilan_tahunan/" + "<?php echo $type ?>" + '/' + year);
	}
</script>