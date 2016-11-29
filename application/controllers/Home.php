<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index($rdr = NULL)
	{
		$data['isi'] = 'home2';

		// mengambil data unschedule
		$q = "SELECT * FROM meeting WHERE not exists(select m_id from Timetable where Timetable.m_id = meeting.m_id)";
		$s = $this->db->query($q);
		$data['list_unschedule'] = $s->result();

		foreach ($data['list_unschedule'] as $value) {
			$id = $value->m_id;
			$q = "select a.p_name from personnel a, personnel_role b, meeting_role c, meeting d where d.m_id = c.m_id and a.p_id = b.p_id and b.mr_id = c.mr_id and c.m_id = $id";
			$s = $this->db->query($q);
			$data['list_personnel'][$id] = $s->result();
		}

		// mengambil data scheduling
		$q = "SELECT * FROM meeting a, Timetable b, slot c WHERE a.m_id = b.m_id and b.slot_id = c.slot_id";
		$s = $this->db->query($q);
		$data['list_schedule'] = $s->result();

		foreach ($data['list_schedule'] as $value) {
			$id = $value->m_id;
			$q = "select a.p_name from personnel a, personnel_role b, meeting_role c, meeting d where d.m_id = c.m_id and a.p_id = b.p_id and b.mr_id = c.mr_id and c.m_id = $id";
			$s = $this->db->query($q);
			$data['list_personnel2'][$id] = $s->result();
		}

		if ($rdr != NULL) {
			$data['rdr'] = 'fromsaving';
		}
		
		$this->load->view('main', $data);
	}

	function add_personnel()
	{
		if (isset($_POST['p_name'])) {
			$i = $this->db->insert('Personnel', $_POST);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('status', 'Personnel berhasil ditambahkan');
			}else $this->session->set_flashdata('status', 'Personnel gagal ditambahkan. silahkan coba lagi');

			redirect(base_url(),'refresh');
		}
	}

	function cari()
	{
		echo $_POST['q'];
	}

	function meeting($step = NULL, $lr = NULL)
	{
		$data['isi'] = 'meeting';
		if ($step != NULL & $step < 5) {
			$data['step'] = $step;
		}else $data['step'] = 1;

		if (isset($_SESSION)) {
			$data['m_name'] = $this->session->userdata('m_name');
			$data['m_desc'] = $this->session->userdata('m_desc');
			$data['venue'] = $this->session->userdata('venue');
			$data['duration'] = $this->session->userdata('duration');
			$data['m_start'] = $this->session->userdata('start');
			$data['m_end'] = $this->session->userdata('end');
		}

		if ($step == 4) {
			$this->db->select('max(m_id) as max_id');
			$s = $this->db->get('meeting');
			$data['m_id'] = $s->row()->max_id;
		}

		if ($lr != NULL) {
			$data['n'] = $lr;
		}

		$s = $this->db->get('Personnel');
		$data['listperson'] = $s->result();
		$this->load->view('main', $data);
	}

	function add_meeting()
	{
		if (isset($_POST['submit1'])) {
			$array = array(
				'm_name' => $_POST['m_name'],
				'm_desc' => $_POST['m_desc']
			);
			
			$this->session->set_userdata($array);

			redirect(base_url('home/meeting/2'),'refresh');
		}else if (isset($_POST['submit2'])) {
			$array = array(
				'venue' => $_POST['venue'],
				'duration' => $_POST['duration'],
				'start' => $_POST['start'],
				'end' => $_POST['end']
			);
			
			$this->session->set_userdata( $array );

			redirect(base_url('home/meeting/3'),'refresh');
		}else if (isset($_POST['submit3'])) {
			$array = array(
				'mr_name' => $_POST['mr_name'],
				'pro_quo' => $_POST['pro_quo'],
				'nama' => $_POST['nama']
			);
			$this->session->set_userdata( $array );

			$this->save_meeting();

			redirect(base_url('home/meeting/4'),'refresh');
		}
	}

	function listrole()
	{
		$this->session->set_userdata('n', $_GET['n']);
		$r = base_url('home/meeting/3');
		redirect($r,'refresh');
	}

	function save_meeting()
	{
		// if (isset($_POST['simpan'])) {
			// insert ke tabel meeting
			$data['m_name'] = $this->session->userdata('m_name');
			$data['m_desc'] = $this->session->userdata('m_desc');
			$data['venue'] = $this->session->userdata('venue');
			$data['duration'] = $this->session->userdata('duration');
			$data['start_period'] = $this->session->userdata('start');
			$data['end_period'] = $this->session->userdata('end');
			$data['n_accomodate'] = $this->session->userdata('n');

			$this->db->insert('meeting', $data);

			if ($this->db->affected_rows() > 0) {
				$this->db->select('max(m_id) as max_id');
				$this->db->from('meeting');
				$s = $this->db->get();
				$s = $s->row();
				
				$err = 1;

				$data2['m_id'] = $s->max_id;
				for ($i = 0; $i < $data['n_accomodate']; $i++) {
					// insert ke tabel meeting role
					$data2['mr_name'] = $_SESSION['mr_name'][$i];
					$data2['pro_quo'] = $_SESSION['pro_quo'][$i];
					$this->db->insert('meeting_role', $data2);
					
					if ($this->db->affected_rows() > 0) {
						// insert ke table personnel role
						$this->db->select('max(mr_id) as max_mr_id');
						$this->db->from('meeting_role');
						$s = $this->db->get();
						$s = $s->row();
						
						// insert ke tabel meeting role
						$data3['mr_id'] = $s->max_mr_id;
						$data3['p_id'] = $_SESSION['nama'][$i];
						$this->db->insert('personnel_role', $data3);
						
						$err = 0;
					}
				}
				

			}
			
			/*if ($err == 0) {
				$this->session->sess_destroy();
				$this->session->set_flashdata('status_save', 'Pertemuan berhasil disimpan.');
				$r = base_url('home/index/rdr');
				redirect($r,'refresh');
			}*/
		// }
	}

	function carijadwal()
	{
		if (isset($_POST['m_id'])) {
			$data['isi'] = 'hasil_cari';

			$this->db->select('max(slot_id) as max_id');
			$this->db->from('slot');
			$s = $this->db->get();
			$s = $s->row();
			$rdm = $s->max_id;
			
			$m_id = $_POST['m_id'];
			if (is_array($m_id)) {
				foreach ($_POST['m_id'] as $value) {
					$n = rand(1, $rdm);
					$this->db->where('slot_id', $n);
					$s = $this->db->get('slot');
					$data['jadwal'][] = $s->row();

					$this->db->where('m_id', $value);
					$s = $this->db->get('meeting_role');
					$data['meeting_role'][] = $s->result();

					$this->db->where('m_id', $value);
					$s = $this->db->get('meeting');
					$data['list_schedule'][] = $s->row();
				}
			}else {
				$n = rand(1, $rdm);
				$this->db->where('slot_id', $n);
				$s = $this->db->get('slot');
				$data['jadwal'][] = $s->row();

				$this->db->where('m_id', $m_id);
				$s = $this->db->get('meeting_role');
				$data['meeting_role'][] = $s->result();

				$this->db->where('m_id', $m_id);
				$s = $this->db->get('meeting');
				$data['list_schedule'][] = $s->row();
			}

			$this->load->view('main', $data);
		}else redirect(base_url('home/index/rdr'),'refresh');
	}

	function scheduling()
	{
		$this->db->select('max(slot_id) as max_id');
		$this->db->from('slot');
		$s = $this->db->get();
		$s = $s->row();
		$i = 0;
		foreach ($_POST['m_id'] as $value) {
			$n = $_POST['jadwal'][$i];
			$data['m_id'] = $value;
			$data['slot_id'] = $n;
			echo $n;
			$this->db->insert('Timetable', $data);
			$i++;
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('status_save', 'Pertemuan berhasil dijadwalkan');
			$r = base_url();
			redirect($r,'refresh');
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */