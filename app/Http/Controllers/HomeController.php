<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event_verticals as Event_verticals;
use App\User as User;
use App\Models\Events as Events;
use Illuminate\Support\Facades\View;
use Helper;
use Illuminate\Support\Facades\Auth;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $event_verticals=Event_verticals::orderBy('event_verticals_name','asc')->get();
        View::share('event_verticals',$event_verticals);
        
            //$user = auth()->user();
            //dd($user);
            //print_r($user_data); exit();
            //View::share('user',$user_data);
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $vendors=User::where('user_type','=','vendor')->skip(0)->take(6)->get();
        $data['vendors']=$vendors;
        return view('welcome')->with(compact('data'));

    }
    public function events(){
        $data['page_title']='Events';
        $data['events']=Events::where('status','=','1')->paginate(12);
        return view('events')->with(compact('data'));

    }
    public function event_details($slug){
        $event=Events::where('slug','=',$slug)->first();
        $data['companies']=User::where('user_type','company')->pluck('name','id')->toArray();
        //print_r($event); exit;
        $data['page_title']=$event->event_title;
        $data['event']=$event;
        return view('event_details')->with(compact('data'));

    }
    public function getquoteexhibitor(){
        
    }
    public function event_vertical_list($slug){
        $data['page_title']='Events';
        $event_vertical_id=Helper::get_returnvaluefield('event_verticals','slug',$slug,'id');
        $event_verticals_name=Helper::get_returnvaluefield('event_verticals','id',$event_vertical_id,'event_verticals_name');
        $data['page_title']='Top events in '.$event_verticals_name .' verticals';
        //echo $event_vertical_id; exit;
        $data['events']=Events::where([['status','=','1'],['event_vertical_id','=',$event_vertical_id]])->paginate(12);
       // echo $data['events']->count(); exit;
        return view('event_vertical_list')->with(compact('data'));
    }

    public function vendors($state='',$v_cat=''){
        //DB::enableQueryLog();
        if($state!='' && $v_cat!=''){
            $state_id=Helper::get_returnvaluefield('cities','slug',$state,'id');
            $v_cat_id=Helper::get_returnvaluefield('vendor_categories','slug',$v_cat,'id');

            $matchThese = [ 'users.user_type'=>'vendor', 'user_meta.meta_key' => 'service_area', 'user_meta.meta_value'=>$state_id, 'user_meta.meta_key'=>'vendor_category','user_meta.meta_value' => $v_cat_id];

        } elseif($state!='' && $v_cat==''){
            $state_id=Helper::get_returnvaluefield('cities','slug',$state,'id');
            $matchThese = [ 'users.user_type'=>'vendor', 'user_meta.meta_key' => 'service_area', 'user_meta.meta_value'=>$state_id];
        } else{
            $matchThese = [ 'users.user_type'=>'vendor'];

        }
        if(empty($state) && empty($v_cat)){
            $vendors_all=User::where($matchThese)->paginate(12);
        } else{
            $vendors_all=User::join('user_meta', 'users.id', '=', 'user_meta.user_id')->select('users.*','user_meta.id as meta_id, user_meta..user_id as meta_user_id, user_meta.meta_key as meta_key, user_meta.meta_value as meta_value')->where($matchThese)->paginate(12);
        }
        
       // $query = DB::getQueryLog();

        //print_r($query); exit;
        $data['page_title']='Vendors';
        $data['vendors']=$vendors_all;
        return view('vendors_list')->with(compact('data'));
    }
    public function vendor($state='',$v_cat='',$id=''){
        $vendor=User::where('id','=',$id)->first();
        //print_r($event); exit;
        $data['page_title']='Profile';
        $data['vendor']=$vendor;
        return view('vendor_details')->with(compact('data'));

    }
    public function company($id=''){
        $company=User::where('id','=',$id)->first();
        //print_r($event); exit;
        $data['page_title']='Company';
        $data['company']=$company;
        return view('comapny_details')->with(compact('data'));

    }
    public function companies(){
        //DB::enableQueryLog();
       $data['companies']=User::where('user_type','company')->paginate(12);
        //$query = DB::getQueryLog();

        //print_r($query); exit;
        $data['page_title']='Companies';
        return view('company_list')->with(compact('data'));
    }

}
