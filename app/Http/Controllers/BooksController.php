<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    //index
    public function index(){
        return view("index");
    }

    public function show(){
        //隨機3個不重複數字
        if(!session()->has('nums')){ 
            if(!session()->has('array_called')){
                $array = arr();
                session(['array_called' => true]);
            }else{           
                $nums = array();
                while(count($nums)<3){
                    $num = rand(0,9);
                    if(!in_array($nums, $num)){
                        $nums[] = $num;
                    }
                }
                session(['nums'=>$nums]);
            }            
        }else{
            $nums = session('nums', []);
            //假設這 3 位數用 ABC 排列，如果abs(B-A)=abs(C-B)就停止
            $abs = abs($nums[1]-$nums[0]);
            $abs2 = abs($nums[2]-$nums[1]);
            $n=0;
            while($n<10){
                $result = $n."=".$nums;
                session(['result'=>$result]);
                if($abs==$abs2){
                    return view('index',"總共試了10次或以找到數字了喔!");
                    break;
                }
                return view('index',['result' => session('result', [])]);
            }            
            return view('index',"總共試了10次或以找到數字了喔!");
        }
    }
    
    public function arr(){
        //第一組要顯示array=([0]=>6[1]=>1[2]=>3)
        $array = array();
        $i=0;
        $array = "Array([";
        while($i<3){
           $array .=  "[".$i."] => ".$nums[$i];
           $i++;
        }
        $array .= ")";
        return view('index',$array);        
    }
}
