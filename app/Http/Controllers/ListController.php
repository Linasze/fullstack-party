<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends Controller
{

    protected $client_id;
    protected $secret;


    public function __construct(){
        $this->callback = "callback";
        $this->repo = env('GITHUB_REPO', '');
        $this->client_id = env('CLIENT_ID', '');
        $this->secret = env('SECRET', '');
        $this->per_page = 15;
    }


    public function index(){
  
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
           if(isset($_GET['page'])){
            $page = $_GET['page'];
           }else{
               $page = 1;
           }
           
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, "https://api.github.com/repos/$this->repo/issues?client_id=$this->client_id&client_secret=$this->secret&per_page=$this->per_page&page=$page");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_USERAGENT, true);
            $data = curl_exec($curl);
            $issues = json_decode($data, true);
            
            curl_setopt($curl, CURLOPT_URL, "https://api.github.com/search/issues?q=repo:$this->repo+is:issue+is:open");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_USERAGENT, true);
            $count = curl_exec($curl);
            $open_count = json_decode($count, true);

            curl_setopt($curl, CURLOPT_URL, "https://api.github.com/search/issues?q=repo:$this->repo+is:issue+is:closed");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_USERAGENT, true);
            $close = curl_exec($curl);
            $close_count = json_decode($close, true);
            
            $total_open = $open_count['total_count']; 
            $total_close = $close_count['total_count']; 

            curl_close($curl);
        }

            return view('list')->with([
                'issues' => $issues,
                'per_page' => $this->per_page,
                'total_open' => $total_open,
                'total_close' => $total_close]);
    }



   
       
}
