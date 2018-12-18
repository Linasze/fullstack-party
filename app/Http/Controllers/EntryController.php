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
             
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, "https://api.github.com/repos/$this->repo/issues/$issue_number?client_id=$this->client_id&client_secret=$this->secret");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_USERAGENT, true);
            $issue = curl_exec($curl);
            $issue = json_decode($issue, true);
           

            curl_setopt($curl, CURLOPT_URL, "https://api.github.com/repos/$this->repo/issues/$issue_number/comments?client_id=$this->client_id&client_secret=$this->secret");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_USERAGENT, true);
            $comments = curl_exec($curl);
            $comments = json_decode($comments, true);
            
            curl_close($curl);

            return view('entry')->with([
                'issue' => $issue,
                'comments' => $comments    
            ]);

        }else{
            die('error');
        }
    }
}
