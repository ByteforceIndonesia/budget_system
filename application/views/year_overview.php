<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
			<h1 class="title" align="center">Year Overview</h1>
			<h2>Gold</h2>
        		<canvas id="canvas_gold"></canvas>
        	<br><br>
        	<h2>Diamond</h2>
        		<canvas id="canvas_diamond"></canvas>
        	<br><br><br><br>
        	</div>
			<div class="col-md-1"></div>
	    </div>

	    <script>
	        var barChartDataGold = {
	            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
	            datasets: [{
	                label: 'Monthly Limit',
	                backgroundColor: "rgba(241, 196, 15,0.5)",
	                data: [<?php echo $gold ?>]
	            }]
	        };

	        var barChartDataDiamond = {
	            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
	            datasets: [{
	                label: 'Monthly Limit',
	                backgroundColor: "rgba(52, 152, 219,0.5)",
	                data: [<?php echo $diamond ?>]
	            }]
	        };

	        window.onload = function() {
	            var ctx = document.getElementById("canvas_gold").getContext("2d");
	            window.myBar = new Chart(ctx, {
	                type: 'bar',
	                data: barChartDataGold,
	                options: {
	                    // Elements options apply to all of the options unless overridden in a dataset
	                    // In this case, we are setting the border of each bar to be 2px wide and green
	                    elements: {
	                        rectangle: {
	                            borderWidth: 2,
	                            borderColor: 'rgb(0, 0, 0, 0.7)',
	                            borderSkipped: 'bottom'
	                        }
	                    },
	                    responsive: true,
	                    legend: {
	                        position: 'top',
	                    },
	                    title: {
	                        display: true,
	                        text: 'Yearly Limit for Gold'
	                    }
	                }
	            });

	            var ctx = document.getElementById("canvas_diamond").getContext("2d");
	            window.myBar = new Chart(ctx, {
	                type: 'bar',
	                data: barChartDataDiamond,
	                options: {
	                    // Elements options apply to all of the options unless overridden in a dataset
	                    // In this case, we are setting the border of each bar to be 2px wide and green
	                    elements: {
	                        rectangle: {
	                            borderWidth: 2,
	                            borderColor: 'rgb(0, 0, 0, 0.7)',
	                            borderSkipped: 'bottom'
	                        }
	                    },
	                    responsive: true,
	                    legend: {
	                        position: 'top',
	                    },
	                    title: {
	                        display: true,
	                        text: 'Yearly Limit for Diamond'
	                    }
	                }
	            });
	        };
	    </script>
		</div>
	</div>
</section>