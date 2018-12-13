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
            $options = ['http' => [
                'method' => 'GET',
                'header' => ['User-Agent: PHP']
            ]
            ];
            $context = stream_context_create($options);

            $url1 = "https://api.github.com/repos/$this->repo/issues?client_id=$this->client_id&client_secret=$this->secret&per_page=$this->per_page&page=$page";
            $issues = file_get_contents($url1, false, $context);
            $issues = json_decode($issues, true);

            $url2 = "https://api.github.com/search/issues?q=repo:$this->repo+is:issue+is:open";
            $count = file_get_contents($url2, false, $context);
            $open_count = json_decode($count, true);

            $url3 = "https://api.github.com/search/issues?q=repo:$this->repo+is:issue+is:closed";
            $close = file_get_contents($url3, false, $context);
            $close_count = json_decode($close, true);
            
            $total_open = $open_count['total_count']; 
            $total_close = $close_count['total_count']; 
        }

            return view('list')->with([
                'issues' => $issues,
                'per_page' => $this->per_page,
                'total_open' => $total_open,
                'total_close' => $total_close]);
    }



   
       
}
