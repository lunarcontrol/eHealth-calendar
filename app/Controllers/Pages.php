<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Pages extends Controller
{
    public function index()
    {
	    
	$session = session();
       	$data['user_name'] = $session->get('user_name');
	    
    	$data['title'] = "Home";
    	$data['hideTitle'] = "true";
    	echo view('templates/header', $data);
        echo view('pages/index', $data);
        echo view('templates/footer', $data);
    }

    public function view($page = 'home')
	{
	    if ( ! is_file(APPPATH.'/Views/pages/'.$page.'.php'))
	    {
	        // Whoops, we don't have a page for that!
	        throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
	    }

	    $data['title'] = ucfirst($page); // Capitalize the first letter

	    echo view('templates/header', $data);
	    echo view('pages/'.$page, $data);
	    echo view('templates/footer', $data);
	}
}
