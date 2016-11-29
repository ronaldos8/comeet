<div class="container">
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
				<input type="text" name="p_name" id="p_name" class="form-control" value="" placeholder="Nama Personel" required />
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-default">Tambahkan</button>
			</div>
		</form>
		<hr>
		<center>
			<a href="<?php echo base_url('home/meeting'); ?>" title="">
				<button type="button" class="btn btn-default btn-sm">
					Membuat Jadwal
				</button>
			</a>
		</center>
		<hr>
		<br>
	</div>