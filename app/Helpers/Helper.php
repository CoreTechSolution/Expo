<?php

namespace App\Helpers;

use DB;
use Auth;
use Session;
use \Datetime;
use Carbon\Carbon;
use App\Models\Event_meta as Event_meta;

class Helper
{
    public static function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                $data[] = $row;
            }
            fclose($handle);
        }
        return $data;
    }

    Public static function writeToCsv($filename = '', $delimiter = ',',$data=array()){
        if (!file_exists($filename) || !is_readable($filename))
            return false;
        $file = fopen($filename, "w");
        fputcsv($file, $data);
        fclose($file);
    }



    public static function check_present($table, $field, $value)
    {
        $result = DB::table($table)->select('id')->where($field, $value)->first();

        if (empty($result->id)) {
            return false;
        } else {
            return true;
        }
    }

    public static function get_user_data($user_id, $field)
    {

        $result = DB::table('users')->select($field)->where([
            ['id', '=', $user_id]
        ])->first();
        if (!empty($result->$field)) {
            return trim($result->$field);
        } else {
            return false;
        }
    }

    public static function get_user_meta($user_id, $meta_key, $single = false)
    {
        if ($single == true) {
            $result = DB::table('user_meta')->select('meta_value')->where([
                ['user_id', '=', $user_id],
                ['meta_key', '=', $meta_key],
            ])->first();
            if (!empty($result->meta_value)) {
                return trim($result->meta_value);
            } else {
                return false;
            }
        } else {
            $result = DB::table('user_meta')->select('meta_value')->where([
                ['user_id', '=', $user_id],
            ])->get();
            if (!empty($result)) {
                return $result;
            } else {
                return false;
            }
        }
    }

    public static function update_user_meta($user_id, $meta_key, $value)
    {

        $result = DB::table('user_meta')->select('meta_value')->where([
            ['user_id', '=', $user_id],
            ['meta_key', '=', $meta_key],
        ])->first();
        //print_r($result); exit;
        if (!empty($result->meta_value)) {
            // update meta key value
            $upd_result = DB::table('user_meta')
                ->where([
                    ['user_id', '=', $user_id],
                    ['meta_key', '=', $meta_key],
                ])
                ->update(['meta_value' => $value]);
            if ($upd_result) {
                return true;
            } else {
                return false;
            }
        } else {
            // create new meta key
            $hdata['user_id'] = $user_id;
            $hdata['meta_key'] = $meta_key;
            $hdata['meta_value'] = $value;
            $ins_result = DB::table('user_meta')->insertGetId($hdata);

            if ($ins_result) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function get_user_by($field = 'id', $value)
    {
        $result = DB::table('users')->where([
            [$field, '=', $value]
        ])->first();
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
    public static function get_event_by($field = 'id', $value)
    {
        $result = DB::table('events')->where([
            [$field, '=', $value]
        ])->first();
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
    public static function get_event_id($field, $single=false)
    {
        $result = DB::table('events')->where($field)->first();
        if (!empty($result)) {
            return $result->id;
        } else {
            return false;
        }
    }
    public static function get_event_user($event_id,$user_type){
        $rtn_data=array();
        $result1=DB::table('event_user')->distinct()->select('user_id')->where([
            ['event_id','=',$event_id],['user_type','=',$user_type]
        ])->get();
        //print_r($result1); exit;
        if(!empty($result1)){
            for($i=0;$i<count($result1);$i++){
                $rtn_data[$i]=Helper::get_user_by('id',$result1[$i]->user_id);
            }
        }
        return $rtn_data;
    }
    public static function get_event_by_user($user_id,$user_type){
        $rtn_data=array();
         DB::enableQueryLog();

        $result1=DB::table('event_user')->distinct()->select('event_id')->where([
            ['user_id','=',$user_id],['user_type','=',$user_type]
        ])->get();
        $laQuery = DB::getQueryLog();
        /* if($user_type=='exhibitor'){
            print_r($laQuery[0]);
            print_r($result1);
            echo $user_type;
            exit;
        } */
        
        //print_r($result1); exit;
        if(!empty($result1)){
            for($i=0;$i<count($result1);$i++){
                //print_r($result1); exit;
                $rtn_data[$i]=Helper::get_event_by('id',$result1[$i]->event_id);
            }
        }
        return $rtn_data;
    }
    public static function default_image_check($path,$extention_path=''){
        if(empty($path)){
            return url('uploads/no_images.png');
        } else{
            $str = rtrim($extention_path, '/');
            if(empty($extention_path)){
                return url($path);
            } else{
                return url($extention_path.'/'.$path);
            }
            
        }
    }
    public static function date_formate_change($date, $formate = 'd M Y')
    {
        return Carbon::parse($date)->format($formate);
    }
    public static function get_returnvaluefield($table, $check_field, $check_value, $return_field)
    {
        //echo $return_field; exit;
        $rtn = '';
        $rtn = DB::table($table)->select($return_field)->where($check_field, $check_value)->first();
        $field = $return_field;
        //print_r($rtn->$field); exit;
        if (!empty($rtn->$field)) {
            return $rtn->$field;
        } else {
            return $rtn;
        }
    }

    public static function check_added_event($events)
    {
        $result = DB::table('user_event')->select('id')->where([
            ['user_id', '=', $events['user_id']],
            ['event_id', '=', $events['event_id']]
        ])->first();

        if (empty($result->id)) {
            return false;
        } else {
            return true;
        }
    }

    public static function get_vendor_testimonials($vendor_id){
        //echo $vendor_id; exit;
        $result = DB::table('vendor_testimonials')->select('*')->where('vendor_id',$vendor_id)->get();
        return $result;
    }

    public static function get_gallery_image($type, $id,$mime_type='image')
    {
        //echo $id; exit;
        DB::enableQueryLog();
        $field = '';
        if ($type == 'event') {
            $field = 'event_id';
        }
        if ($field != '') {
            $result = DB::table('attachments')->where([
                [$field, '=', $id],['image_type','=',$mime_type]
            ])->get();
            $laQuery = DB::getQueryLog();
            //print_r($laQuery[0]);
            //echo $result->count(); exit;
            if (!empty($result)) {
                return $result;
            } else {
                return false;
            }
        }
    }
    public static function returnDataSet($table, $where = '', $orderby = '', $order = 'asc')
    {
        $whereCond = $where == '' ? '' : ' WHERE ' . $where;
        $order_by = $orderby == '' ? '' : ' ORDER BY ' . $orderby . ' ASC';
        $data = DB::select("SELECT * FROM " . $table . " " . $whereCond . $order_by);
        //print_r($data); exit;
        return $data;
    }
    public static function returnDropDownQuery($table, $where = '', $key, $value, $orderby = '', $order = 'asc')
    {
        $whereCond = $where == '' ? '' : ' WHERE ' . $where;
        $order_by = $orderby == '' ? '' : ' ORDER BY ' . $orderby . ' ASC';
        $query = "SELECT * FROM " . $table . " " . $whereCond . $order_by;
        $data = DB::select($query);
        $result = array();
        if ($data) {
            foreach ($data as $items) {
                $result[$items->$key] = $items->$value;
            }
        }

        //print_r($result);exit;
        return $result;
    }
    public static function get_event_meta($event_id, $meta_key, $single = false)
    {
        if ($single == true) {
            $result = DB::table('event_meta')->select('meta_value')->where([
                ['event_id', '=', $event_id],
                ['meta_key', '=', $meta_key],
            ])->first();
            if (!empty($result->meta_value)) {
                return trim($result->meta_value);
            } else {
                return false;
            }
        } else {
            $result = DB::table('event_meta')->select('meta_key','meta_value')->where([
                ['event_id', '=', $event_id],
            ])->get();
            if (!empty($result)) {
                return $result;
            } else {
                return false;
            }
        }
    }
    public static function update_event_meta($event_id, $meta_key, $value)
    {

        $result = DB::table('event_meta')->select('meta_value')->where([
            ['event_id', '=', $event_id],
            ['meta_key', '=', $meta_key],
        ])->first();
        //print_r($result); exit;
        if (!empty($result->meta_value)) {
            // update meta key value
            $upd_result = DB::table('event_meta')
                ->where([
                    ['event_id', '=', $event_id],
                    ['meta_key', '=', $meta_key],
                ])
                ->update(['meta_value' => $value]);
            if ($upd_result) {
                return true;
            } else {
                return false;
            }
        } else {
            // create new meta key
            $hdata['event_id'] = $event_id;
            $hdata['meta_key'] = $meta_key;
            $hdata['meta_value'] = $value;
            $ins_result = DB::table('event_meta')->insertGetId($hdata);

            if ($ins_result) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function event_user_add($event_id, $user_type, $user_id = '', $user_name = '', $user_email='')
    {

        $edata['event_id'] = $event_id;
        $edata['user_id'] = $user_id;
        $edata['user_type'] = $user_type;
        $edata['user_name'] = $user_name;
        $edata['user_email'] = $user_email;
        $edata['created_at'] = date('Y-m-d H:i:s');
        $edata['updated_at'] = date('Y-m-d H:i:s');
        $result = DB::table('event_user')->insertGetId($edata);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
