<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\DeliveryBoy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class DeliveryBoyController extends Controller
{
    public function index(){ 
        $delivery_boy_list = DeliveryBoy::orderBy('id', 'desc')->paginate(10);
        return view('backend.delivery_boy.index', compact('delivery_boy_list'));
    }

    public function create(){
        return view('backend.delivery_boy.create', );
    }
    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email'],
            'phone' => ['required'],
        ]); 
        $user = DeliveryBoy::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, 
            'address' => $request->address, 
            'father_name' => $request->father_name, 
            'aadhar_number' => $request->aadhar_number, 
            'status' => 1  
        ]);
        return redirect()->route('backend.delivery_boy.index')->with('created', 'Delivery boy has been created !');

    }


    public function edit($id){
        $delivery_boy = DeliveryBoy::where('id', $id)->first();
        return view('backend.delivery_boy.edit', compact('delivery_boy'));
    }

    public function update(Request $request, $id){
        DeliveryBoy::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, 
            'address' => $request->address, 
            'father_name' => $request->father_name, 
            'aadhar_number' => $request->aadhar_number, 
            'status' => 1  
        ]);
        return redirect()->route('backend.delivery_boy.index')->with('updated', 'Delivery boy has been updated !');
    }


    // ------------------------------------------------------------------------------------------
    public function search(Request $request){
        try{
        $search_val = $request->search_val;
        if($search_val != ''){ 
            $search_result = DeliveryBoy::where('name', 'like', '%'.$search_val.'%')->get();
        }else{
            $search_result = DeliveryBoy::orderBy('id', 'desc')->paginate(10);
        }
 
        $html = '';
        $count = 1;
        if($search_result->count() == 0){
            $html .= '<tr>';
            $html .= '<td class="text-center" style="display: table-cell;" colspan="4">No Result Found</td>';
            $html .= '</td>';
            $html .= '</tr>';
        }else{
            foreach($search_result as $index => $search_data){
                $html .= '';
                $html .= '<tr>';
                $html .= '<td class="footable-first-visible" style="display: table-cell;">'.($index+1).'</td>';
                $html .= '<td style="display: table-cell;">'.$search_data->name.'</td>';
                $html .= '<td style="display: table-cell;" class="">'.$search_data->email.'</td>';
                $html .= '<td style="display: table-cell;">+91-'.$search_data->phone.'</td>';
                $html .= '<td style="display: table-cell;" class="">'. $search_data->address ?? '-'.'</td>';
                $html .= '<td class="" style="display: table-cell;">'.$search_data->father_name ?? '-'.'</td>';
                $html .= '<td class="" style="display: table-cell;">'.$search_data->aadhar_number ?? '-'.'</td>';
                $html .= '<td style="display: table-cell;">';
                    $html .= '<div class="dropdown vartical">';
                        $html .= '<a href="#" class="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                            $html .= '<span class="new-icon">  <i class="fa-solid fa-ellipsis-vertical"></i></span>';
                        $html .= '</a>';
                        $html .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                          $html .= '<a class="dropdown-item" href="'.route('backend.delivery_boy.edit', [$search_data->id]).'"> Edit</a> ';
                        $html .= '</div>';
                      $html .= '</div>';
                 $html .= '</td> ';
                 $html .= '</tr>';
            }
        }
        return $html;
    }catch(\Exception $e){
    return $e->getMessage();
    }
     } 
// ------------------------------------------------------------------------------------------

}
