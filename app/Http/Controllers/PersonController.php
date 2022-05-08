<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(){
        $person = Person::all();
        $out = '';
        foreach($person as $per){
            $out .= "<tr>
				<td>".$per->id."</td>
				<td>".$per->name."</td>
				<td>".$per->age."</td>
				<td style='text-align:center'>
                    <button value='".$per->id."' class='btn btn-success edit' data-toggle='modal' data-target='#modal_edit'>Edit</button>
                </td>
				<td style='text-align:center'>
                    <button value='".$per->id."' class='btn btn-danger delete'>Delete</button>
                </td>
			</tr>";
        }
        return response()->json($out);
    }
    public function store(Request $request){
        try {
            $person = new Person();
            $person->name = $request->name;
            $person->age = $request->age;
            $person->save();
            return response()->json("success");
        } catch (\Throwable $th) {
            return response()->json("fail");
        }
        
    }
    public function detail($id){
        $person = Person::find($id);
        $out['id'] = $person->id;
        $out['name'] = $person->name;
        $out['age'] = $person->age;

        return response()->json($out);
    }
    public function update($id,Request $request){
        try {
            $person = Person::find($id);
            $person->name = $request->name;
            $person->age = $request->age;
            $person->update();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('fail');
        }   
    }
    public function delete($id){
        try {
            Person::destroy($id);
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('fail');
        }  
    }
}
