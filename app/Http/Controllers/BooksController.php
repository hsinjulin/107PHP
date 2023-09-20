<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function show(){
        //隨機3個不重複數字
        if(!session()->has('nums')){
            $nums = array();
            while(count($nums)<3){
                $num = rand(0,9);
                if(!in_array($nums, $num)){
                    $nums[] = $num+",";
                }else{
                    $nums[] = $num;
                }
            }
            session(['nums'=>$nums]);
        }else{
            $nums = session('nums', []);
        }


        return view('index');
    }
}
