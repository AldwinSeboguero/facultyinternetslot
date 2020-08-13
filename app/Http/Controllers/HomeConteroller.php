<?php

namespace App\Http\Controllers;
use App\Slot;
use App\Department;
use Illuminate\Http\Request;

class HomeConteroller extends Controller
{
    public function getSlots(Request $request){
        dd($request->ip());
        return Slot::where('available','>','0')->get();
    }
    public function getDepartments(){
        return Department::all();
    }
    public function getData(Request $request){
        return $request->ip();
    }
}
