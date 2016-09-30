<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<?php echo form_open('main/setting_timer') ?>
				<table class="table">

						<tr class="form-group">
							<td style="width: 60%"><span class="form-label">Atur Jam Pengiriman Email Peringatan 1 Hari Sebelum Pembayaran <span class="pull-right">:</span></span></td>
							<td >
								<input type="time" class="form-control" name=day-1 value="<?php echo $configuration['day-1'] ?>">
							</td>
						</tr>
						<tr class="form-group">
							<td style="width: 60%"><span class="form-label">Atur Jam Pengiriman Email Peringatan Pada Hari Pembayaran <span class="pull-right">:</span></span></td>
							<td>
								<input type="time" class="form-control" style="" name=day value="<?php echo $configuration['day'] ?>">
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
   	  var options = {
        now: "", //hh:mm 24 hour format only, defaults to current time
        twentyFour: true,  //Display 24 hour format, defaults to false
        upArrow: 'wickedpicker__controls__control-up',  //The up arrow class selector to use, for custom CSS
        downArrow: 'wickedpicker__controls__control-down', //The down arrow class selector to use, for custom CSS
        close: 'wickedpicker__close', //The close class selector to use, for custom CSS
        hoverState: 'hover-state', //The hover state class to use, for custom CSS
        title: 'Atur Jam', //The Wickedpicker's title,
        showSeconds: false, //Whether or not to show seconds,
        secondsInterval: 1, //Change interval for seconds, defaults to 1,
        minutesInterval: 1, //Change interval for minutes, defaults to 1
        beforeShow: null, //A function to be called before the Wickedpicker is shown
        show: null, //A function to be called when the Wickedpicker is shown
        clearable: true, //Make the picker's input clearable (has clickable "x")
    };
   	 $('.timepicker').wickedpicker(options);
	} );
</script>