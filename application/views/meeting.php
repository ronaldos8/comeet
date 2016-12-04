<script type="text/javascript" charset="utf-8" async defer>
	function minggu(x)
	{
		var date = new Date();

		// mengambil nilai start
		var start = document.getElementById('start_period');
		var val1 = start.value;
		var arr = val1.split('-', 3);
		var s_full = date.setFullYear(arr[0], arr[1], arr[2]);

		// mengambil tanggal terakhir bulan ini
		var lastDay = 32 - new Date(arr[0], arr[1], 32).getDate();

		// mengambil waktu seminggu kemudian dari start
		if (x == 1) {
			var e_day = parseInt(arr[2]) + parseInt(7);
		}else if(x == 2) {
			var e_day = parseInt(arr[2]) + parseInt(14);
		}else if(x == 3) {
			var e_day = parseInt(arr[2]) + parseInt(21);
		}
		var e_month;
		if (e_day > lastDay) {
			e_month = parseInt(arr[1]) + parseInt(1);
			e_day = e_day - lastDay;
			if (e_day < 10) {
				e_day = "0"+e_day;
			}
		}else {
			e_month = parseInt(arr[1]);
		}
		var e_year;
		if (e_month > 12) {
			e_month = e_month - 12;
			if (e_month < 10) {
				e_month = "0"+e_month;
			}
			e_year = parseInt(arr[0]) + parseInt(1);
		}else {
			e_year = parseInt(arr[0]);
		}
		var val = e_year+"-"+e_month+"-"+e_day;

		// mengisi end period
		var end  = document.getElementById('end_period');
		end.value = val;
	}
</script>
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
	  // new_element.setAttribute('name', 'rolelist'+id+'[]');

	  var new_element2 = document.createElement('input');
	  new_element2.setAttribute('type', 'hidden');
	  // new_element2.setAttribute('readonly', 'readonly');
	  // new_element2.setAttribute('style', 'border:none;');
	  new_element2.setAttribute('value', x);
	  new_element2.setAttribute('name', 'rolelist'+id+'[]');

	  div.appendChild(new_element);
	  div.appendChild(new_element2);
	}

	function sembunyikan(x)
	{
		var str = x.value;
		
		// var op = document.getElementById('op'+str);
		var op = document.getElementsByClassName('op'+str);
		// alert(str);
		var z = op.setAttribute('hidden', 'hidden');
		alert(op);
	}
</script>

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
    				<label class="col-md-offset-1" for="start_period">Start</label>
        			<div class="col-md-12">
		        		<input type="date" name="start" id="start_period" class="form-control" value="<?php if(isset($m_start)) echo $m_start; ?>" placeholder="Start" required />
		        	</div>
    			</div>
    			<div class="form-group">
		        	<label class="col-md-offset-1" for="">Rentang</label>
		        	<div class="col-md-12 col-sm-12 col-xs-12">
		        		<button type="button" class="btn btn-default btn-sm" onclick="minggu(1)">1 Minggu</button>
		        		<button type="button" class="btn btn-default btn-sm" onclick="minggu(2)">2 Minggu</button>
		        		<button type="button" class="btn btn-default btn-sm" onclick="minggu(3)">3 Minggu</button>
		        	</div>
		        </div>
    			<div class="form-group">
		        	<label class="col-md-offset-1" for="end_period">End</label>
		        	<div class="col-md-12 col-sm-12 col-xs-12">
		        		<input type="date" name="end" id="end_period" class="form-control" value="<?php if(isset($m_end)) echo $m_end; ?>" placeholder="End" required />
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
			<?php
				if ($this->session->has_userdata('status_role')) {
					echo "<p class='text text-danger' align='center'>" .$this->session->flashdata('status_role') ."</p>";
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
	        		<select id="nama<?php echo $i; ?>" onchange="sembunyikan(this)" name="nama[]" class="form-control" >
	        			<option value="">--- Nama ---</option>
	        			<?php
	        				if ($listperson != NULL) {
	        					foreach ($listperson as $value) {
	        						echo "<option class='op" .$value->p_id ."' value='".$value->p_id."'>" .$value->p_name ."</option>";
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