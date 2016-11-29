<h4>Membuat jadwal meeting</h4>

<div class="panel panel-default">
	<div class="panel-body">
    	<h5 align="center">
    		<b>
    			<?php
    				if ($step == 1) {
    					echo 'Nama dan Deskripsi Meeting ';
    				}else if ($step == 2) {
    					echo 'Tempat dan Durasi Meeting';
    				}else if ($step == 3) {
    					echo 'Peran dan Kuorum Meeting';
    				}else if ($step == 4) {
    					echo 'Kesimpulan pembuatan jadwal meeting';
    				}
    			?>
    			<?php echo $step ?>/4
    		</b>
    	</h5>
	</div>
		<?php
			if ($step == 1) {
		?>
		<form id="form2" action="<?php echo base_url('home/add_meeting'); ?>" method="POST" class="form-horizontal form-label-left" accept-charset="utf-8">
		<div class="form-group">
        	<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="m_name">Nama Meeting</label>
        	<div class="col-md-6">
        		<input type="text" name="m_name" id="m_name" class="form-control" value="<?php if(isset($m_name)) echo $m_name; ?>" placeholder="" required />
        	</div>
        </div>
        
        <div class="form-group">
        	<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="m_desc">Deskripsi</label>
        	<div class="col-md-6">
        		<textarea name="m_desc" id="m_desc" class="form-control" rows="4" cols="50" required /><?php if(isset($m_desc)) echo $m_desc; ?></textarea>
        	</div>
        </div>
		<div class="clearfix">
			
		</div>
        <center>
        	<input type="submit" class="btn btn-default btn-sm" name="submit<?php echo $step ?>" value="Selanjutnya" required />
        </center>
		<?php
			}else if ($step == 2) {
		?>
		<form id="form2" action="<?php echo base_url('home/add_meeting'); ?>" method="POST" class="form-horizontal form-label-left" accept-charset="utf-8">
		    <div class="form-group">
        	<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="venue">Tempat</label>
        	<div class="col-md-6">
        		<input type="text" name="venue" id="venue" class="form-control" value="<?php if(isset($venue)) echo $venue; ?>" placeholder=""required />
        	</div>
        </div>

        <div class="form-group">
        	<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="duration">Durasi</label>
        	<div class="col-md-6">
        		<input type="text" name="duration" id="duration" class="form-control" value="<?php if(isset($duration)) echo $duration; ?>" placeholder="" required />
        	</div>
        </div>

        <div class="form-group">
        	<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="period">Periode Meeting</label>
        	<div class="col-md-6 col-sm-6 col-xs-12">
    			<div class="form-group">
    				<label class="col-md-offset-1" for="">Start</label>
        			<div class="col-md-12">
		        		<input type="date" name="start" id="period" class="form-control" value="<?php if(isset($m_start)) echo $m_start; ?>" placeholder="Start" required />
		        	</div>
    			</div>
    			<div class="form-group">
		        	<label class="col-md-offset-1" for="">End</label>
		        	<div class="col-md-12 col-sm-12 col-xs-12">
		        		<input type="date" name="end" id="period" class="form-control" value="<?php if(isset($m_end)) echo $m_end; ?>" placeholder="End" required />
		        	</div>
		        </div>
        	</div>
        </div>
		<div class="clearfix">
			
		</div>
        <center>
        	<a href="<?php base_url('home/meeting/'); ?>1" title=""><button type="button" class="btn btn-default btn-sm">Sebelumnya</button></a>
        	<input type="submit" class="btn btn-default btn-sm" name="submit<?php echo $step ?>" value="Selanjutnya" required />
        </center>
		<?php
			}else if ($step == 3) {
				if ($this->session->has_userdata('n')) {
	        		$n = $this->session->userdata('n');
	        	}
		?>
	        <form id="form2" action="<?php echo base_url('home/listrole'); ?>" method="GET" accept-charset="utf-8">
				    <div class="form-group">
		        	<label class="control-label col-md-5 col-sm-3 col-xs-12" for="n_role">Jumlah yang dibutuhkan</label>
		        	<div class="col-md-6">
		        		<!-- <input type="number" name="n_role" id="n_role" class="form-control" value="" placeholder="" required /> -->
		        		<div class="input-group">
					      <input type="text" value="<?php if(isset($n)) echo $n; ?>" class="form-control" name="n" placeholder="">
					      <span class="input-group-btn">
					        <input class="btn btn-default" type="submit" value="Tambah">
					      </span>
					    </div><!-- /input-group -->
		        	</div>
		        </div>
	        </form>
	        <div class="clearfix">
	        	
	        </div>
	        <br>
          <script type="text/javascript" charset="utf-8" async defer>
            function add_person(id)
            {
              var element = document.getElementById('nama'+id);
              var x = element.value;
              var el = document.getElementById('person'+x);
              var y = el.value;
              var div = document.getElementById('dname'+id);

              var new_element = document.createElement('input');
              new_element.setAttribute('type', 'text');
              new_element.setAttribute('readonly', 'readonly');
              new_element.setAttribute('style', 'border:none;');
              new_element.setAttribute('value', y);
              new_element.setAttribute('name', 'rolelist[]');

              div.appendChild(new_element);
            }
          </script>
          <?php
            foreach ($listperson as $value) {
          ?>
              <input type="hidden" name="person<?php echo $value->p_id; ?>" id="person<?php echo $value->p_id; ?>" value="<?php echo $value->p_name; ?>">
          <?php
            }
          ?>
          <form id="form2" action="<?php echo base_url('home/add_meeting'); ?>" method="POST" class="form-horizontal form-label-left" accept-charset="utf-8">
	        <?php
	        	if (isset($n)) {
	        		$c = 1;
	        		for ($i = 1; $i <= $n ; $i++) {
	        ?>
	        <div class="col-md-4">
		        <div class="form-group">
	        		<input type="text" name="mr_name[]" class="form-control" value="" placeholder="Nama Peran <?php echo $i ?>" required />
	        		<input type="number" min="0" max="100" name="pro_quo[]" class="form-control" value="" placeholder="Kuorum" required />
	        		<select id="nama<?php echo $i; ?>" name="nama[]" class="form-control" required >
	        			<option value="">--- Nama ---</option>
	        			<?php
	        				if ($listperson != NULL) {
	        					foreach ($listperson as $value) {
	        						echo "<option value='".$value->p_id."'>" .$value->p_name ."</option>";
	        					}
	        				}
	        			?>
	        		</select>
              <button type="button" onclick="add_person(<?php echo $i; ?>)" class="btn btn-default btn-sm">Tambahkan</button>
              <div class="container-fluid" id="dname<?php echo $i; ?>">
                
              </div>
		        </div>
	        </div>
	        <?php
	        		}
	        	}
	        ?>

	        <div class="clearfix">
			
			</div>
	        <center>
	        	<a href="<?php base_url('home/meeting/'); ?>2" title=""><button type="button" class="btn btn-default btn-sm">Sebelumnya</button></a>
	        	<input type="submit" class="btn btn-default btn-sm" name="submit<?php echo $step ?>" value="Selanjutnya" required />
	        </center>
	        </form>
		<?php
			}else if ($step == 4) {
		?>
			<div class="col-md-12 col-sm-12">
				<table class="table">
					<tbody>
						<tr>
							<td><b>Nama Meeting </b></td>
							<td> : </td>
							<td><?php echo $this->session->userdata('m_name'); ?></td>
						</tr>

						<tr>
							<td><b>Deskripsi Meeting </b></td>
							<td> : </td>
							<td><?php echo $this->session->userdata('m_desc'); ?></td>
						</tr>

						<tr>
							<td><b>Tempat Meeting </b></td>
							<td> : </td>
							<td><?php echo $this->session->userdata('venue'); ?></td>
						</tr>

					</tbody>
				</table>
			</div>

			<div class="col-md-12 col-sm-12">
				<table class="table">
					<tbody>
						<?php
							for ($i = 0; $i < $this->session->userdata('n'); $i++) {
								echo '<tr>';
								echo '<td>' .$_SESSION['mr_name'][$i] .'</td>';
								echo '<td> : </td>';
								echo '<td>Kuorum ' .$_SESSION['pro_quo'][$i] .'%</td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
			</div>

			<div class="col-md-12 col-sm-12">
          <div class="col-md-6 col-sm-6 col-xs-12" align="right">
            <form action="<?php echo base_url('home/carijadwal'); ?>" method="POST" accept-charset="utf-8">
              <input type="hidden" name="m_id" value="<?php echo $m_id; ?>">
              <input class="btn btn-default btn-sm" type="submit" name="cari" value="Cari jadwal">
            </form>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <!-- <form action="<?php echo base_url('home/simpan_perubahan') ?>" method="POST" accept-charset="utf-8"> -->
              <a href="<?php echo base_url('home/index/rdr'); ?>" title="">
              	<input class="btn btn-default btn-sm" type="submit" name="simpan" value="Simpan perubahan">
              </a>
            <!-- </form> -->
          </div>
			</div>
		<?php
				$this->session->sess_destroy();
			}
		?>
		<div class="clearfix">
	        	
	    </div>
        <br>
	</form>
</div>