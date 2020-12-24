<?php
class Pages extends Controller {
    public function __construct(){ 

    }

    public function index(){


        $data = [
            'title' => "SharePosts",
            'description' => 'Simple social network built on the PHP MVC framework'      
        ];


        $this->view('pages/index',$data);

        if(isLoggedIn()){
            redirect('posts');
        }
    }

    public function about(){
        $data = [
            'title' => "About us",
            'description' => 'App to share posts with other users'      

        ];

        $this->view('pages/about', $data);
    }
}