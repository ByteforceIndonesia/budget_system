<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
			<h1><?php echo $month ?>'s Budget</h1>
			<br><br>
				<!-- Content -->
				<!-- Loading Bars -->
				<section class="bar">
					<div id="gold">
						<!-- Gold -->
						<h2>Gold</h2>
					</div>
					<br><br><br><br>
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
        value: <?php echo $trans_gold; ?>+ ' of $' +<?php echo $gold; ?>, 
        autoStyleContainer: true,
        alignToBottom: true,
        style: {
            color: '#fff',
            position: 'absolute',
            left: '25%',
            top: '25%'
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
        value: <?php echo $trans_diamond; ?>+ ' of ' +<?php echo $diamond; ?>+' gr', 
        autoStyleContainer: true,
        alignToBottom: true,
        style: {
            color: '#fff',
            position: 'absolute',
            left: '15%',
            top: '25%'
          },
    	}
	});

	bar_gold.animate(<?php echo $ratio_gold; ?>);
	bar_diamond.animate(<?php echo $ratio_diamond; ?>);

});
</script>