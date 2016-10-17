<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<h1 class="title" align="center">Buat Giro</h1>
				<?php echo form_open('giro/new') ?>
					<select name="transaction" id="transaction" onchange="get_amount(this)" class="form-control">
						<option value="">--pilih transaksi--</option>
						<?php foreach ($transactions as $transaction): ?>
							<?php if ($transaction->type == 'diamond') {
								$amount = NZD($transaction->amount);
								

							}else{
								$amount = number_format($transaction->weight,2).' g';

								} ?>
							<option value="<?php echo $transaction->id ?>"><?php echo date('d-M-Y',strtotime($transaction->created)).' - '.$amount.' - '.$transaction->diamond_type.' ('.$transaction->name.') - '.$transaction->description ?></option>
						<?php endforeach ?>
					</select>
					<?php echo form_close() ?>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</section>

<script>

	function get_amount(el){
		
  		location.replace("<?php echo base_url('giro/index') ?>" + "/"+ $(el).val());
		
	}

	</script>
