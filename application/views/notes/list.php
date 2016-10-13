<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">
					

				<h1 class="title" align="center">Notes </h1>
				
				<div class="col-md-8" style="margin-bottom: 20px">
					
					<label for="">Search :</label>
					<input type="text" class="form-control" id="filter" style="width: 50%">
				</div>	
					
					<div class="col-md-4" style="padding-top: 25px;">
						<a href="<?php echo base_url('notes/add_notes') ?>" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Notes Baru</a>
					</div>
				</div>

				<div class="table-responsive toggle-circle-filled">
	        		<table class="table table-condensed" data-filter="#filter" data-page-size="10" id="table_note">
						<thead>
							 <tr>
							 	<th data-toggle="true" data-type="numeric" data-sort-initial="true">No</th>
							 	<th >Judul</th>
							 	<th data-hide="all">Isi Notes:</th>
							 	<th data-hide="phone">Tanggal</th>
							 	<th data-hide="phone">Tindakan</th>
							 	
							 </tr>
						</thead>
						<tbody>
						<?php if($notes != NULL): ?>
							<?php $i = 1; foreach($notes as $note): ?>
								<tr>
									<td><?php echo $i.'.' ?></td>
									<td><?php echo $note->title ?></td>
									
									<td><?php echo $note->content ?></td>
									<td><?php echo date('d-M-Y H:i',strtotime($note->created)) ?></td>
									<td><a href="<?php echo base_url('notes/edit/'.$note->id) ?>" style="margin-right: 5px"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a> <a  onclick="return confirm('Anda yakin ingin menghapus <?php echo "\'".$note->title."\'" ?>?')" href="<?php echo base_url('notes/delete/'.$note->id) ?>"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></td>
								</tr>
							<?php $i++; endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="4"><h2 align="center">Belum ada Notes</h2></td>
							</tr>
						<?php endif; ?>
						</tbody>
						<tfoot class="hide-if-no-paging">
							<td colspan="4">
								<div class="pagination"></div>
							</td>
							
						</tfoot>
	        		</table>
        		</div>
        	</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
   	 $('#table_note').footable();
	} );
</script>