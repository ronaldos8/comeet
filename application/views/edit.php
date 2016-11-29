<h4>Edit Pertemuan</h4>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#step1" aria-controls="step1" role="tab" data-toggle="tab">Step 1</a></li>
    <li role="presentation"><a href="#step2" aria-controls="step2" role="tab" data-toggle="tab">Step 2</a></li>
    <li role="presentation"><a href="#step3" aria-controls="step3" role="tab" data-toggle="tab">Step 3</a></li>
    <li role="presentation"><a href="#step4" aria-controls="step4" role="tab" data-toggle="tab">Step 4</a></li>
  </ul>
<form id="form2" action="<?php echo base_url('schedule/update_meeting'); ?>" method="POST" class="form-horizontal form-label-left" accept-charset="utf-8">
	<!-- Tab panes -->
	<div class="tab-content">
    	<div role="tabpanel" class="tab-pane fade in active" id="step1">
  			<h5 align="center"><b>Nama dan Deskripsi Meeting</b></h5>
      		<div class="form-group">
        		<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="m_name">Nama Meeting</label>
        		<div class="col-md-6">
        			<input type="text" name="m_name" id="m_name" class="form-control" value="<?php echo $schedule->m_name; ?>" placeholder="" required />
        		</div>
        	</div>
        
        	<div class="form-group">
        		<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="m_desc">Deskripsi</label>
        		<div class="col-md-6">
        			<textarea name="m_desc" id="m_desc" class="form-control" rows="4" cols="50" required /><?php echo $schedule->m_desc; ?></textarea>
 		       	</div>
        	</div>
			<div class="clearfix">
				
			</div>
        </div>
	    <div role="tabpanel" class="tab-pane fade" id="step2">
	    	<h5 align="center"><b>Tempat dan Durasi Meeting</b></h5>
	      	<div class="form-group">
	        	<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="venue">Tempat</label>
	        	<div class="col-md-6">
	        		<input type="text" name="venue" id="venue" class="form-control" value="<?php echo $schedule->venue; ?>" placeholder=""required />
	        	</div>
	        </div>

	        <div class="form-group">
	        	<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="duration">Durasi</label>
	        	<div class="col-md-6">
	        		<input type="text" name="duration" id="duration" class="form-control" value="<?php echo $schedule->duration; ?>" placeholder="" required />
	        	</div>
	        </div>

	        <div class="form-group">
	        	<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="period">Periode Meeting</label>
	        	<div class="col-md-6 col-sm-6 col-xs-12">
	    			<div class="form-group">
	    				<label class="col-md-offset-1" for="">Start</label>
	        			<div class="col-md-12">
			        		<input type="date" name="start" id="period" class="form-control" value="<?php echo $schedule->start_period; ?>" placeholder="Start" required />
			        	</div>
	    			</div>
	    			<div class="form-group">
			        	<label class="col-md-offset-1" for="">End</label>
			        	<div class="col-md-12 col-sm-12 col-xs-12">
			        		<input type="date" name="end" id="period" class="form-control" value="<?php echo $schedule->end_period; ?>" placeholder="End" required />
			        	</div>
			        </div>
	        	</div>
	        </div>
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="step3">
	    	<h5 align="center"><b>Peran dan Kuorum Meeting</b></h5>
	      	<!-- <form action="<?php echo base_url('schedule/listrole'); ?>" method="POST" id="form2" accept-charset="utf-8">
				<div class="form-group">
		        	<label class="control-label col-md-5 col-sm-3 col-xs-12" for="n_role">Jumlah yang dibutuhkan</label>
		        	<div class="col-md-6">
		        		<div class="input-group">
					      <input type="text" value="<?php echo $schedule->n_accomodate; ?>" class="form-control" name="n" placeholder="">
					      <span class="input-group-btn">
					        <input class="btn btn-default" type="submit" value="Tambah">
					      </span>
					    </div>
		        	</div>
		        </div>
		    </form> -->
		    
		        <?php
		        	$n = $schedule->n_accomodate;
		        	if (isset($n)) {
		        		$i = 1;
		        		foreach ($personnel_schedule as $value) {
		        ?>
		        <div class="col-md-4">
			        <div class="form-group">
		        		<input type="text" name="mr_name[<?php echo $value->mr_id; ?>]" class="form-control" value="<?php echo $value->mr_name; ?>" placeholder="Nama Peran <?php echo $i ?>" required />
		        		<input type="number" min="0" max="100" name="pro_quo[<?php echo $value->mr_id; ?>]" class="form-control" value="<?php echo $value->pro_quo; ?>" placeholder="Kuorum" required />

		        		<select name="nama[<?php echo $value->mr_id; ?>]" class="form-control" required >
		        			<option value="">--- Nama ---</option>
		        			<?php
		        				if ($listperson != NULL) {
		        					foreach ($listperson as $value2) {
		        			?>
		        						<option value="<?php echo $value2->p_id; ?>" <?php if($value2->p_id == $value->p_id) echo "selected"; ?>><?php echo $value2->p_name; ?></option>
		        			<?php
		        					}
		        				}
		        			?>
		        		</select>
			        </div>
		        </div>
		        <?php
		        		$i++;
		        		}
		        	}
		        ?>

		        <div class="clearfix">
				
				</div>
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="step4">
	    	<br>
			<!-- <div class="col-md-12 col-sm-12">
				<table class="table">
					<tbody>
						<tr>
							<td><b>Nama Meeting </b></td>
							<td> : </td>
							<td><?php echo $schedule->m_name; ?></td>
						</tr>

						<tr>
							<td><b>Deskripsi Meeting </b></td>
							<td> : </td>
							<td><?php echo $schedule->m_desc; ?></td>
						</tr>

						<tr>
							<td><b>Tempat Meeting </b></td>
							<td> : </td>
							<td><?php echo $schedule->venue; ?></td>
						</tr>

					</tbody>
				</table>
			</div> -->

			<!-- <div class="col-md-12 col-sm-12">
				<table class="table">
					<tbody>
						<?php
							foreach ($personnel_schedule as $value) {
								echo '<tr>';
								echo '<td>' .$value->mr_name .'</td>';
								echo '<td> : </td>';
								echo '<td>Kuorum ' .$value->pro_quo .'%</td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
			</div> -->
			<div class="col-md-12 col-sm-12" align="center">
				<input type="hidden" name="m_id" value="<?php echo $schedule->m_id; ?>">
				<input type="hidden" name="n" value="<?php echo $schedule->n_accomodate; ?>">
				<input type="submit" name="update" class="btn btn-default btn-sm" value="Simpan perubahan">
			</div>
	    </div>
  	</div>
</form>

</div>