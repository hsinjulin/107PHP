<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function show(){
        //隨機3個不重複數字
        if(!session()->has('nums')){
            //第一組要顯示array=([0]=>6[1]=>1[2]=>3)
            if(isset($array)){
                $array = array();
                $i=0;
                $array = "Array([";
                while($i<3){
                   $array .=  "[".$i."] => ".$nums[$i];
                   $i++;
                }
                $array .= ")";
                return view('index',$array);
            }else{
                session();  
                $nums = array();
                while(count($nums)<3){
                    $num = rand(0,9);
                    if(!in_array($nums, $num)){
                        $nums[] = $num;
                    }
                }
                session(['nums'=>$nums]);
                return view('index');
            }
        }else{
            $nums = session('nums', []);
            return view('index');
        }
    }
}
