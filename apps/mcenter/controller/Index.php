<?php
namespace app\mcenter\controller;
use think\Controller;

class Index extends Controller{
	public function __construct() {
		parent::__construct();
	}

	public function index(){
		$this->redirect(url('users/index'));
    }

}