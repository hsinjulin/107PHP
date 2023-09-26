<?php

namespace App\Http\Controllers;

use App\Models\mydetail;
use App\Models\mymaster;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    //index
    public function index(){
        return view("index");
    }

    //random numbers
    public function num(){        
        $nums = array();
        while(count($nums)<3){
            $num = rand(0,9);
            if(!in_array($num, $nums))
                $nums[] = $num;
        }

        if(session()->has('nums')){
            session(['nums'=>$nums]);
            return redirect()->route('rna');
        }else{
            session(['nums'=>$nums]);
            return redirect()->route('arr');
        }        
    }

    //show array
    public function arr(){
        if(session()->has('nums')){
            $nums = session('nums');
            $result="";
            $count= -1;
            foreach ($nums as $num){
                $count++;
                $result .= "[$count] => $num ";
            }
            $result = "Array( ". strval($result) . ")";
            session(['result'=>$result]);
            return view('index');
        }        
    }

    //show random numbers with abs
    public function rna(){
        $nums = session('nums');
        $rec = session('rec',[]);
        $strRec = "$nums[0]$nums[1]$nums[2]";
        $rec[] = $strRec;

        if(!session()->has('count')){
            $count = 0;
            $result = "";
        }else{
            $count = session('count',[]);
            $result = session('result');
        }              

        $abs=abs($nums[1]-$nums[0]);
        $abs2=abs($nums[2]-$nums[1]);        

        $result .= "$count = $nums[0],$nums[1],$nums[2]<br>";
        $count++;
        session(['count'=>$count, 'rec'=>$rec]);
        if($abs==$abs2 || $count >= 9){        
            $result .= "總共試了10次或已找到數字了喔!";
            session(['result'=>$result]);
            return redirect()->route('insert');
        }else{
            session(['result'=>$result]);
            return view('index');
        }        
    }

    //insert
    public function insert(){
        date_default_timezone_set('Asia/Taipei');
        $data = date('YmdHis');
        $rec = session('rec', []);
        mymaster::create([
            'id' => $data,
            'freq' => session('count'),
        ]);

        for($i=0;$i<count($rec);$i++){
            mydetail::create([
                'id' => $data,
                'turn' => ($i+1),
                'rec' => $rec[$i],
            ]);
        }
        return view('index');
    }

    //clear
    public function clear(){
        //清空session內所有資料
        session()->flush();
        //重新導回一開始的樣子
        return redirect()->route('start');
    }
}
