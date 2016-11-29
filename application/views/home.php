<style type="text/css" media="screen">
	.hide-control {
		border: none;
	}
</style>
<div class="col-md-3 col-sm-12 col-xs-12">
	<h4>Tambah Personnel</h4>
	<form action="<?php echo base_url('home/add_personnel'); ?>" method="POST" accept-charset="utf-8">
		<?php
			if ($this->session->has_userdata('status')) {
				echo $this->session->flashdata('status');
			}
		?>
		<div class="form-group">
			<label for="p_name">Nama Personnel</label>
			<input type="text" name="p_name" id="p_name" class="form-control" value="" placeholder="Nama Personel">
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-default">Tambahkan</button>
		</div>
	</form>
	<hr>
	<center>
		<!-- Button trigger modal 1 -->
		<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#step1">
			Membuat Jadwal
		</button>
	</center>
	<hr>
	<br>
	<form id="form2" action="<?php echo base_url('home/add_meeting'); ?>" method="POST" class="form-horizontal form-label-left" accept-charset="utf-8">
		
		<!-- Modal 1 -->
		<div class="modal fade" id="step1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel" align="center">Nama dan deskripsi meeting <b>1/4</b></h4>
		      </div>
		      <div class="modal-body">
		        <div class="form-group">
		        	<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="m_name">Nama Meeting</label>
		        	<div class="col-md-6">
		        		<input type="text" name="m_name" id="m_name" class="form-control" value="" placeholder="" required />
		        	</div>
		        </div>
		        
		        <div class="form-group">
		        	<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="m_desc">Deskripsi</label>
		        	<div class="col-md-6">
		        		<textarea name="m_desc" id="m_desc" class="form-control" rows="4" cols="50" required /></textarea>
		        	</div>
		        </div>

		      </div>
		      <div class="modal-footer">
		        <!-- button trigger modal 2 -->
		        <center>
		        	<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-dismiss="modal" data-target="#step2" >Selanjutnya</button>
		        </center>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- Modal2 -->
		<div class="modal fade" id="step2" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Nama dan durasi Meeting 2/4</h4>
		      </div>
		      <div class="modal-body">
		        <div class="form-group">
		        	<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="venue">Tempat</label>
		        	<div class="col-md-6">
		        		<input type="text" name="venue" id="venue" class="form-control" value="" placeholder=""required />
		        	</div>
		        </div>

		        <div class="form-group">
		        	<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="duration">Durasi</label>
		        	<div class="col-md-6">
		        		<input type="text" name="duration" id="duration" class="form-control" value="" placeholder="" required />
		        	</div>
		        </div>

		        <div class="form-group">
		        	<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="period">Periode Meeting</label>
		        	<div class="col-md-6 col-sm-6 col-xs-12">
		        		<div class="col-md-6">
			        		<input type="date" name="period" id="period" class="form-control" value="" placeholder="Start" required />
			        	</div>

			        	<div class="col-md-6 col-sm-6 col-xs-12">
			        		<input type="date" name="period" id="period" class="form-control" value="" placeholder="End" required />
			        	</div>
		        	</div>
		        </div>

		      </div>
		      <div class="modal-footer">
		        <center>
		        	<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-dismiss="modal" data-target="#step3" >Selanjutnya</button>
		        </center>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- Modal3 -->
		<div class="modal fade" id="step3" tabindex="-1" role="dialog" aria-labelledby="myModalLabe3">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Peran dan kuorum Meeting 3/4</h4>
		      </div>
		      <div class="modal-body">
		        <div class="form-group">
		        	<label class="control-label col-md-offset-1 col-sm-3 col-xs-12" for="n_role">Jumlah yang dibutuhkan</label>
		        	<div class="col-md-6">
		        		<!-- <input type="number" name="n_role" id="n_role" class="form-control" onchange="role()" value="" placeholder="" required /> -->
		        		<button type="button" onclick="role()">Tambah Role</button>
		        	</div>
		        </div>
		        <div class="form-group" id="num_role">
		        	
		        </div>
