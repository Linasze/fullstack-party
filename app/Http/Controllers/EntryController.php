<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntryController extends Controller
{

    protected $client_id;
    protected $secret;

    
    public function __construct(){
        $this->callback = "callback";
        $this->repo = env('GITHUB_REPO', '');
        $this->client_id = env('CLIENT_ID', '');
        $this->secret = env('SECRET', '');

    }
  

    public function index(){
        if($_SERVER['REQUEST_METHOD']== 'GET'){
            $issue_number = $_GET['issue'];
             
            $options = ['http' => [
                'method' => 'GET',
                'header' => ['User-Agent: PHP']
            ]
            ];
            $context = stream_context_create($options);

            $url1 = "https://api.github.com/repos/$this->repo/issues/$issue_number?client_id=$this->client_id&client_secret=$this->secret";
            $issue = file_get_contents($url1, false, $context);
            $issue = json_decode($issue, true);
           
            $url2 = "https://api.github.com/repos/$this->repo/issues/$issue_number/comments?client_id=$this->client_id&client_secret=$this->secret";
            $comments = file_get_contents($url2, false, $context);
            $comments = json_decode($comments, true);
            
            return view('entry')->with([
                'issue' => $issue,
                'comments' => $comments    
            ]);

        }else{
            die('error');
        }
    }
}
