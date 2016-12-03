<div class="col-md-12">
	<h4 align="center">Hasil pencarian jadwal</h4>
</div>

<div class="col-md-12 col-sm-12">
	<?php
		$i = 0;
		foreach ($list_schedule as $value) {
	?>
		<div class="panel panel-default">
			<div class="panel-body">
		    	<div class="col-md-6" align="center">
		    		<img src="" alt="Gambar" style="height: 100px; width: 200px;"><br>
		    		Waktu Meeting <br>
		    		<?php
		    			echo $hari[$i];
		    		?>
		    		<?php echo $jadwal[$i]->desc_time; ?>
		    	</div>
		    	<div class="col-md-6">
		    		<b>Kuorum Satisfaction</b>
		    		<table class="table">
		    			<tbody>
		    				<?php
				    			foreach ($meeting_role[$i] as $value) {
				    				echo '<tr>';
				    				echo "<td>" .$value->mr_name ."</td>";
				    				echo "<td>" ." : " ."</td>";
				    				echo "<td>" .$value->pro_quo ."%</td>";
				    				echo '</tr>';
				    			}
				    		?>
		    			</tbody>
		    		</table>
		    	</div>
			</div>
		</div>
	<?php
		$i++;
		}
	?>
	<div class="col-md-12 col-sm-12" align="center">
		<form action="<?php echo base_url('home/scheduling') ?>" method="POST" accept-charset="utf-8">
			<?php
				$i = 0;
				foreach ($list_schedule as $value) {
			?>
					<input type="hidden" name="m_id[]" value="<?php echo $value->m_id; ?>">
					<input type="hidden" name="jadwal[]" value="<?php echo $jadwal[$i]->slot_id; ?>">
			<?php
					$i++;
				}
			?>
		<button class="btn btn-default" type="submit">Commit</button>
		<a style="text-decoration: none !important;" href="<?php echo base_url('home/index/rdr'); ?>" title="">
			<button class="btn btn-default" type="button">Tunda</button>
		</a>
		<a href="<?php echo base_url('home/index/rdr'); ?>" title="">
			<button class="btn btn-default" type="button">Batal</button>
		</a>
		</form>
	</div>
</div>