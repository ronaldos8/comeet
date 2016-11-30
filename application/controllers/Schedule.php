<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

	public function index()
	{
		
	}

	function edit($m_id = NULL, $step = NULL)
	{
		if ($m_id == NULL) {
			redirect(base_url(),'refresh');
		}else {
			$data['isi'] = 'edit';

			$this->db->where('m_id', $m_id);
			$s = $this->db->get('meeting');
			$data['schedule'] = $s->row();
			if ($step != NULL & $step < 5) {
				$data['step'] = $step;
			}else $data['step'] = 1;

			$q = "SELECT a.p_name as p_name, a.p_id as p_id, c.mr_name as mr_name, c.pro_quo as pro_quo, c.mr_id as mr_id FROM personnel a, personnel_role b, meeting_role c, meeting d WHERE d.m_id = c.m_id and a.p_id = b.p_id and b.mr_id = c.mr_id and c.m_id = $m_id";

			$s = $this->db->query($q);
			$data['personnel_schedule'] = $s->result();

			$s = $this->db->get('Personnel');
			$data['listperson'] = $s->result();

			$this->load->view('main', $data);
		}
	}

	function listrole()
	{
		$id = $_POST['m_id'];
		$this->session->set_userdata('n', $_GET['n']);
		$r = base_url('schedule/edit/') ."$id";
		redirect($r,'refresh');
	}

	function update_meeting()
	{
		$m_id = $_POST['m_id'];
		$data['m_name'] = $_POST['m_name'];
		$data['m_desc'] = $_POST['m_desc'];
		$data['venue'] = $_POST['venue'];
		$data['start_period'] = $_POST['start'];
		$data['end_period'] = $_POST['end'];
		$data['n_accomodate'] = $_POST['n'];
		$data['duration'] = $_POST['duration'];

		// update table meeting
		$this->db->where('m_id', $m_id);
		$this->db->update('meeting', $data);

		foreach ($_POST['mr_name'] as $key => $value) {
			$data2['mr_name'] = $_POST['mr_name'][$key];
			$data2['pro_quo'] = $_POST['pro_quo'][$key];

			// update table meeting_role
			$this->db->where('mr_id', $key);
			$this->db->update('meeting_role', $data2);
		}

		foreach ($_POST['nama'] as $key => $value) {
			$data3['p_id'] = $_POST['nama'][$key];

			// update table personnel_role
			$this->db->where('mr_id', $key);
			$this->db->update('personnel_role', $data3);
		}

		$r = base_url('home/index/rdr');
		redirect($r,'refresh');

	}

	function success()
	{
		$data['isi'] = 'schedule_success';

		if (!$this->session->has_userdata('status_save')) {
			redirect(base_url(),'refresh');
		}

		$id = $this->session->flashdata('status_save');

		if (is_array($id)) {
			$q = "SELECT m_name FROM meeting WHERE m_id = ";
			$c = count($id);
			$i = 1;
			foreach ($id as $value) {
				if ($i == $c) {
					$q .= "$value";
				}else{
					$q .= "$value or m_id = ";
				}
				$i++;
			}
		}else {
			$q = "SELECT m_name FROM meeting WHERE m_id = $id";
		}

		$s = $this->db->query($q);
		$data['m_name'] = $s->result();

		$this->load->view('main', $data);
	}

}

/* End of file schedule.php */
/* Location: ./application/controllers/schedule.php */