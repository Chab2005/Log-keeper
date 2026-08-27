<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        return view("index");
    }
//

    public function create() {
        return view("index");
    }

    public function modify() {
        return view("modify");
    }

    public function delete() {
        return view("delete");
    }
}
