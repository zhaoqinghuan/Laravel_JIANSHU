<?php
namespace App\Admin\Controllers;

class HomeController extends Controller{

    //  后台页面
    public function index(){
        return view('admin.home.index');
    }
}