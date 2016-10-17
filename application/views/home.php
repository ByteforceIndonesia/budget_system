<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if($this->uri->segment(2) == '') {

		$month = date('F');
		$year = date('Y');
		}else{

			$date = explode('-',$this->uri->segment(3));
			$year = $date[1];
			$month = date('F',strtotime($date[1].'-'.$date[0]));

		}?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<!-- Content -->
				<div class="month-picker row">
					<div class="col-md-8">
						<h2>Budget Bulan <?php echo $month ?></h2>

					</div>
					<div class="col-md-4 month-pick">
						<div class="input-group date pull-right" id="datepicker" data-date="<?php echo date('m-Y') ?>" data-date-format="mm-yyyy">
							 <span class="input-group-addon add-on"><span class="glyphicon glyphicon-th"></span></span>	
							 <input type="text" name="date" id="datepick" class="form-control" readonly="readonly" placeholder="Select Month">	  
					    </div>
					</div>
				</div>
				<div class="alert alert-warning" style="margin-bottom: 2px!important;"><i class="fa fa-exclamation-circle"></i>&nbsp;Jumlah Cicilan Pembayaran Diamond Bulan <?php echo $month ?>&nbsp;:&nbsp;<?php echo NZD($trans_cicilan,2,'.',''); ?></div>

				<div class="alert alert-warning" style="margin-top: 0px!important;margin-bottom: 2px;"><i class="fa fa-exclamation-circle"></i>&nbsp;Jumlah Pembayaran Emas Bulan <?php echo $month ?>&nbsp;:&nbsp;<?php echo number_format($trans_emas).' gr'; ?></div>
						

					
				<div class="row">
				<!-- Loading Bars -->
				<section class="bar">
					<div class="col-md-6">
						<div id="gold">
							<!-- Gold -->
							<h2>Gold</h2>
							Pembelian:&nbsp;<?php echo number_format($trans_gold,2); ?>&nbsp;gr&nbsp;/&nbsp;<?php echo $gold; ?>&nbsp;gr 
						</div>
						<a href="<?php echo base_url('new_budget/edit/'.$month.'/'.$year.'/gold/') ?>" class="btn btn-default">Edit Budget Gold</a>
					</div>
					<div class="col-md-6">
						<div id="diamond">
							<!-- Diamond -->
							<h2>Diamond</h2>
							Pembelian:&nbsp;<?php echo NZD($trans_diamond); ?>&nbsp;/&nbsp;<?php echo NZD($diamond); ?> 
						</div>
						<a href="<?php echo base_url('new_budget/edit/'.$month.'/'.$year.'/diamond/') ?>" class="btn btn-default">Edit Budget Diamond</a>
					</div>
				</section>
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
			window.location.replace("<?php echo base_url('main/month') ?>/"+$('#datepick').val());
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
$( document ).ready(function() {

	var bar_gold = new ProgressBar.Line(gold, {
	  strokeWidth: 1,
	  easing: 'easeInOut',
	  duration: 1400,
	  color: '#FFEA82',
	  trailColor: '#bdc3c7',
	  trailWidth: 1,
	  svgStyle: {width: '100%', height: '80px'},
	  text: {
        autoStyleContainer: true,
        alignToBottom: true,
        style: {
            color: '#fff',
            position: 'absolute',
            left: '42%',
            top: '48%',

          },
    	},
    	step: (state, bar) => {
		  bar.setText(Math.round(bar.value() * 100) + ' %');
		}
	});

	var bar_diamond = new ProgressBar.Line(diamond, {
	  strokeWidth: 1,
	  easing: 'easeInOut',
	  duration: 1400,
	  color: '#3498db',
	  trailColor: '#bdc3c7',
	  trailWidth: 1,
	  svgStyle: {width: '100%', height: '80px'},
	  text: {
        autoStyleContainer: true,
        alignToBottom: true,
        style: {
            color: '#fff',
            position: 'absolute',
            left: '42%',
            top: '48%'
          },
    	},
	  step: (state, bar) => {
		  bar.setText(Math.round(bar.value() * 100) + ' %');
		}
	});


	bar_gold.animate(<?php echo $ratio_gold; ?>);
	bar_diamond.animate(<?php echo $ratio_diamond; ?>);

});
</script>