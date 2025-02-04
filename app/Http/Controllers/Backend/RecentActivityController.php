<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\RecentActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RecentActivityController extends Controller
{
    public function index(){
        $recent_activies = RecentActivity::orderBy('id', 'desc')->paginate(20);
        return view('backend.recent_activity.index', compact('recent_activies'));
    }

    public function search(Request $request){
        $search_val = $request->search_val;
        if($search_val != ''){
            $search_result = RecentActivity::where('user_name', 'LIKE', '%'.$search_val.'%') 
            ->orWhere('user_email', 'LIKE', '%'.$search_val.'%')
            ->orWhere('city', 'LIKE', '%'.$search_val.'%')
            ->orWhere('country', 'LIKE', '%'.$search_val.'%')->get();
        }else{
            $search_result = RecentActivity::orderBy('id', 'desc')->paginate(10);
        }
        $html = '';
        $count = 1;
        if($search_result->count() == 0){
            $html .= '<tr>';
            $html .= '<td class="text-center" style="display: table-cell;" colspan="4">No Result Found</td>';
            $html .= '</td>';
            $html .= '</tr>';
        }else{
            foreach($search_result as $search_data){
                $html .= ''; 
                $html .= '<tr>';
                $html .= '<td>'.$search_data->user_name.'</td>';
                $html .= '<td>'.$search_data->user_email.'</td>';
                $html .= '<td>'.$search_data->country.'</td>';
                $html .= '<td>'.$search_data->region.'</td>';
                $html .= '<td>'.$search_data->city.'</td>';
                $html .= '<td>'.$search_data->zip.'</td>';
                $html .= '<td>'.Carbon::parse($search_data->created_at)->format('d M, Y').'</td>';
                $html .= '</tr>';
            }
        }
        return $html;
    }
}
