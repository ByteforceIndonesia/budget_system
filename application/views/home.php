<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<!-- Content -->
				<div class="month-picker row">
					<div class="col-md-8">
						<h1><?php echo $month ?>'s Budget</h1>
					</div>
					<div class="col-md-4 month-pick">
						<div class="input-group date pull-right" id="datepicker" data-date="<?php echo date('m-Y') ?>" data-date-format="mm-yyyy">
							 <span class="input-group-addon add-on"><span class="glyphicon glyphicon-th"></span></span>	
							 <input type="text" name="date" id="datepick" class="form-control" readonly="readonly" placeholder="Select Month">	  
							   
					    </div>
					</div>
				</div>
				<br><br>
				<!-- Loading Bars -->
				<section class="bar">
					<div id="gold">
						<!-- Gold -->
						<h2>Gold</h2>
					</div>
					
					<div id="diamond">
						<!-- Diamond -->
						<h2>Diamond</h2>
					</div>
				</section>
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
	  trailColor: '#eee',
	  trailWidth: 1,
	  svgStyle: {width: '100%', height: '150px'},
	  text: {
        value: <?php echo $trans_gold; ?>+ ' of ' +<?php echo $gold; ?>+' gr', 
        autoStyleContainer: true,
        alignToBottom: true,
        style: {
            color: '#fff',
            position: 'absolute',
            left: '27%',
            top: '40%',

          },
    	}
	});

	var bar_diamond = new ProgressBar.Line(diamond, {
	  strokeWidth: 1,
	  easing: 'easeInOut',
	  duration: 1400,
	  color: '#3498db',
	  trailColor: '#eee',
	  trailWidth: 1,
	  svgStyle: {width: '100%', height: '150px'},
	  text: {
        value: <?php echo $trans_diamond; ?>+ ' of $' +<?php echo $diamond; ?>, 
        autoStyleContainer: true,
        alignToBottom: true,
        style: {
            color: '#fff',
            position: 'absolute',
            left: '35%',
            top: '45%'
          },
    	}
	});

	bar_gold.animate(<?php echo $ratio_gold; ?>);
	bar_diamond.animate(<?php echo $ratio_diamond; ?>);

});
</script>