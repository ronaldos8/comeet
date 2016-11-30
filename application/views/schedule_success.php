<div class="col-md-12 col-sm-12">
	<h3 align="center">
		Selamat anda telah membuat jadwal meeting <br>
		"
			<?php
				$c = count($m_name);
				$i = 1;
				foreach ($m_name as $value) {
					if ($i == $c) {
						if ($i > 1) {
							echo " dan " .$value->m_name .".";
						}else echo $value->m_name;
					}else echo $value->m_name .", ";

					$i++;
				}
			?>
		"
	</h3>
	<div align="center">
		<a href="<?php echo base_url(); ?>" title="">
			<button type="button" class="btn btn-default">Selesai</button>
		</a>
	</div>
</div>