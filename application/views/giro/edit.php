<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<h1 class="title" align="center">Ubah Giro</h1>
				<?php echo form_open('giro/edit/'.$transaction1->id) ?>
					<select name="transaction" id="transaction" onchange="get_amount(this)" class="form-control">
						<option value="">--pilih transaksi--</option>
						<?php foreach ($transactions as $transaction): ?>
							<?php if ($transaction->type == 'diamond') {
								$amount = NZD($transaction->amount);
								

							}else{
								$amount = number_format($transaction->weight,2).' g';

								} ?>
							<option value="<?php echo $transaction->id ?>" <?php echo ($transaction1->id == $transaction->id)? "selected" : ""; ?>><?php echo date('d-M-Y',strtotime($transaction->created)).' - '.$amount.' - '.$transaction->diamond_type.' ('.$transaction->name.') - '.$transaction->description ?></option>
						<?php endforeach ?>
					</select>
					<p style="display: inline-block; font-weight: bold; padding-top: 15px">Total :&nbsp;</p><p style="display: inline-block; padding-top: 15px;font-weight: bold" id="harga">
						<?php 
							if($transaction1->type == 'diamond'){
								echo NZD($transaction1->amount);
							}else{
								if($transaction1->diamond_type == 'Logam Mulia'){
									echo rupiah($configuration->emas_lm * $transaction->weight);
								}else{
									echo rupiah($configuration->emas_24 * $transaction->weight);
								}
							}
						 ?>
					</p>
					<a style="cursor: pointer; margin: 10px 0" onclick="giro()" class="btn btn-primary pull-right">+ Giro</a>
					<table class="table">
					<tbody>
						<input type="hidden" name="transaction" value="<?php echo $transaction1->id ?>">
						<?php foreach ($giros as $giro):?>
							<tr class="form-group">
								<td>
									<input type="text" name="nomor[]" class="form-control" value="<?php echo $giro->giro ?>" placeholder="Nomor Giro">
								</td>
								<td>
									<input type="date" name="tanggal[]" max='+"<?php echo $latest_payment ?>"+' min='+"<?php echo $transaction1->start_payment ?>"+' value="<?php echo $giro->due ?>" class="form-control"  placeholder="Tanggal">
								</td>
								<td>
									<input type="text" name="jumlah[]" class="form-control jumlah" value="<?php echo $giro->amount ?>"  placeholder="Jumlah" onblur="calc()">
								</td>
							</tr>
						<?php endforeach; ?>
						
					</tbody>
					<tfoot>
						<tr>
							<td colspan="3">
								<input type="submit" name="ubah" id="buat_giro" class="btn btn-default pull-right" value="Buat Giro" disabled>
							</td>
						</tr>
					</tfoot>
					</table>
					
				<?php echo form_close() ?>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</section>
<script>
	var min;
	var max;
</script>
<script>

	function get_amount(el){
		
  		location.replace("<?php echo base_url('giro/index') ?>" + "/"+ $(el).val());
		
	}

	function calc(){
		var id = <?php echo $transaction1->id ?>;

		var harga = 0;

		$.ajax({
        	url:"<?php echo base_url('giro/get_transaction') ?>" + '/' + id,
        	type: 'GET',
        	success: function(result){
        		harga = result;
        	}
        });

       
		setTimeout(function(){
			
			harga = harga.substr(0, harga.length - 2);
			harga = harga.replace(/[^0-9]/g, "");

			var inputs = document.getElementsByClassName( 'jumlah' ),
		    total  = [].map.call(inputs, function( input ) {
		        return input.value;
		    }).join( ' ' );

		    //tt itu total

		    total = total.split(" ");
		    var tt = 0;
		    for(var i = 0; i < total.length ; i++){
		    	tt += +total[i];
		    }
		    harga = +harga - +tt;
		    var type;
		    $.ajax({
        	url:"<?php echo base_url('giro/get_type') ?>" + '/' + id,
        	type: 'GET',
        	success: function(result){
	        		type = result
	        	}
	        });

		    if(harga < 0){
		    	alert('Jumlah giro harus sesuai jumlah pembayaran');
		    	$('#buat_giro').attr('disabled','disabled');
		    }else if(harga == 0){
		    	$('#buat_giro').removeAttr('disabled')
		    }else{
		    	$('#buat_giro').attr('disabled','disabled');
		    }	

	        setTimeout(function(){
		        if(type == 'diamond'){
		        	$('#harga').empty();
		    		$('#harga').append('$ '+ (harga).formatMoney(2));
		        }else{
		        	$('#harga').empty();
		    		$('#harga').append('Rp. '+ (harga).formatMoney(2,',','.'));
		        }
	    	},100);
		    
		}, 100);

	    

	}

	Number.prototype.formatMoney = function(c, d, t){
	var n = this, 
	    c = isNaN(c = Math.abs(c)) ? 2 : c, 
	    d = d == undefined ? "." : d, 
	    t = t == undefined ? "," : t, 
	    s = n < 0 ? "-" : "", 
	    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
	    j = (j = i.length) > 3 ? j % 3 : 0;
	   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	 };
</script>

<script>
	function giro(){
		$('tbody').append('<tr class="form-group"><td><input type="text" name="nomor[]" class="form-control" required="required" placeholder="Nomor Giro"></td><td><input type="date" name="tanggal[]" max='+"<?php echo $latest_payment ?>"+' min='+"<?php echo $transaction1->start_payment ?>"+' class="form-control" required="required" placeholder="Tanggal"></td><td><input type="text" name="jumlah[]" class="form-control jumlah" required="required" placeholder="Jumlah" onblur="calc()"></td></tr>');
	}
</script>

<script>
	$(document).ready(function(){
		var id = <?php echo $transaction1->id ?>;

		var harga = 0;

		$.ajax({
        	url:"<?php echo base_url('giro/get_transaction') ?>" + '/' + id,
        	type: 'GET',
        	success: function(result){
        		harga = result;
        	}
        });

       
		setTimeout(function(){
			
			harga = harga.substr(0, harga.length - 2);
			harga = harga.replace(/[^0-9]/g, "");

			var inputs = document.getElementsByClassName( 'jumlah' ),
		    total  = [].map.call(inputs, function( input ) {
		        return input.value;
		    }).join( ' ' );

		    //tt itu total

		    total = total.split(" ");
		    var tt = 0;
		    for(var i = 0; i < total.length ; i++){
		    	tt += +total[i];
		    }
		    harga = +harga - +tt;
		    var type;
		    $.ajax({
        	url:"<?php echo base_url('giro/get_type') ?>" + '/' + id,
        	type: 'GET',
        	success: function(result){
	        		type = result
	        	}
	        });

		    if(harga < 0){
		    	alert('Jumlah giro harus sesuai jumlah pembayaran');
		    	$('#buat_giro').attr('disabled','disabled');
		    }else if(harga == 0){
		    	$('#buat_giro').removeAttr('disabled')
		    }else{
		    	$('#buat_giro').attr('disabled','disabled');
		    }	

	        setTimeout(function(){
		        if(type == 'diamond'){
		        	$('#harga').empty();
		    		$('#harga').append('$ '+ (harga).formatMoney(2));
		        }else{
		        	$('#harga').empty();
		    		$('#harga').append('Rp. '+ (harga).formatMoney(2,',','.'));
		        }
	    	},100);
		    
		}, 100);

	});
</script>