<style type="text/css" media="screen">
	.br {
		clear: both;
		margin-bottom: 10px;
	}
</style>
		      </div>
		      <div class="modal-footer">
		        <center>
		        	<button type="button" class="btn btn-default btn-sm" data-toggle="modal" onclick="coba()" data-dismiss="modal" data-target="#step4" >Selanjutnya</button>
		        </center>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- Modal4 -->
		<div class="modal fade" id="step4" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Kesimpulan pembuatan jadwal Meeting 4/4</h4>
		      </div>
		      <div class="modal-body">
		        <div class="col-md-12">
		        	<table class="table">
		        		<tbody>
		        			<tr>
		        				<td>Nama Meeting</td>
		        				<td>&nbsp : &nbsp</td>
		        				<td><input type="text" class="hide-control" id="name_m"" name="" value="" placeholder="" readonly=""></td>
		        			</tr>
		        			<tr valign="midle">
		        				<td>Deskripsi</td>
		        				<td>&nbsp : &nbsp</td>
		        				<td>
		        				<textarea class="hide-control" id="desc_m" cols="50" rows="4"></textarea>
		        				</td>
		        			</tr>
		        			<tr>
		        				<td>Tempat</td>
		        				<td>&nbsp : &nbsp</td>
		        				<td><input type="text" class="hide-control" id="venue_m"" name="" value="" placeholder="" readonly=""></td>
		        			</tr>
		        		</tbody>
		        	</table>
		        </div>
		        <br>
		        <div class="col-md-12">
		        	<table>
		        		<tbody>
		        			<tr>
		        				<td>Peran 1</td>
		        				<td>&nbsp : &nbsp</td>
		        				<td>2 Orang kuorum 100</td>
		        			</tr>
		        			<tr>
		        				<td>Peran 2</td>
		        				<td>&nbsp : &nbsp</td>
		        				<td>4 Orang kuorum 80</td>
		        			</tr>
		        			<tr>
		        				<td>Peran 3</td>
		        				<td>&nbsp : &nbsp</td>
		        				<td>6 Orang kuorum 60</td>
		        			</tr>
		        		</tbody>
		        	</table>
		        </div>
		        <div class="clearfix">
		        	
		        </div>
		      </div>
		      <div class="modal-footer">
		      	<center>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cari Jadwal</button>
		        <button type="submit" class="btn btn-default btn-sm" data-dismiss="modal" >Simpan Perubahan</button>
		      	</center>
		      </div>
		    </div>
		  </div>
		</div>

	</form>
</div>
<button type="button" onclick="coba()">coba</button>


<div class="col-md-6 col-sm-12 col-xs-12">
	<div>
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li><h4>Agenda anda mendatang</h4></li>
	    <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
	    <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
	    <li role="presentation" class="active"><a href="#Scheduling" aria-controls="Scheduling" role="tab" data-toggle="tab">Scheduling</a></li>
	    <li role="presentation"><a href="#Unscheduling" aria-controls="Unscheduling" role="tab" data-toggle="tab">Unscheduling</a></li>
	  </ul>
	<br>
	  <!-- Tab panes -->
	  <div class="tab-content">
		  <div role="tabpanel" class="tab-pane fade in active" id="Scheduling">
		  		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		  		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		  		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		  		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		  		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		  		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		  </div>
		  <div role="tabpanel" class="tab-pane fade" id="Unscheduling">
		  		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		  		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		  		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		  		consequat. Duis aute irure dolor in reprehenderit in voluptate velit ess
		  </div>
		</div>

	</div>
</div>

<div class="col-md-3 col-sm-12 col-xs-12">
	<h4>Undangan Pertemuan</h4>
</div>
<div class="clearfix">
	
</div>
<input type="text" name="textcari" id="textcari" value="" placeholder="">
<script src="<?php echo base_url('assets/js/step.js'); ?>" type="text/javascript" charset="utf-8"></script>