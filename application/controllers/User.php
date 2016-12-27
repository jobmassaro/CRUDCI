<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("user_model");
	}


	public function index()
	{
		$data['include'] = 'user/index';
		$this->load->view('user/index', $data);
	}

	public function add()
	{
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$name = $request->name;
		$city = $request->city;
		$id = $this->user_model->AddUser($name,$city);

		$return = array();

		if($id)
		{
			$return['status'] = 'success';
			$return['message'] = 'Item successfully added';
		}
		else
		{
			$return['status'] = 'error';
			$return['message'] = 'Error adding the item, try again';
		}


		print_r(json_encode($return));

	}



	public function delete()
	{

		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$value = $this->user_model->DeleteUser($request->id);
		
		$return = array();

		if($value)
		{
			$return['status'] = 'success';
			$return['message'] = 'Item successfully added';
		}
		else
		{
			$return['status'] = 'error';
			$return['message'] = 'Error adding the item, try again';
		}

		
	}


	public function listAll()
	{
		$user = $this->user_model->ListAll();
		print_r(json_encode($user));
	}



}



