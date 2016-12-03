
	<div>
	  <!-- Nav tabs -->
	  <?php
	  	if (isset($rdr)) {
	  		$unsch = 'active';
	  		$unsch2 = 'in active';
	  		$sch = '';
	  		$sch2 = '';
	  	}else {
	  		$sch = 'active';
	  		$sch2 = 'in active';
	  		$unsch = '';
	  		$unsch2 = '';
	  	}
	  ?>
	  <ul class="nav nav-tabs" role="tablist">
	    <li><h4>Agenda anda mendatang</h4></li>
	    <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
	    <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
	    <li role="presentation" class="<?php echo $sch; ?>"><a href="#Scheduling" aria-controls="Scheduling" role="tab" data-toggle="tab">Scheduled</a></li>
	    <li role="presentation" class="<?php echo $unsch; ?>"><a href="#Unscheduling" aria-controls="Unscheduling" role="tab" data-toggle="tab">Unscheduled</a></li>
	  </ul>
	<br>
	<!-- Tab panes -->
	<div class="tab-content">
		<?php
			if ($this->session->has_userdata('status_save')) {
				echo "<p>" .$this->session->flashdata('status_save') ."</p>";
			}
		?>
		<div role="tabpanel" class="tab-pane fade <?php echo $sch2; ?>" id="Scheduling">
		  	<?php
		  		if ($list_schedule != NULL) {
		  			foreach ($list_schedule as $value) {
		  	?>
		  				<style type="text/css" media="screen">
		  					#classdetail {
		  						display: none;
		  					}

		  					#detail{
		  						/*background: red;*/
		  						height: 80px;
		  						width: 100px;
		  						font-size: 18px;
		  					}

		  					#detail:hover {
		  						/*background: blue;*/
		  						height: 80px;
		  						width: 100px;
		  					}

		  					#detail:hover #classdetail{
		  						background: black;
		  						opacity: .2;
		  						display: block;
		  						z-index: 99;
		  						height: 80px;
		  						width: 100px;
		  						margin-top: -50px;
		  						margin-left: -20px;
		  						padding-top: 50px;
		  						padding-left: 20px;
		  						font-size: 14px;
		  					}

		  					#classdetail > a {
		  						color: white;
		  						text-align: center;
		  						text-decoration: none;
		  					}
		  				</style>
		  				<div class="panel panel-default">
							<div class="panel-body">
				  				<div class="media">
									<div class="media-left">
								    	<a href="#">
								    		<div class="col-md-12" align="center" id="detail">
								    			<?php
									    			/*if ($jadwal[$i]->row == 1) {
									    				echo 'Senin';
									    			}else if ($jadwal[$i]->row == 2) {
									    				echo 'Selasa';
									    			}else if ($jadwal[$i]->row == 3) {
									    				echo 'Rabu';
									    			}else if ($jadwal[$i]->row == 4) {
									    				echo 'Kamis';
									    			}else if ($jadwal[$i]->row == 5) {
									    				echo 'Jumat';
									    			}*/
									    		?>
									    		<br>
								    			<?php echo $value->desc_time; ?> <br>
								    			<?php //echo date('M', strtotime($value->desc_time)); ?>
									    		<div class="col-md-12" id="classdetail" align="center">
									    			<a href="<?php echo base_url('schedule/s/'); ?><?php echo $value->m_id; ?>" title="">Detail</a>
									    		</div>
								    		</div>
								    	</a>
								  	</div>
								  	<div class="media-body">
								    	<h4 class="media-heading"><b><?php echo $value->m_name; ?></b></h4>
								    	Jangka waktu <br>
								    	di <?php echo $value->venue; ?> <br>
								    	<p>
											Dengan 
											<?php
												$id = $value->m_id;
												$n = count($list_personnel2[$id]);
												$c = 1;

												foreach ($list_personnel2[$id] as $value) {
													if ($c <= 3) {
														echo $value->p_name;
														if ($c < $n) {
															echo ", ";
														}else echo '.';
													}
													$c++;
												}
												$sisa = $n - 3;
												if ($sisa > 0) {
													echo "dan $sisa orang lainnya";
												}
											?>
										</p>
								  	</div>
								</div>
							</div>
						</div>
		  	<?php
		  			}
		  			echo $pagination;
		  		}else {
		  	?>
		  		<div class="panel panel-default">
					<div class="panel-body">
				    	Anda belum mempunyai jadwal pertemuan.
					</div>
				</div>
		  	<?php
		  		}
		  	?>
		</div>
		<div role="tabpanel" class="tab-pane fade <?php echo $unsch2; ?>" id="Unscheduling">
			<form action="<?php echo base_url('home/carijadwal'); ?>" method="POST" accept-charset="utf-8">
			  	<?php
			  		if($list_unschedule != NULL){
			  		foreach ($list_unschedule as $value) {
				?>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="media">
									<div class="media-left">
										<input type="checkbox" name="m_id[]" value="<?php echo $value->m_id; ?>" />
									</div>
									<div class="media-body">
										<h4 class="media-heading"><b><?php echo $value->m_name; ?></b></h4>
										<p>
											<span class="glyphicon glyphicon-map-marker"> </span> <?php echo $value->venue; ?>
										</p>
										<p>
											<span class="glyphicon glyphicon-user"> </span> Bersama 
											<?php
												$id = $value->m_id;
												$n = count($list_personnel[$id]);
												$c = 1;

												foreach ($list_personnel[$id] as $value) {
													if ($c <= 3) {
														echo $value->p_name;
														if ($c < $n) {
															echo ", ";
														}else echo '.';
													}
													$c++;
												}
												$sisa = $n - 3;
												if ($sisa > 0) {
													echo "dan $sisa orang lainnya";
												}
											?>
										</p>
									</div>
									<div class="media-right">
										<a href="<?php echo base_url('schedule/edit/') .$id; ?>" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
									</div>
								</div>
							</div>
						</div>

				<?php
			  		}
				?>
						<div class="col-md-4 col-sm-12" style="font-size: 12px;">
					  		<input type="checkbox" id="checkall" name="checkall" onclick="toggle(this)" value=""> <label for="checkall">Checklist / Unchecklist</label>
						</div>
					  	<div class="col-md-8 col-sm-12">
					  		<button type="submit" class="btn btn-default btn-sm">Carii jadwal</button>
					  	</div>
						<script type="text/javascript" charset="utf-8" async defer>
							function toggle(pilih) {
								checkboxes = document.getElementsByName('m_id[]');
								for(var i=0, n=checkboxes.length;i<n;i++) {
									checkboxes[i].checked = pilih.checked;
							  	}
							}
						</script>
				<?php
					}else{ //end if
				?>
					<div class="panel panel-default">
						<div class="panel-body">
							Anda belum menerima permintaan meeting
						</div>
					</div>
				<?php
					}
			  	?>
			</form>
			<br><br><br>
		</div>
	</div>

	</div>