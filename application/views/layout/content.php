<div class="col-md-6 col-sm-12 col-xs-12">
	<?php
		if (is_array($isi)) {
			foreach ($isi as $value) {
				$this->load->view($isi);
			}
		}else $this->load->view($isi);
	?>
</div>