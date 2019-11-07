<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_event as User_event;
use App\User as User;
use Helper;
use Auth;

class AjaxController extends Controller
{
    public function __construct()
    {
        
    }

    public function login_check(){
        $rtn=array();
        if(!Auth::check()){
            $rtn['login']='false';
        } else{
            $rtn['login']='true';
        }
        echo json_encode($rtn);
    }

    public function popup_login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $rtn=array();
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $rtn['status']='true';
        } else{
            $rtn['status']='false';
        }
        echo json_encode($rtn);
        //return redirect()->back()->withInput($request->only('email','remember'));

    }

    public function get_service_list_ajax(Request $request){
        $html='';
        $rtn=array();
        $lists=Helper::get_user_meta($request->input('user_id'),$request->input('type'),true);
        if(!empty($lists)){
            $lists=explode(',', $lists);
            $arraye=array();
            $html.='<label for="service_type" class="col-sm-3">'.ucfirst($request->input('type')).' </label>';
            $html.='<div class="col-sm-9">';
            $html.='<select name="services" >';
            foreach($lists as $list){
                $html.='<option value="'.$list.'" >'.$list.'</option>';
            }
            $html.='</select>';
            $html.='</div>';
            $rtn['status']='true';
            $rtn['html']=$html;
        } else{
            $rtn['status']='false';
            $rtn['html']='';
        }
        echo json_encode($rtn);
    }
    public function get_vendor_company_details(Request $request){
        $rtn=array(
            'status'=>'false',
            'html'=>''
        );
        //echo $request->input('id'); exit;
        $company_id=$request->input('id');
        $compani_details=User::where('id',$company_id)->first();
        $html='';
        $address=Helper::get_user_meta($compani_details->id,'address',true);
        $phone=Helper::get_user_meta($compani_details->id,'phone',true);
        if(!empty($address))
            $html.='<b>Address: </b>'.$address.'<br>';
        if(!empty($phone))
            $html.='<b>Phone: </b>'.$phone.'<br>';
            
        $html.='<b>Email: </b>'.$compani_details->email;
        $rtn=array(
            'status'=>'true',
            'html'=>$html
        );
        echo json_encode($rtn);
    }
    public function add_event_ajax(Request $request){
        $rtn=array();
        if(Auth::check()){
            $sdata['user_id']=auth()->user()->id;
            $sdata['event_id']=$request->input('event_id');
            $sdata['created_at']=date('Y-m-d H:i:s');
            $sdata['updated_at']=date('Y-m-d H:i:s');
            $check_added_event=Helper::check_added_event($sdata);
            if($check_added_event==false){
                $user_event_id=User_event::insertGetId( $sdata );
                if($user_event_id){
                    $rtn['status']='true';
                    $rtn['msg']='Event successfully added to your event calender!';
                } else{
                    $rtn['status']='false';
                    $rtn['msg']='Please try again later or contact to administer!';
                }
            } else{
                $rtn['status']='true';
                $rtn['msg']='Event already added to your event calender!';
            }
            
        } else{
            $rtn['status']='false';
            $rtn['msg']='You need to login first!';
        }
        echo json_encode($rtn);

    }
    public function ajax_image_upload(Request $request){
        

    }
}
