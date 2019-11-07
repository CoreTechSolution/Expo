<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\User as User;
use App\Models\Events as Events;
use App\Models\Event_type as Event_type;
use App\Models\Vendor_categories as Vendor_categories;
use App\Models\User_event as User_event;
use App\Models\Event_verticals as Event_verticals;
use App\Models\Attachments as Attachments;
use Helper;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function index()
    {
        $data['page_title']='Dashboard';
        $data['user']= auth()->user();
        return view('user.dashboard')->with(compact('data'));
    }
    public function edit_profile(){
        $data['page_title']='Profile';
        $data['user']= auth()->user();
        $data['vendor_categories']= Vendor_categories::pluck('vendor_category_name','id')->toArray();
        return view('user.edit_profile')->with(compact('data'));
    }
    public function edit_profile_gallery(){
        $data['page_title']='Gallery';
        $data['user']= auth()->user();
        $data['vendor_categories']= Vendor_categories::pluck('vendor_category_name','id')->toArray();
        return view('user.edit_profile_gallery')->with(compact('data'));
    }
    public function edit_profile_gallery_submit(Request $request){
        $Input=$request->input();
        $gallery_images=$Input['event_gallery_image'];
        //print_r($gallery_images[0]); exit;
        if(!empty($gallery_images[0])){
            Helper::update_user_meta($Input['id'],'gallery',serialize($gallery_images));
        }
        //$profile_id=User::insertGetId( $sdata );
            return back()->with('success','updated successful');
       
    }
    public function edit_profile_submit(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'user_type'=>'required',
            //'company'=>'required',
        ]);
        $Input=$request->input();
        $sdata['name']=$Input['name'];
        if($Input['user_type']!='company'){
            $sdata['company']=$Input['company'];
        }

        $sdata['updated_at']=date('Y-m-d H:i:s');

        if(!empty($request->file('profile_pic'))){
            $image = $request->file('profile_pic');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/profile_pics/');
            $profile_pic=$image->move($destinationPath, $input['imagename']);
            $image_names=explode('/', $profile_pic);
            $image_name=$image_names[count($image_names)-1];
            $sdata['profile_pic']=$image_name;
        }

        if($Input['user_type']=='vendor'){

        }
        
        $result=User::where('id',$Input['id'])->update($sdata);
        if(!empty($Input['about']))
            Helper::update_user_meta($Input['id'],'about',$Input['about']);
        if(!empty($Input['address']))
            Helper::update_user_meta($Input['id'],'address',$Input['address']);
        if(!empty($Input['phone']))
            Helper::update_user_meta($Input['id'],'phone',$Input['phone']);
        if(!empty($Input['vendor_category']))
            Helper::update_user_meta($Input['id'],'vendor_category',$Input['vendor_category']);
        if(!empty($Input['service_area']))
            Helper::update_user_meta($Input['id'],'service_area',$Input['service_area']);
        //$profile_id=User::insertGetId( $sdata );
        if($result){
            
            
            
            return back()->with('success','Profile updated successful');
        } else{
            return back()->with('error','Please try again later!');
        }

    }

    public function my_event_calender(){
        $data['page_title']='My Event Calender';
        $data['event_verticals']=Event_verticals::pluck('event_verticals_name','id')->toArray();
        $data['event_types']=Event_type::pluck('name','id')->toArray();
        $data['user']= auth()->user();
        return view('user.my_event_calender')->with(compact('data'));
    }

    public function calender_data(){
        $events=Events::select('*')->get();
        //print_r($calenderdatas); exit();
        foreach ($events as $event){
            if($event->status=='1'){
                $bg_color='green';
            } elseif($event->status=='2'){
                $bg_color='#db9305';
            } elseif($event->status=='3'){
                $bg_color='green';
            } elseif($event->status=='4'){
                $bg_color='red';
            }
            $eventsResponse[] = [
                'title'=>$event->event_title,
                'start'=> Carbon::parse($event->event_date_start)->toDateTimeString(),
                'end' => Carbon::parse($event->event_date_end)->toDateTimeString(),
                'allday'=>false,
                'editable'=>true,
                'backgroundColor'=> $bg_color,
                'type'=>$event->event_location,
                'id'=>$event->id,


            ];
        }
        echo json_encode($eventsResponse);
    }

    public function calender_data_add(Request $request){
        $rtn=array();
        $this->validate($request, [
            'event_title' => 'required|string|min:1|max:255',
            'event_description' => 'string|min:1|max:500',
            'event_image' => 'sometimes|image|max:50000',
            'pdf_doc_upload' => 'sometimes|mimes:pdf|max:50000',
        ]);
        $sdata['event_title']=$request->input('event_title');
        $event_title=$sdata['event_title'];
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $sdata['event_title'])));
        $sdata['slug']=$slug;
        $sdata['event_headline']=$request->input('event_headline');
        $sdata['event_description']=$request->input('event_description');
        $sdata['event_vertical_id']=$request->input('event_vertical_id');
        $sdata['event_type']=$request->input('event_type');
        $sdata['event_date_start']=$Input['event_date_start'];
        $sdata['event_date_end']=$Input['event_date_end'];
        $sdata['event_time_start']=$Input['event_time_start'];
        $sdata['event_time_end']=$Input['event_time_end'];
        $sdata['event_location']=$request->input('event_location');
        $sdata['event_country']=$request->input('event_country');
        $sdata['event_city']=$request->input('event_city');
        $sdata['attendees']=$request->input('attendees');
        $sdata['exhibitors']=$request->input('exhibitors');
        $sdata['event_url']=$request->input('event_url');
        $sdata['event_phone']=$request->input('event_phone');
        $sdata['event_email']=$request->input('event_email');
        $sdata['created_by']=$request->input('user_id');
        $sdata['youtube_video_link']=$request->input('youtube_video_link');
        $sdata['vimeo_video_link']=$request->input('vimeo_video_link');
        $sdata['created_at']=date('Y-m-d H:i:s');
        $sdata['updated_at']=date('Y-m-d H:i:s');
        $sdata['status']='2';

        if(!empty($request->file('event_image'))){
            $image = $request->file('event_image');
            $input['imagename'] = time().'_'.$image->getClientOriginalName();
            $destinationPath = public_path('/uploads/event_image/');
            $event_image=$image->move($destinationPath, $input['imagename']);
            $image_names=explode('/', $event_image);
            $image_name=$image_names[count($image_names)-1];
            $sdata['event_image']=$image_name;
        }
        if(!empty($request->file('pdf_doc_upload'))){
            $image = $request->file('pdf_doc_upload');
            $input['imagename'] = time().'_'.$image->getClientOriginalName();
            $destinationPath = public_path('/uploads/event_image/');
            $pdf_doc_upload=$image->move($destinationPath, $input['imagename']);
            $image_names=explode('/', $pdf_doc_upload);
            $image_name=$image_names[count($image_names)-1];
            $sdata['pdf_doc_upload']=$image_name;
        }
        if(!empty($request->file('event_gallery_image'))){
            $allowedfileExtension=['jpeg','jpg','png','gif'];
            $files = $request->file('event_gallery_image');
            $cc=0;

            //print_r($files); exit;
            foreach($files as $file){
                
                $input['imagename'] = explode('.',$file->getClientOriginalName())[0].time().'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/event_image/');
                $event_image=$file->move($destinationPath, $input['imagename']);
                $image_names=explode('/', $event_image);
                $image_ids[$cc]=$image_names[count($image_names)-1];
                $cc++;
            }
        }
        //print_r($image_ids); exit;
        $event_id=Events::insertGetId($sdata);
        if($event_id){
            if(!empty($image_ids)){
                for ($i=0; $i < count($image_ids) ; $i++) { 
                    $ssdata['event_id']=$event_id;
                    $ssdata['image_path']=$image_ids[$i];
                    $ssdata['image_name']='';
                    $ssdata['image_alt']='';
                    $ssdata['created_at']=date('Y-m-d H:i:s');
                    $ssdata['updated_at']=date('Y-m-d H:i:s');
                    $attachment_id=Attachments::insertGetId($ssdata);
                }
            }
            
            $rtn['status']='true';
            $rtn['event_title']=$event_title;
            $rtn['start']=$request->input('event_date');
            $rtn['end']=$request->input('event_date');
        } else{
            $rtn['status']='false';
        }

        return redirect('my-event-calender');

    }
    public function my_event_edit($id=''){
        $data['page_title']='Event';
        $data['user']= auth()->user();
        $data['event_verticals']=Event_verticals::pluck('event_verticals_name','id')->toArray();
        $data['event_types']=Event_type::pluck('name','id')->toArray();
        $data['event']=Events::where('id',$id)->first();
        return view('user.my_event_edit')->with(compact('data'));

    }
    public function my_event_edit_submit(Request $request){

        $this->validate($request, [
            'event_title' => 'required|string|min:1|max:100',
            'event_description' => 'string|min:1|max:500',
            'slug' =>'required',
            'event_vertical_id' =>'required',
            'event_type' =>'required',
            'event_image' => 'sometimes|image|max:50000',
            'pdf_doc_upload' => 'sometimes|mimes:pdf|max:50000',
        ]);

        $Input=$request->input();
        $sdata['event_title']=$Input['event_title'];
        $sdata['slug']=$Input['slug'];
        $sdata['event_headline']=$Input['event_headline'];
        $sdata['event_description']=$Input['event_description'];
        $sdata['event_vertical_id']=$request->input('event_vertical_id');
        $sdata['event_type']=$request->input('event_type');
        $sdata['event_date_start']=$Input['event_date_start'];
        $sdata['event_date_end']=$Input['event_date_end'];
        $sdata['event_time_start']=$Input['event_time_start'];
        $sdata['event_time_end']=$Input['event_time_end'];
        $sdata['event_location']=$Input['event_location'];
        $sdata['event_country']=$Input['event_country'];
        $sdata['event_city']=$Input['event_city'];
        $sdata['attendees']=$Input['attendees'];
        $sdata['exhibitors']=$Input['exhibitors'];
        $sdata['event_phone']=$Input['event_phone'];
        $sdata['event_email']=$Input['event_email'];
        $sdata['event_url']=$Input['event_url'];
        $sdata['youtube_video_link']=$Input['youtube_video_link'];
        $sdata['vimeo_video_link']=$Input['vimeo_video_link'];
        $sdata['updated_at']=date('Y-m-d H:i:s');

        if(!empty($request->file('event_image'))){
            $image = $request->file('event_image');
            $input['imagename'] = time().'_'.$image->getClientOriginalName();
            $destinationPath = public_path('/uploads/event_image/');
            $event_image=$image->move($destinationPath, $input['imagename']);
            $image_names=explode('/', $event_image);
            $image_name=$image_names[count($image_names)-1];
            $sdata['event_image']=$image_name;
        }
        if(!empty($request->file('pdf_doc_upload'))){
            $image = $request->file('pdf_doc_upload');
            $input['pdgfile'] = time().'_'.$image->getClientOriginalName();
            $destinationPath = public_path('/uploads/event_image/');
            $pdf_doc_upload=$image->move($destinationPath, $input['pdgfile']);
            $image_names=explode('/', $pdf_doc_upload);
            $image_name=$image_names[count($image_names)-1];
            $sdata['pdf_doc_upload']=$image_name;
        }
        if(!empty($request->file('event_gallery_image'))){
            $allowedfileExtension=['jpeg','jpg','png','gif'];
            $files = $request->file('event_gallery_image');
            $cc=0;

            //print_r($files); exit;
            foreach($files as $file){
                
                $input['imagename'] = explode('.',$file->getClientOriginalName())[0].time().'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/event_image/');
                $event_image=$file->move($destinationPath, $input['imagename']);
                $image_names=explode('/', $event_image);
                $image_ids[$cc]=$image_names[count($image_names)-1];
                $cc++;
            }
        }
        if(!empty($image_ids)){
            for ($i=0; $i < count($image_ids) ; $i++) { 
                $ssdata['event_id']=$request->input('id');
                $ssdata['image_path']=$image_ids[$i];
                $ssdata['image_name']='';
                $ssdata['image_alt']='';
                $ssdata['created_at']=date('Y-m-d H:i:s');
                $ssdata['updated_at']=date('Y-m-d H:i:s');
                $attachment_id=Attachments::insertGetId($ssdata);
            }
        }
        $result=Events::where('id',$request->input('id'))->update($sdata);
        if($result){
            return back()->with('success','Event updated successful');
        } else{
            return back()->with('error','Please try again later!');
        }
    }
    public function event_calender(){
        $data['page_title']='Event Calender';
        $data['user']= auth()->user();
        $data['events']= User_event::join('events','user_event.event_id','=','events.id')->where('user_id','=',$data['user']->id)->get();
        //print_r($data['events']); exit;
        return view('user.event_calender')->with(compact('data'));
    }
}
