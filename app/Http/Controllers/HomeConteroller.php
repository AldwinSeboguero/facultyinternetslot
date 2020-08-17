<?php

namespace App\Http\Controllers;
use App\Slot;
use App\Department;
use App\Faculty;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class HomeConteroller extends Controller
{
    public function getSlots(){
        
        return Slot::all();
    }
    public function getDepartments(){
        return Department::all();
    }
    public function getData(Request $request){
        return $request->ip();
    }
    public function saveFacultySlot(Request $request){
        Faculty::create([
            'name' => $request->facultyItem['name'],
            'department_id' => $request->facultyItem['department'],
            'first_slot_id' => $request->slot[0],
            'second_slot_id' => $request->slot[1],
            'third_slot_id' => $request->slot[2],
            'forth_slot_id' => $request->slot[3],
            'fifth_slot_id' => $request->slot[4],
        ]);
        
        foreach ($request->slot as $key => $value) {
            $slot = Slot::find($value);
         Slot::find($value)->update([
             'available' =>(int)$slot->available - 1,
         ]);

        }
        return redirect('/');
    }
}
