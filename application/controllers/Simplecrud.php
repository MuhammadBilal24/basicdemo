<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simplecrud extends CI_Controller {

	public function index()
	{
		$data['studentsData'] = $this->db->query("select * from students")->result();
		$this->load->view('simplecrud', $data);
	}
	// Insert Starts
	public function insert()
	{
		$name = $this->input->post('name');
		$fname = $this->input->post('fname');
		$caste = $this->input->post('caste');
		$phone = $this->input->post('phone');
		$data = [
			'name'=>$name,
			'fname'=>$fname,
			'caste'=>$caste,
			'phone'=>$phone,
		];
		$this->db->insert('students', $data);	
	}
	// Insert End

	// Edit Starts
	public function getStudent()
	{
		{
			$id = $this->input->post('id');
			$data=$this->db->query("select * from students where id='$id'")->result()[0];		
			echo json_encode($data);
		}
	}
	public function update()
	{
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$fname = $this->input->post('fname');
		$caste = $this->input->post('caste');
		$phone = $this->input->post('phone');
		$data = [
			'name'=>$name,
			'fname'=>$fname,
			'caste'=>$caste,
			'phone'=>$phone,
		];
		$this->db->where('id',$id);
		$this->db->update('students',$data);
		echo("Correct");
	}
	public function delete()
	{
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('students');
		echo("Correct");
	}
}
