<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_user');
	}
	
	public function index()
	{
		if($this->is_logged()){
			
			redirect('admin/selamat');
		}

		$this->load->view('login');

		
		$isi['username'] = $this->session->userdata('username');
	}
	public function is_logged()
	{
		$is_login = $this->session->userdata('is_login');
	}

	public function cek_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
		);
		$cek = $this->Model_user->cek_user("user",$where)->num_rows();

		if($cek > 0){

			$data_session = array(
				'nama' => $username,
				'status' => TRUE,
			);

			$this->session->set_userdata($data_session);

			redirect(base_url("admin"));
		}else{
			echo "Username dan password salah !";
		}
		// $hasil = $this->Model_user->cek_user('user',$data);
		// if ($hasil->num_rows() == 1){
		// 	foreach($hasil->result() as $sess)
  //           {
  //             $sess_data['logged_in'] = 'logged_in';
  //             $sess_data['id_user'] = $sess->id_user;
  //             $sess_data['username'] = $sess->username;
  //             $sess_data['nama_usr'] = $sess->nama_usr;
  //             $sess_data['level'] = $sess->level;
  //             $this->session->set_userdata($sess_data);
  //             $this->session->set_userdata('is_login', TRUE);
  //           }
		// 	if ($this->session->userdata('level')=='admin'){
		// 		redirect (base_url('admin'));
		// 	}
		// 	elseif ($this->session->userdata('level')=='super'){
		// 		redirect (base_url('admin'));
		// 	}
		// }
		// else
		// {
		// 	header('location:'.base_url().'auth');
		// 		$this->session->set_flashdata('info','
		// 								<font color="red">Username atau Password salah....!!</font>
		// 								<br />
		// 									');
		// }
		
	}


}