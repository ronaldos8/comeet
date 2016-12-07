<?php
/**
* class default yang akan dipanggl ketika user membuka aplikasi comeet
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
	}

	/**
	* fungsi ini berfungsi untuk menampilkan halaman awal / home
	* @param rdr, parameter ini berfungsi untuk menerima redirect, jika di set maka home akan menampilkan data unscheduled
	*/
	public function index($rdr = NULL)
	{
		// view home
		$data['isi'] = 'home2';

		// untuk mengecek rdr berasal dari proses menyimpan atau pagination
		if ($rdr == 'rdr') {
			$data['rdr'] = 'fromsaving';
			$rdr = 0;
		}else if($rdr == NULL) {
			$rdr = 0;
		}

		// mengambil data unscheduled
		$q = "SELECT * FROM meeting WHERE not exists(select m_id from Timetable where Timetable.m_id = meeting.m_id)";
		$s = $this->db->query($q);
		$data['list_unschedule'] = $s->result();

		// mengambil data personel berdasarkan m_id tersebut
		foreach ($data['list_unschedule'] as $value) {
			$id = $value->m_id;
			$q = "select a.p_name from personnel a, personnel_role b, meeting_role c, meeting d where d.m_id = c.m_id and a.p_id = b.p_id and b.mr_id = c.mr_id and c.m_id = $id";
			$s = $this->db->query($q);
			$data['list_personnel'][$id] = $s->result();
		}

		// mengambil data scheduling
		$q = "SELECT * FROM meeting a, Timetable b, slot c WHERE a.m_id = b.m_id and b.slot_id = c.slot_id";
		$total_sch = $this->db->query($q);
		$num_row = $total_sch->num_rows();
		$q = "SELECT * FROM meeting a, Timetable b, slot c WHERE a.m_id = b.m_id and b.slot_id = c.slot_id limit 4 offset $rdr";
		$s = $this->db->query($q);
		$data['list_schedule'] = $s->result();

		// mengambil data personnel yang ada pada meeting
		foreach ($data['list_schedule'] as $value) {
			$id = $value->m_id;
			$q = "select a.p_name from personnel a, personnel_role b, meeting_role c, meeting d where d.m_id = c.m_id and a.p_id = b.p_id and b.mr_id = c.mr_id and c.m_id = $id";
			$s = $this->db->query($q);
			$data['list_personnel2'][$id] = $s->result();
		}

		// pagination scheduling
		$config['base_url'] = base_url('home/index/');
		$config['total_rows'] = $num_row;
		$config['per_page'] = 4;
		$config['uri_segment'] = 3;

		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = "</ul>";

		$config['first_tag_open'] = "<li>";
		$config['first_tag_close'] = "</li>";

		$config['last_tag_open'] = "<li>";
		$config['last_tag_close'] = "</li>";

		$config['next_tag_open'] = "<li>";
		$config['next_tag_close'] = "</li>";

		$config['prev_tag_open'] = "<li>";
		$config['prev_tag_close'] = "</li>";

		$config['num_tag_open'] = "<li>";
		$config['num_tag_close'] = "</li>";

		$config['cur_tag_open'] = "<li class='active'><a><b>";
		$config['cur_tag_close'] = "</b></a></li>";

		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('main', $data);
	}

	/**
	* fungsi untuk menambahkan personnel baru
	*/
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

	/**
	* fungsi yang menghandle form pendaftaran meeting
	* setiap step(1-3) menyimpan data kedalam session
	* ketika memasuki step 4 data disimpan ke database
	*/
	function meeting($step = NULL, $lr = NULL)
	{
		$data['isi'] = 'meeting';
		if ($step > 0 && $step < 5) {
			$data['step'] = $step;
		}else if($step == NULL){
			$data['step'] = 1;
		}else redirect(base_url('home/meeting/'),'refresh');

		// memasukan data dari form ke session
		if (isset($_SESSION)) {
			$data['m_name'] = $this->session->userdata('m_name');
			$data['m_desc'] = $this->session->userdata('m_desc');
			$data['venue'] = $this->session->userdata('venue');
			$data['duration'] = $this->session->userdata('duration');
			$data['m_start'] = $this->session->userdata('start');
			$data['m_end'] = $this->session->userdata('end');
		}

		// mengambil id terbesar (id yang terakhir kali dimasukan)
		if ($step == 4) {
			if ($this->session->has_userdata('nama')) {
				$this->db->select('max(m_id) as max_id');
				$s = $this->db->get('meeting');
				$data['m_id'] = $s->row()->max_id;
			}else redirect(base_url('home/meeting/'),'refresh');
		}

		$s = $this->db->get('Personnel');
		$data['listperson'] = $s->result();
		$this->load->view('main', $data);
	}

	/*
	* fungsi untuk menambahkan data meeting baru
	* setiap step akan  menyimpan data kedalam session
	*/
	function add_meeting()
	{
		// step 1
		if (isset($_POST['submit1'])) {
			$array = array(
				'm_name' => $_POST['m_name'],
				'm_desc' => $_POST['m_desc']
			);
			
			$this->session->set_userdata($array);

			redirect(base_url('home/meeting/2'),'refresh');
		}else if (isset($_POST['submit2'])) { //step 2
			$array = array(
				'venue' => $_POST['venue'],
				'duration' => $_POST['duration'],
				'start' => $_POST['start'],
				'end' => $_POST['end']
			);
			
			$this->session->set_userdata( $array );

			redirect(base_url('home/meeting/3'),'refresh');
		}else if (isset($_POST['submit3'])) { //step 3
			
			if (isset($_POST['rolelist1'])) {
				$i = 1;
				foreach ($_POST['mr_name'] as $value) {
					$variable = "rolelist$i";
					foreach ($_POST[$variable] as $value) {
						$rolelist[$i][] = $value;
					}
					$i++;
				}
			}else {
				$this->session->set_flashdata('status_role', 'Silahkan isi nama untuk setiap peran');
				redirect(base_url('home/meeting/3'),'refresh');
			}

			$array = array(
				'mr_name' => $_POST['mr_name'],
				'pro_quo' => $_POST['pro_quo'],
				'nama' => $rolelist
			);
			$this->session->set_userdata( $array );

			// menyimpan ke database
			$this->save_meeting();

			redirect(base_url('home/meeting/4'),'refresh');
		}
	}

	/*
	* fungsi yang mengandle penambahan peran ketika mengisi form meeting
	*/
	function listrole()
	{
		$this->session->set_userdata('n', $_GET['n']);
		$r = base_url('home/meeting/3');
		redirect($r,'refresh');
	}

	/*
	* fungsi untuk menyimpan data dari form ke database
	*/
	function save_meeting()
	{
		// mengambil data yang ada di session untuk dimasukan kedalam database (table meeting)
		$data['m_name'] = $this->session->userdata('m_name');
		$data['m_desc'] = $this->session->userdata('m_desc');
		$data['venue'] = $this->session->userdata('venue');
		$data['duration'] = $this->session->userdata('duration');
		$data['start_period'] = $this->session->userdata('start');
		$data['end_period'] = $this->session->userdata('end');
		$data['n_accomodate'] = $this->session->userdata('n');

		$this->db->insert('meeting', $data);

		if ($this->db->affected_rows() > 0) {
			// mengambil id terakhir yang diinput yang akan dimasukan ke tabel meeting_role
			$this->db->select('max(m_id) as max_id');
			$this->db->from('meeting');
			$s = $this->db->get();
			$s = $s->row();
			
			$err = 1;

			$data2['m_id'] = $s->max_id;
			$rolelist = $this->session->userdata('nama');
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
					foreach ($rolelist[$i+1] as $value) {
						$data3['p_id'] = $value;
						$this->db->insert('personnel_role', $data3);
					}
					
					$err = 0;
				}
			}
		}
	}

	/*
	* fungsi untuk mencari jadwal dan menampilkan rekomendasi jadwalnya
	*/
	function carijadwal()
	{
		if (isset($_POST['m_id'])) {
			$data['isi'] = 'hasil_cari';

			// mengambil nilai max slot_id
			$this->db->select('max(slot_id) as max_id');
			$this->db->from('slot');
			$s = $this->db->get();
			$s = $s->row();
			$rdm = $s->max_id;
			
			// mencari jadwal berdasarkan slot_d yang di random
			$m_id = $_POST['m_id'];
			$i = 0;
			if (is_array($m_id)) {
				foreach ($_POST['m_id'] as $value) {
					$n = rand(1, $rdm);
					$this->db->where('slot_id', $n);
					$s = $this->db->get('slot');
					$data['jadwal'][$i] = $s->row();

					if ($data['jadwal'][$i]->row == 1) {
		    				$data['hari'][$i] = 'Senin';
	    			}else if ($data['jadwal'][$i]->row == 2) {
	    				$data['hari'][$i] = 'Selasa';
	    			}else if ($data['jadwal'][$i]->row == 3) {
	    				$data['hari'][$i] = 'Rabu';
	    			}else if ($data['jadwal'][$i]->row == 4) {
	    				$data['hari'][$i] = 'Kamis';
	    			}else if ($data['jadwal'][$i]->row == 5) {
	    				$data['hari'][$i] = 'Jumat';
	    			}

					$this->db->where('m_id', $value);
					$s = $this->db->get('meeting_role');
					$data['meeting_role'][] = $s->result();

					$this->db->where('m_id', $value);
					$s = $this->db->get('meeting');
					$data['list_schedule'][] = $s->row();

					$i++;
				}
			}else {
				$i = 0;
				$n = rand(1, $rdm);
				$this->db->where('slot_id', $n);
				$s = $this->db->get('slot');
				$data['jadwal'][$i] = $s->row();

				if ($data['jadwal'][$i]->row == 1) {
	    				$data['hari'][$i] = 'Senin';
    			}else if ($data['jadwal'][$i]->row == 2) {
    				$data['hari'][$i] = 'Selasa';
    			}else if ($data['jadwal'][$i]->row == 3) {
    				$data['hari'][$i] = 'Rabu';
    			}else if ($data['jadwal'][$i]->row == 4) {
    				$data['hari'][$i] = 'Kamis';
    			}else if ($data['jadwal'][$i]->row == 5) {
    				$data['hari'][$i] = 'Jumat';
    			}

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

	/*
	* fungsi untuk menambahkan meeting unschedule menjadi schedule
	*/
	function scheduling()
	{
		$i = 0;
		foreach ($_POST['m_id'] as $value) {
			$n = $_POST['jadwal'][$i];
			$data['m_id'] = $value;
			$data['slot_id'] = $n;
			$this->db->insert('Timetable', $data);

			// mengambil data p_id di suatu meeting
			$q ="SELECT a.p_id as p_id FROM personnel a, personnel_role b, meeting_role c, meeting d WHERE d.m_id = c.m_id and a.p_id = b.p_id and b.mr_id = c.mr_id and c.m_id = $value";
			$p_id = $this->db->query($q);
			$p_id = $p_id->result();

			// mengambil desc_time suatu meeting
			$q = "select a.desc_time desc_time from slot a, timetable b where b.slot_id = a.slot_id and b.m_id = $value";
			$desc_time = $this->db->query($q);
			$desc_time = $desc_time->row();

			// memecah desc time menjadi start time dan end time
			$string = $desc_time->desc_time;
			$str = explode('-', $string, 2);

			// insert data ke table calendar
			foreach ($p_id as $value2) {
				$object['p_id'] = $value2->p_id;
				$object['m_id'] = $value;
				$object['start_time'] = $str[0];
				$object['end_time'] = $str[1];
				$this->db->insert('Calendar', $object);
			}
			$i++;
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('status_save', $_POST['m_id']);
			$r = base_url('schedule/success');
			redirect($r,'refresh');
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */