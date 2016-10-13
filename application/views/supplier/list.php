<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">
					

				<h1 class="title" align="center">Daftar Supplier </h1>
				
				<div class="col-md-8" style="margin-bottom: 20px">
					
					<label for="">Search :</label>
					<input type="text" class="form-control" id="filter" style="width: 50%">
				</div>	
					
					<div class="col-md-4" style="padding-top: 25px;">
						<a href="<?php echo base_url('supplier/add_supplier') ?>" class="btn btn-primary pull-right">Tambah Supplier</a>
					</div>
				</div>

				<div class="table-responsive toggle-circle-filled">
	        		<table class="table table-condensed" data-filter="#filter" data-page-size="10" id="table_supplier">
						<thead>
							 <tr>
							 	<th data-type="numeric" data-sort-initial="true">No</th>
							 	<th data-toggle="true">Nama Supplier</th>
							 	<th data-hide="phone">No. Telp</th>
							 	<th data-hide="phone,tablet">Alamat</th>
							 	<th data-hide="phone">Tindakan</th>
							 	
							 </tr>
						</thead>
						<tbody>
						<?php if($suppliers != NULL): ?>
							<?php $i = 1; foreach($suppliers as $supplier): ?>
								<tr>
									<td><?php echo $i.'.' ?></td>
									<td><?php echo $supplier->name ?></td>
									<td><a href="tel:<?php echo $supplier->phone ?>"><?php echo $supplier->phone ?></a></td>
									<td><?php echo $supplier->address ?></td>
									<td><a href="<?php echo base_url('supplier/edit/'.$supplier->id) ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a  onclick="return confirm('Anda yakin ingin menghapus <?php echo $supplier->name ?>?')" href="<?php echo base_url('supplier/delete/'.$supplier->id) ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
								</tr>
							<?php $i++; endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="4"><h2 align="center">Belum ada supplier</h2></td>
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
   	 $('#table_supplier').footable();
	} );
</script>