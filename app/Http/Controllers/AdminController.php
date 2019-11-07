<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pages as Pages;
use App\Models\Event_verticals as Event_verticals;
use App\Models\Vendor_categories as Vendor_categories;
use App\Models\Vendor_testimonials as Vendor_testimonials;
use App\Models\Cities as Cities;
use App\Models\Events as Events;
use App\Models\Event_type as Event_type;
use App\Models\Attachments as Attachments;
use App\Models\Event_user as Event_user;
use App\User as User;
use DB;
use Helper;
use DateTime;
use Auth;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }
    public function general_settings(){
        $data['page_title']='General Settings';
        return view('admin.general_settings')->with(compact('data'));
    }
    public function demo_filemanager(){
        $data['page_title']='General Settings';
        return view('admin.demo_filemanager')->with(compact('data'));
    }
    public function pages(){
        $data['page_title']='Pages';
        $data['pages']=Pages::all();
        return view('admin.pages')->with(compact('data'));
    }
    public function add_page(){
        $data['page_title']='Add New Page';
        return view('admin.add_page')->with(compact('data'));
    }
    public function addpagetodb(Request $request){
        $this->validate($request, [
            'page_name'=>'required',
            'slug'=>'required'
        ]);
        $Input=$request->input();
        $sdata['page_name']=$Input['page_name'];
        $sdata['slug']=$Input['slug'];
        $sdata['page_content']=$Input['page_content'];
        $sdata['meta_keyword']=$Input['meta_keyword'];
        $sdata['meta_description']=$Input['meta_description'];
        $sdata['created_at']=date('Y-m-d H:i:s');
        $sdata['updated_at']=date('Y-m-d H:i:s');
        $page_id=Pages::insertGetId( $sdata );
        if($page_id){
            return back()->with('success','Product updated successful');
        } else{
            return back()->with('error','Please try again later!');
        }
    }
    public function event_verticals(){
        $data['page_title']='Event Verticals';
        $data['verticals']=Event_verticals::all();
        return view('admin.event_verticals')->with(compact('data'));
    }
    public function add_verticals(){
        $data['page_title']='Add New Verticals';
        return view('admin.add_verticals')->with(compact('data'));
    }
    public function add_event_verticals(Request $request){
        $this->validate($request, [
            'event_verticals_name'=>'required',
            'slug'=>'required'
        ]);
        $Input=$request->input();
        $sdata['event_verticals_name']=$Input['event_verticals_name'];
        $sdata['slug']=$Input['slug'];
        $sdata['event_verticals_descriptions']=$Input['event_verticals_descriptions'];
        $sdata['created_at']=date('Y-m-d H:i:s');
        $sdata['updated_at']=date('Y-m-d H:i:s');
        $book_id=Event_verticals::insertGetId( $sdata );
        if($book_id){
            return back()->with('success','Event verticals added successful');
        } else{
            return back()->with('error','Please try again later!');
        }
    }
    public function edit_event_verticals($id=''){
        $data['page_title']='Edit Verticals';
        $data['event_verticals'] = Event_verticals::where('id', $id)->first();
        return view('admin.edit_event_verticals')->with(compact('data'));
    }
    public function edit_event_verticals_submit(Request $request){
        $this->validate($request, [
            'event_verticals_name'=>'required',
            'slug'=>'required'
        ]);
        $Input=$request->input();
        $sdata['event_verticals_name']=$Input['event_verticals_name'];
        $sdata['slug']=$Input['slug'];
        $sdata['event_verticals_descriptions']=$Input['event_verticals_descriptions'];
        $sdata['updated_at']=date('Y-m-d H:i:s');
        $result=Event_verticals::where('id',$request->input('id'))->update($sdata);
        if($result){
            return back()->with('success','Event verticals updated successful');
        } else{
            return back()->with('error','Please try again later!');
        }
    }
    public function import_event_verticals(){
        $data['page_title']='Import Event Verticals from CSV';
        return view('admin.import_event_verticals')->with(compact('data'));
    }
    public function import_event_verticals_submit(Request $request){
        $data['page_title']='Import Event Verticals from CSV';
        //print_r($request->input()); exit;
        if(!empty($request->file('import_csv'))){
//echo 'hello'; exit();
            $csv_file = $request->file('import_csv');
            //print_r($csv_file); exit;
            $input['csvFile'] = time().'.'.$csv_file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/csv');
            $csv_save_path=$csv_file->move($destinationPath, $input['csvFile']);
            $csvArrs = Helper::csvToArray($csv_save_path);
            if(!empty($csvArrs)){
                $k=0;
                $p=0;
                $u=0;
                foreach ($csvArrs as $row) {
                    //print_r($row); exit;
                    if($k>0 && ($row[0]!='')){
                        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $row[0])));
                        $check_present=Helper::check_present('event_verticals','slug',$slug);
                        if($check_present==false){
                            $sdata['event_verticals_name']=$row[0];
                            $sdata['event_verticals_descriptions']=$row[1];
                            //$sdata['is_active']=1;
                            $sdata['created_at']=date('Y-m-d H:i:s');
                            $sdata['updated_at']=date('Y-m-d H:i:s');
                            $sdata['slug']=$slug;
                            //$sdata['cat_type']=$row[1];
                            $id=Event_verticals::insertGetId(
                                $sdata
                            );
                            if($id){
                                $u++;
                            }
                            # data save to category table
                        } else{
                            $p++;
                        }
                    }
                    $k++;
                }
            }
            $mss=$u.' Event Verticals uploaded!';
            if($p>0){
                $mss.= ' and '.$p.' Event verticals already pesent in database!';
            }
            return back()->with('success',$mss);
            //$image_names=explode('/', $product_image);
        }
    }
    public function event_types(){
        $data['page_title']='Event type';
        $data['event_types']=Event_type::all();
        return view('admin.event_types')->with(compact('data'));
    }
    public function add_event_type(){
        $data['page_title']='Add New Event Type';
        return view('admin.add_event_type')->with(compact('data'));
    }
    public function add_event_type_submit(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'slug'=>'required'
        ]);
        $Input=$request->input();
        $sdata['name']=$Input['name'];
        $sdata['slug']=$Input['slug'];
        $sdata['created_at']=date('Y-m-d H:i:s');
        $sdata['updated_at']=date('Y-m-d H:i:s');
        $type_id=Event_type::insertGetId( $sdata );
        if($type_id){
            return back()->with('success','Event type added successful');
        } else{
            return back()->with('error','Please try again later!');
        }
    }
    public function edit_event_type($id=''){
        $data['page_title']='Edit Event Type';
        $data['event_type'] = Event_type::where('id', $id)->first();
        return view('admin.edit_event_type')->with(compact('data'));
    }
    public function edit_event_type_submit(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'slug'=>'required'
        ]);
        $Input=$request->input();
        //print_r($Input); exit;
        $sdata['name']=$Input['name'];
        $sdata['slug']=$Input['slug'];
        $sdata['updated_at']=date('Y-m-d H:i:s');
        $result=Event_type::where('id',$request->input('id'))->update($sdata);
        if($result){
            return back()->with('success','Event type updated successful');
        } else{
            return back()->with('error','Please try again later!');
        }
    }
    public function events(){
        $data['page_title']='Events';
        $data['events']=Events::orderBy('updated_at', 'desc')->get();
        return view('admin.events')->with(compact('data'));
    }
    public function add_event()
    {
        $data['page_title'] = 'Event Add';
        $data['event_verticals'] = Event_verticals::pluck('event_verticals_name', 'id')->toArray();
        $data['event_types'] = Event_type::pluck('name', 'id')->toArray();
        $data['attendees_dropdown']=User::where('user_type','attendee')->pluck('name','id')->toArray();
        $data['exhibitors_dropdown']=User::where('user_type','exhibitor')->pluck('name','id')->toArray();
        return view('admin.add_event')->with(compact('data'));
    }
    public function add_event_submit(Request $request){
        $this->validate($request, [
            'event_title'=>'required',
            'slug'=>'required'
        ]);
        $Input=$request->input();
        $sdata['created_by'] = 1;
        $sdata['event_title']=$Input['event_title'];
        $sdata['slug']=$Input['slug'];
        $sdata['event_vertical_id']=$Input['event_vertical_id'];
        $sdata['event_type']=$Input['event_type'];
        $sdata['event_headline']=$Input['event_headline'];
        $sdata['event_description']=addslashes($Input['event_description']);
        $sdata['event_date_start']=$Input['event_date_start'];
        $sdata['event_date_end']=$Input['event_date_end'];
        $times=$Input['event_time_start1'];
        $dates=$Input['event_date_start1'];
        $time_array=array();
        for($i=0;$i < count($times);$i++){
            $time_array[$i]['date']=$dates[$i];
            $time_array[$i]['time']=$times[$i];
        }
        $sdata['event_time_start'] = serialize($time_array);
        $sdata['event_location']=$Input['event_location'];
        $sdata['event_country']=$Input['event_country'];
        $sdata['event_city']=$Input['event_city'];
        $sdata['event_phone']=$Input['event_phone'];
        $sdata['event_email']=$Input['event_email'];
        $sdata['event_url']=$Input['event_url'];
        /* featured image and gallery image add */
        if(!empty($Input['event_image'])){
            $sdata['event_image']=$Input['event_image'];
        }
        $gallery_images=$Input['event_gallery_image'];
        //print_r($gallery_images[0]); exit;
        if(!empty($gallery_images[0])){
            $sdata['gallery_image']=serialize($gallery_images);
        }
        
        $sdata['youtube_video_link']=$Input['youtube_video_link'];
        $sdata['vimeo_video_link']=$Input['vimeo_video_link'];
        $sdata['status']=$Input['status'];
        if(!empty($Input['is_top'])){
            $is_top=1;
        } else{
            $is_top=0;
        }
        $sdata['is_top']=$is_top;
        if(!empty($Input['is_featured'])){
            $is_featured=1;
        } else{
            $is_featured=0;
        }
        $sdata['is_featured']=$is_featured;
        $sdata['updated_at']=date('Y-m-d H:i:s');
        $sdata['created_at']=date('Y-m-d H:i:s');

        $id = Events::insertGetId($sdata);


        /* Event meta data add */

        Helper::update_event_meta($id, 'last_year_date', $Input['last_year_date']);
        Helper::update_event_meta($id, 'next_year_date', $Input['next_year_date']);
        Helper::update_event_meta($id, 'last_event_attendees', $Input['last_event_attendees']);
        Helper::update_event_meta($id, 'last_event_exhibitors', $Input['last_event_exhibitors']);
        /* Event user add */
        /* Attenddes event user add */
        $attendees_lists=$Input['attendees_list_show'];
        if(!empty($attendees_lists)){
            foreach($attendees_lists as $attendee){
                Helper::event_user_add($id,'attendee',$attendee);
            }
        }
        /* Exhibitor event user add */
        $exhibitors_lists=$Input['exhibitors_list_show'];
        if(!empty($exhibitors_lists)){
            foreach($exhibitors_lists as $exhibitor){
                Helper::event_user_add($id,'exhibitor',$exhibitor);
            }
        }
         /* Event meta data add */
        Helper::update_event_meta($id, 'attendees_info', $Input['attendees_info']);
        Helper::update_event_meta($id, 'exhibitor_info', $Input['exhibitor_info']);
        
        if($id){
            return back()->with('success','Event added successful');
        } else{
            return back()->with('error','Please try again later!');
        }
    }
    public function event_view($id=''){
        $data['page_title']='Event View';
        $data['event_verticals']=Event_verticals::pluck('event_verticals_name','id')->toArray();
        $data['event_types']=Event_type::pluck('name','id')->toArray();
        $data['attendees_dropdown']=User::where('user_type','attendee')->pluck('name','id')->toArray();
        $data['exhibitors_dropdown']=User::where('user_type','exhibitor')->pluck('name','id')->toArray();
        $data['event']=Events::where('id',$id)->first();
        return view('admin.event_view')->with(compact('data'));
    }
    public function event_view_submit(Request $request){
        $this->validate($request, [
            'event_title'=>'required',
            'slug'=>'required'
        ]);
        $Input=$request->input();
        $sdata['created_by'] = 1;
        $sdata['event_title']=$Input['event_title'];
        $sdata['slug']=$Input['slug'];
        $sdata['event_vertical_id']=$Input['event_vertical_id'];
        $sdata['event_type']=$Input['event_type'];
        $sdata['event_headline']=$Input['event_headline'];
        $sdata['event_description']=addslashes($Input['event_description']);
        $sdata['event_date_start']=$Input['event_date_start'];
        $sdata['event_date_end']=$Input['event_date_end'];
        $times=$Input['event_time_start1'];
        $dates=$Input['event_date_start1'];
        $time_array=array();
        for($i=0;$i < count($times);$i++){
            $time_array[$i]['date']=$dates[$i];
            $time_array[$i]['time']=$times[$i];
        }
        $sdata['event_time_start'] = serialize($time_array);

        $sdata['event_location']=$Input['event_location'];
        $sdata['event_country']=$Input['event_country'];
        $sdata['event_city']=$Input['event_city'];
         /* Event meta data add */

        Helper::update_event_meta($request->input('id'), 'last_year_date', $Input['last_year_date']);
        Helper::update_event_meta($request->input('id'), 'next_year_date', $Input['next_year_date']);
        Helper::update_event_meta($request->input('id'), 'last_event_attendees', $Input['last_event_attendees']);
        Helper::update_event_meta($request->input('id'), 'last_event_exhibitors', $Input['last_event_exhibitors']);

        $sdata['event_phone']=$Input['event_phone'];
        $sdata['event_email']=$Input['event_email'];
        $sdata['event_url']=$Input['event_url'];
        /* Event user add */
        /* Attenddes event user add */
        if(!empty($Input['attendees_list_show'])){
            $attendees_lists=$Input['attendees_list_show'];
        
            foreach($attendees_lists as $attendee){
                Helper::event_user_add($request->input('id'),'attendee',$attendee);
            }
        }
        /* Exhibitor event user add */
        if(!empty($Input['exhibitors_list_show'])){
        $exhibitors_lists=$Input['exhibitors_list_show'];
        
            foreach($exhibitors_lists as $exhibitor){
                Helper::event_user_add($request->input('id'),'exhibitor',$exhibitor);
            }
        }
         /* Event meta data add */
        Helper::update_event_meta($request->input('id'), 'attendees_info', $Input['attendees_info']);
        Helper::update_event_meta($request->input('id'), 'exhibitor_info', $Input['exhibitor_info']);
        /* featured image and gallery image add */
        if(!empty($Input['event_image'])){
            $sdata['event_image']=$Input['event_image'];
        }
        $gallery_images=$Input['event_gallery_image'];
        //print_r($gallery_images[0]); exit;
        if(!empty($gallery_images[0])){
            $sdata['gallery_image']=serialize($gallery_images);
        }
        
        $sdata['youtube_video_link']=$Input['youtube_video_link'];
        $sdata['vimeo_video_link']=$Input['vimeo_video_link'];
        $sdata['status']=$Input['status'];
        if(!empty($Input['is_top'])){
            $is_top=1;
        } else{
            $is_top=0;
        }
        $sdata['is_top']=$is_top;
        if(!empty($Input['is_featured'])){
            $is_featured=1;
        } else{
            $is_featured=0;
        }
        $sdata['is_featured']=$is_featured;
        $sdata['updated_at']=date('Y-m-d H:i:s');
        $result=Events::where('id',$request->input('id'))->update($sdata);
        if($result){
            return back()->with('success','Event updated successful');
        } else{
            return back()->with('error','Please try again later!');
        }
    }
    public function import_events(){
        $data['page_title']='Import Events from CSV';
        return view('admin.import_events')->with(compact('data'));
    }

    public function import_events_submit(Request $request)
    {
        ini_set("memory_limit", "32M");
        $data['page_title'] = 'Import Vendor Category from CSV';
        //print_r($request->input()); exit;
        if (!empty($request->file('import_csv'))) {
            //echo 'hello'; exit();
            $csv_file = $request->file('import_csv');
            //print_r($csv_file); exit;
            $input['csvFile'] = time() . '.' . $csv_file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/csv');
            $csv_save_path = $csv_file->move($destinationPath, $input['csvFile']);
            $csvArrs = Helper::csvToArray($csv_save_path);
            if (!empty($csvArrs)) {
                $k = 0;
                $p = 0;
                $u = 0;
                $e = 0;
                foreach ($csvArrs as $row) {
                    //print_r($row); exit;
                    if ($k > 0 && ($row[0] != '')) {
                        //echo '<pre>';
                        //print_r($row); exit;
                        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $row[2])));
                        //$check_present=Helper::check_present('vendor_categories','slug',$slug);
                        $event_type_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $row[0])));
                        $get_event_type = Helper::get_returnvaluefield('event_type', 'slug', $event_type_slug, 'id');
                        $event_vertical_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $row[1])));
                        $get_event_vertical = Helper::get_returnvaluefield('event_verticals', 'slug', $event_vertical_slug, 'id');
                        if (!empty($get_event_type)) {
                            $sdata['event_vertical_id'] = $get_event_vertical;
                            $sdata['event_type'] = $get_event_type;
                            $sdata['event_title'] = $row[2];
                            $sdata['slug'] = $slug;
                            $sdata['event_country'] = $row[7];
                            $sdata['event_city'] = $row[8];
                            $sdata['event_location'] = $row[9];
                            $sdata['event_url'] = $row[12];
                            $sdata['event_phone'] = $row[13];
                            $sdata['event_email'] = $row[14];
                            $sdata['event_description'] = addslashes($row[15]);
                            $sdata['status'] = 1;
                            $sdata['created_at'] = date('Y-m-d H:i:s');
                            $sdata['updated_at'] = date('Y-m-d H:i:s');
                            $sdata['created_by'] = 1;
                            /*Date and time calculation start here*/
                            $start_dt = '';
                            $end_dt = '';
                            /*for event start date and end*/
                            if (!empty($row[3])) {
                                $dates = explode('-', $row[3]);
                                if (!empty($dates)) {
                                    if (count($dates) == 2) {
                                        //print_r($dates); exit;
                                        //if()
                                        $start_dt = DateTime::createFromFormat('d M Y', trim($dates[0]))->format('Y-m-d');
                                        $end_dt = DateTime::createFromFormat('d M Y', trim($dates[1]))->format('Y-m-d');
                                    } else {
                                        $start_dt = DateTime::createFromFormat('d M Y', trim($dates[0]))->format('Y-m-d');
                                        $end_dt = DateTime::createFromFormat('d M Y', trim($dates[0]))->format('Y-m-d');
                                    }
                                }
                            }
                            $sdata['event_date_start'] = $start_dt;
                            $sdata['event_date_end'] = $end_dt;
                            /*for event time respective date*/
                            if (!empty($row[4])) {
                                $times = explode('|', $row[4]);
                                $time_array = array();
                                if (!empty($start_dt) && !empty($end_dt)) {
                                    if (count($times) > 1) {
                                        foreach ($times as $time) {
                                            //echo $time.'<br>';
                                            $time_strings = explode('(', $time);
                                            $get_time = $time_strings[0];
                                            $get_dates = explode('-', $time_strings[1]);
                                            //print_r($get_dates);
                                            if (!empty($get_dates)) {
                                                if (count($get_dates) > 1) {
                                                    //print_r($get_dates); exit;
                                                    $t_start_dt = DateTime::createFromFormat('d M Y', trim($get_dates[0]))->format('Y-m-d');
                                                    $t_end_dt = DateTime::createFromFormat('d M Y', trim(str_replace(')', '', $get_dates[1])))->format('Y-m-d');
                                                    $date1 = strtotime($t_start_dt);
                                                    $date2 = strtotime($t_end_dt);
                                                    $diff = abs($date2 - $date1);
                                                    $diff = round($diff / (60 * 60 * 24));
                                                    //exit;
                                                    for ($i = 0; $i <= $diff; $i++) {
                                                        if (empty($key_dt)) {
                                                            $key_dt = date('Y-m-d', strtotime($t_start_dt . ' + ' . $i . ' days'));
                                                        } else {
                                                            $key_dt = date('Y-m-d', strtotime($key_dt . ' + ' . $i . ' days'));
                                                        }
                                                        $key = count($time_array);
                                                        $time_array[$key]['date'] = $key_dt;
                                                        $time_array[$key]['time'] = $time_strings[0];
                                                    }
                                                } else {
                                                    //echo $get_dates[0]; exit;
                                                    $t_start_dt = DateTime::createFromFormat('d M Y', trim(str_replace(')', '', $get_dates[0])))->format('Y-m-d');
                                                    $t_end_dt = DateTime::createFromFormat('d M Y', trim(str_replace(')', '', $get_dates[0])))->format('Y-m-d');
                                                    $key = count($time_array);
                                                    $time_array[$key]['date'] = $t_start_dt;
                                                    $time_array[$key]['time'] = $time_strings[0];
                                                }
                                            }
                                        }
                                    } else {
                                        $date1 = strtotime($start_dt);
                                        $date2 = strtotime($end_dt);
                                        $diff = abs($date2 - $date1);
                                        $diff = round($diff / (60 * 60 * 24));
                                        //exit;
                                        for ($i = 0; $i <= $diff; $i++) {
                                            if (empty($key_dt)) {
                                                $key_dt = date('Y-m-d', strtotime($start_dt . ' + ' . $i . ' days'));
                                            } else {
                                                $key_dt = date('Y-m-d', strtotime($key_dt . ' + ' . $i . ' days'));
                                            }
                                            $key = count($time_array);
                                            $time_array[$key]['date'] = $key_dt;
                                            $time_array[$key]['time'] = $row[4];
                                        }
                                    }
                                }
                            }
                            //print_r($time_array); exit;
                            $sdata['event_time_start'] = serialize($time_array);

                            $sdata['created_at'] = date('Y-m-d H:i:s');
                            $sdata['updated_at'] = date('Y-m-d H:i:s');
                            if (!empty($row[16])) {
                                $sdata['unregister_exibitors'] = serialize(explode(',', $row[16]));
                            }
                            //echo '<pre>';
                            //print_r($sdata); exit;
                            //$sdata['cat_type']=$row[1];
                            $id = Events::insertGetId(
                                $sdata
                            );
                            if ($id) {

                                if (!empty($row[19])) {
                                    $images = explode('|', $row[19]);
                                    if (!empty($images)) {
                                        $count = 0;
                                        foreach ($images as $image) {
                                            //$img=explode('/', $image);
                                            $array_count = 0;
                                            if ($count == 0) {
                                                $sdata['event_image'] = $image;
                                            } else {
                                                $ssdata[$array_count]['event_id'] = $id;
                                                $ssdata[$array_count]['image_path'] = $image;
                                                $ssdata[$array_count]['image_name'] = '';
                                                $ssdata[$array_count]['image_alt'] = '';
                                                $ssdata[$array_count]['image_type'] = 'image';
                                                $ssdata[$array_count]['created_at'] = date('Y-m-d H:i:s');
                                                $ssdata[$array_count]['updated_at'] = date('Y-m-d H:i:s');
                                                //$attachment_id=Attachments::insertGetId($ssdata);
                                                $array_count++;
                                            }
                                            $count++;
                                        }
                                    }
                                }
                                if (!empty($ssdata)) {
                                    foreach ($ssdata as $image) {
                                        $attachment_id = Attachments::insertGetId($image);
                                    }
                                }
                                if (!empty($row[20])) {
                                    $videos = explode('|', $row[20]);
                                    if (!empty($videos)) {
                                        foreach ($videos as $video) {
                                            $msdata['event_id'] = $id;
                                            $msdata['image_path'] = $video;
                                            $msdata['image_name'] = '';
                                            $msdata['image_alt'] = '';
                                            $msdata['image_type'] = 'video';
                                            $msdata['created_at'] = date('Y-m-d H:i:s');
                                            $msdata['updated_at'] = date('Y-m-d H:i:s');
                                            $attachment_id = Attachments::insertGetId($msdata);
                                        }
                                    }
                                }
                                /*event meta add*/
                                if (!empty($row[3])) {
                                    $dates = explode('|', $row[3]);
                                    Helper::update_event_meta($id, 'event_date', serialize($dates));
                                }
                                if (!empty($row[4])) {
                                    $times = explode('|', $row[4]);
                                    Helper::update_event_meta($id, 'event_time', serialize($times));
                                }
                                Helper::update_event_meta($id, 'last_year_date', $row[5]);
                                Helper::update_event_meta($id, 'next_year_date', $row[6]);
                                Helper::update_event_meta($id, 'last_event_attendees', $row[10]);
                                Helper::update_event_meta($id, 'last_event_exhibitors', $row[11]);
                                if (!empty($row[21]))
                                    Helper::update_event_meta($id, 'facebook_link', $row[21]);
                                if (!empty($row[22]))
                                    Helper::update_event_meta($id, 'instagram_link', $row[22]);
                                if (!empty($row[23]))
                                    Helper::update_event_meta($id, 'linkedin_link', $row[23]);
                                if (!empty($row[24]))
                                    Helper::update_event_meta($id, 'twitter_link', $row[24]);
                                /*event meta add end*/
                                /* add unregistered exhibitor */

                                $u++;
                            }
                        } else {
                            $e++;
                        }
                    }
                    $k++;
                    //echo $k;
                }
            }
            $mss = $u . ' Events uploaded!';
            if ($p > 0) {
                $mss .= ' and ' . $p . ' Vendor Categories already pesent in database!';
            }
            return back()->with('success', $mss);
            //$image_names=explode('/', $product_image);
        }
    }
    public function event_import_update(Request $request){
        if (!empty($request->file('import_csv'))) {
            //echo 'hello'; exit();
            $csv_file = $request->file('import_csv');
            //print_r($csv_file); exit;
            $input['csvFile'] = time() . '.' . $csv_file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/csv');
            $csv_save_path = $csv_file->move($destinationPath, $input['csvFile']);
            $csvArrs = Helper::csvToArray($csv_save_path);
            if (!empty($csvArrs)) {
                $k = 0;
                $p = 0;
                $u = 0;
                $e = array();
                foreach ($csvArrs as $row) {
                    //print_r($row); exit;
                    if ($k > 0 && ($row[0] != '')) {
                        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $row[2])));
                        //$check_present=Helper::check_present('vendor_categories','slug',$slug);
                        $event_type_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $row[0])));
                        $get_event_type_id = Helper::get_returnvaluefield('event_type', 'slug', $event_type_slug, 'id');
                        $event_vertical_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $row[1])));
                        $get_event_vertical_id = Helper::get_returnvaluefield('event_verticals', 'slug', $event_vertical_slug, 'id');
                        $search_array=array('slug'=>$slug,'event_vertical_id'=>$get_event_vertical_id,'event_type'=>$get_event_type_id);
                        $get_event_id=Helper::get_event_id($search_array,true);
                        if($get_event_id){
                            if (!empty($row[17]))
                                Helper::update_event_meta($get_event_id, 'attendees_info', $row[17]);
                            if (!empty($row[18]))
                                Helper::update_event_meta($get_event_id, 'exhibitor_info', $row[18]);
                            $u++;
                        } else{
                            $e[$p]['slug']=$row[2];
                            $e[$p]['event_vertical_id']=$row[0];
                            $e[$p]['event_type']=$row[1];
                            $p++;
                            
                        }
                        
                    }
                    $k++;
                }
            }
            $mss = $u . ' Events Updated!';
            if ($p > 0) {
                $mss .= ' and ' . $p . ' Not Updated Details are bellow<br>';
                foreach($e as $ee){
                    $mss.='slug: '.$ee['slug'].' - Event Verticals id: '.$ee['event_vertical_id'].' Event type: '.$e[$p]['event_type'];
                }
                
            }
            return back()->with('success', $mss);
        }
    }
    public function vendor_categories(){
        $data['page_title']='Vendor Categories';
        $data['vendor_categories']=Vendor_categories::all();
        return view('admin.vendor_categories')->with(compact('data'));
    }
    public function add_vendor_category(){
        $data['page_title']='Add New Vendor Category';
        return view('admin.add_vendor_category')->with(compact('data'));
    }
    public function add_vendor_category_submit(Request $request){
        $this->validate($request, [
            'vendor_category_name'=>'required',
            'slug'=>'required'
        ]);
        $Input=$request->input();
        $sdata['vendor_category_name']=$Input['vendor_category_name'];
        $sdata['slug']=$Input['slug'];
        $sdata['vendor_category_descriptions']=$Input['vendor_category_descriptions'];
        $sdata['created_at']=date('Y-m-d H:i:s');
        $sdata['updated_at']=date('Y-m-d H:i:s');
        $book_id=Vendor_categories::insertGetId( $sdata );
        if($book_id){
            return back()->with('success','Vendor Category added successful');
        } else{
            return back()->with('error','Please try again later!');
        }
    }
    public function edit_vendor_category($id=''){
        $data['page_title']='Edit Vendor Category';
        $data['vendor_category'] = Vendor_categories::where('id', $id)->first();
        return view('admin.edit_vendor_category')->with(compact('data'));
    }
    public function edit_vendor_category_submit(Request $request){
        $this->validate($request, [
            'vendor_category_name'=>'required',
            'slug'=>'required'
        ]);
        $Input=$request->input();
        $sdata['vendor_category_name']=$Input['vendor_category_name'];
        $sdata['slug']=$Input['slug'];
        $sdata['vendor_category_descriptions']=$Input['vendor_category_descriptions'];
        $sdata['updated_at']=date('Y-m-d H:i:s');
        $result=Vendor_categories::where('id',$request->input('id'))->update($sdata);
        if($result){
            return back()->with('success','Vendor Category updated successful');
        } else{
            return back()->with('error','Please try again later!');
        }
    }
    public function import_vendor_category(){
        $data['page_title']='Import Vendor Category from CSV';
        return view('admin.import_vendor_category')->with(compact('data'));
    }
    public function import_vendor_category_submit(Request $request){
        $data['page_title']='Import Vendor Category from CSV';
        //print_r($request->input()); exit;
        if(!empty($request->file('import_csv'))){
//echo 'hello'; exit();
            $csv_file = $request->file('import_csv');
            //print_r($csv_file); exit;
            $input['csvFile'] = time().'.'.$csv_file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/csv');
            $csv_save_path=$csv_file->move($destinationPath, $input['csvFile']);
            $csvArrs = Helper::csvToArray($csv_save_path);
            if(!empty($csvArrs)){
                $k=0;
                $p=0;
                $u=0;
                foreach ($csvArrs as $row) {
                    //print_r($row); exit;
                    if($k>0 && ($row[0]!='')){
                         $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $row[0])));
                         $check_present=Helper::check_present('vendor_categories','slug',$slug);
                         if($check_present==false){
                            $sdata['vendor_category_name']=$row[0];
                            $sdata['vendor_category_descriptions']=$row[1];
                            //$sdata['is_active']=1;
                            $sdata['created_at']=date('Y-m-d H:i:s');
                            $sdata['updated_at']=date('Y-m-d H:i:s');
                            $sdata['slug']=$slug;
                            //$sdata['cat_type']=$row[1];
                            $id=Vendor_categories::insertGetId(
                                $sdata
                            );
                            if($id){
                                $u++;
                            }
                            # data save to category table
                         } else{
                            $p++;
                         }
                    }
                    $k++;
                }
            }
            $mss=$u.' Vendor Categories uploaded!';
            if($p>0){
                $mss.= ' and '.$p.' Vendor Categories already pesent in database!';
            }
            return back()->with('success',$mss);
            //$image_names=explode('/', $product_image);
        }
    }




    public function cities(){
        $data['page_title']='Cities';
        $data['cities']=Cities::all();
        return view('admin.cities')->with(compact('data'));
    }
    public function add_city(){
        $data['page_title']='Add New City';
        return view('admin.add_city')->with(compact('data'));
    }
    public function add_city_submit(Request $request){
        $this->validate($request, [
            'city_name'=>'required',
            'slug'=>'required'
        ]);
        $Input=$request->input();
        $sdata['city_name']=$Input['city_name'];
        $sdata['slug']=$Input['slug'];
        $sdata['city_descriptions']=$Input['city_descriptions'];
        $sdata['created_at']=date('Y-m-d H:i:s');
        $sdata['updated_at']=date('Y-m-d H:i:s');
        $book_id=Cities::insertGetId( $sdata );
        if($book_id){
            return back()->with('success','City added successful');
        } else{
            return back()->with('error','Please try again later!');
        }
    }
    public function edit_city($id=''){
        $data['page_title']='Edit City';
        $data['city'] = Cities::where('id', $id)->first();
        return view('admin.edit_city')->with(compact('data'));
    }
    public function edit_city_submit(Request $request){
        $this->validate($request, [
            'city_name'=>'required',
            'slug'=>'required'
        ]);
        $Input=$request->input();
        $sdata['city_name']=$Input['city_name'];
        $sdata['slug']=$Input['slug'];
        $sdata['city_descriptions']=$Input['city_descriptions'];
        $sdata['updated_at']=date('Y-m-d H:i:s');
        $result=Cities::where('id',$request->input('id'))->update($sdata);
        if($result){
            return back()->with('success','City updated successful');
        } else{
            return back()->with('error','Please try again later!');
        }
    }
    public function import_city(){
        $data['page_title']='Import City from CSV';
        return view('admin.import_city')->with(compact('data'));
    }
    public function import_city_submit(Request $request){
        $data['page_title']='Import city from CSV';
        //print_r($request->input()); exit;
        if(!empty($request->file('import_csv'))){
//echo 'hello'; exit();
            $csv_file = $request->file('import_csv');
            //print_r($csv_file); exit;
            $input['csvFile'] = time().'.'.$csv_file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/csv');
            $csv_save_path=$csv_file->move($destinationPath, $input['csvFile']);
            $csvArrs = Helper::csvToArray($csv_save_path);
            if(!empty($csvArrs)){
                $k=0;
                $p=0;
                $u=0;
                foreach ($csvArrs as $row) {
                    //print_r($row); exit;
                    if($k>0 && ($row[0]!='')){
                         $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $row[0])));
                         $check_present=Helper::check_present('cities','slug',$slug);
                         if($check_present==false){
                            $sdata['city_name']=$row[0];
                            $sdata['state']=$row[1];
                            //$sdata['is_active']=1;
                            $sdata['created_at']=date('Y-m-d H:i:s');
                            $sdata['updated_at']=date('Y-m-d H:i:s');
                            $sdata['slug']=$slug;
                            //$sdata['cat_type']=$row[1];
                            $id=Cities::insertGetId(
                                $sdata
                            );
                            if($id){
                                $u++;
                            }
                            # data save to category table
                         } else{
                            $p++;
                         }
                    }
                    $k++;
                }
            }
            $mss=$u.' Cities uploaded!';
            if($p>0){
                $mss.= ' and '.$p.' Cities already pesent in database!';
            }
            return back()->with('success',$mss);
            //$image_names=explode('/', $product_image);
        }
    }
    public function allbooks(){
            //DB::enableQueryLog();
        $categories = Category::pluck('category_name', 'id')->toArray();
        $authors = Author::pluck('name', 'id')->toArray();
        $books = products::latest('updated_at')->paginate(10);
            //$query = \DB::getQueryLog();
             //print_r(end($query));exit;
        return view('admin/isbn.home',compact('books'))
       ->with('i', (request()->input('page', 1) - 1) * 10)->with(compact('categories'))->with(compact('authors'));
        //return view('admin/isbn.home');
   }

   

    
}
