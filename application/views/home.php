<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<!-- Content -->
				<div class="month-picker row">
					<div class="col-md-8">
						<h1>Budget Bulan <?php echo $month ?></h1>
					</div>
					<div class="col-md-4 month-pick">
						<div class="input-group date pull-right" id="datepicker" data-date="<?php echo date('m-Y') ?>" data-date-format="mm-yyyy">
							 <span class="input-group-addon add-on"><span class="glyphicon glyphicon-th"></span></span>	
							 <input type="text" name="date" id="datepick" class="form-control" readonly="readonly" placeholder="Select Month">	  
					    </div>
					</div>
				</div>
				<!-- Loading Bars -->
				<section class="bar">
					<div id="gold">
						<!-- Gold -->
						<h2>Gold</h2>
						Pembelian:&nbsp;<?php echo $trans_gold; ?>&nbsp;gr&nbsp;/&nbsp;<?php echo $gold; ?>&nbsp;gr 
					</div>
					
					<div id="diamond">
						<!-- Diamond -->
						<h2>Diamond</h2>
						Pembelian:&nbsp;<?php echo NZD($trans_diamond); ?>&nbsp;/&nbsp;<?php echo NZD($diamond); ?> 
					</div>
				</section>
			</div>	
			<div class="col-md-1"></div>
		</div>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				
				<!-- Loading Bars -->
				<section class="bar">
					<div id="cicilan">
						<!-- Cicilan -->
						<h2>Limit Cicilan Bulan <?php echo $month ?></h2>
						Pembelian:&nbsp;<?php echo NZD($trans_gold); ?>&nbsp;/&nbsp;<?php echo NZD($gold); ?>
					</div>
				</section>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</section>
<?php $trans_cicilan = number_format($trans_cicilan,2,'.','');
echo date('F',strtotime('2016-10')) ?>
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
	  svgStyle: {width: '100%', height: '100px'},
	  text: {
        autoStyleContainer: true,
        alignToBottom: true,
        style: {
            color: '#fff',
            position: 'absolute',
            left: '42%',
            top: '45%',

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
	  svgStyle: {width: '100%', height: '100px'},
	  text: {
        autoStyleContainer: true,
        alignToBottom: true,
        style: {
            color: '#fff',
            position: 'absolute',
            left: '42%',
            top: '45%'
          },
    	},
	  step: (state, bar) => {
		  bar.setText(Math.round(bar.value() * 100) + ' %');
		}
	});

	var bar_cicilan = new ProgressBar.Line(cicilan, {
	  strokeWidth: 1,
	  easing: 'easeInOut',
	  duration: 1400,
	  color: '#e67e22',
	  trailColor: '#bdc3c7',
	  trailWidth: 1,
	  svgStyle: {width: '100%', height: '100px'},
	  text: {
        autoStyleContainer: true,
        alignToBottom: true,
        style: {
            color: '#fff',
            position: 'absolute',
            left: '42%',
            top: '45%'
          }
    	},
    	step: (state, bar) => {
		  bar.setText(Math.round(bar.value() * 100) + ' %');
		}
	});

	bar_cicilan.animate(<?php echo $ratio_cicilan ?>)
	bar_gold.animate(<?php echo $ratio_gold; ?>);
	bar_diamond.animate(<?php echo $ratio_diamond; ?>);

});
</script>