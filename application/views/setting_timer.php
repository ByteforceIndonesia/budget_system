<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<?php echo form_open('main/setting_timer') ?>
				<div class="form-group">
					<label for="">Atur Jam Pengiriman Email Peringatan 1 Hari Sebelum Pembayaran :</label>
					<input type="time" class="form-control" name=day-1>	
					<input type="submit" class="btn btn-default pull-right" value="Submit">
				</div>
				<?php echo form_close() ?>
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