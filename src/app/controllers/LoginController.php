<?php



use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Http\Request;
use Phalcon\Session\Manager;
use Phalcon\Session\Adapter\Stream;






class LoginController extends Controller
{

    public function indexAction()
    {
        return '<h1>Hello!!!</h1>';
    }

    public function loginuserAction()
    {
        $date = $this->date;

        $session = $this->session;
        $session->start();

        if ($this->coockies->has('login')) {



            $this->dispatcher->forward(
                [
                    'controller' => 'login',
                    'action'     => 'logout',

                ]
            );
        }




        // die();

        // die();
        $data = $this->request->getPost();

        $email = $data['email'] ?? '';
        $password = $data['pswrd'] ?? '';
        $checkbox = $data['checkbox'] ?? '';

     

        if ($email != '' && $password != '' && $checkbox != '') {
            if ($password != 'har123') {

                $response = new Response();
    
                // Set status code
                $response->setStatusCode(404, 'Not Found');
    
                // Set the content of the response
                $response->setContent("Sorry, the page doesn't exist");
    
                // Send response to the client
                $response->send();
    
                $this->view->message="invalid password";
                die();
            }
            

            $cookie = $this->coockies;

            // echo $cookie->signKey;
            $cookie->set(
                "login",
                "abc",
                time() + 15 * 86400
            );
            $cookie->send();
            $this->dispatcher->forward(
                [
                    'controller' => 'login',
                    'action'     => 'logout',

                ]
            );


            // echo "cockset";


            // die();

            // die();
        } else if ($email != '' && $password != '') {

            // print_r($data);
            // die();
            if ($password != 'har123') {

                $response = new Response();
    
                // Set status code
                $response->setStatusCode(404, 'Not Found');
    
                // Set the content of the response
                $response->setContent("Sorry, the page doesn't exist");
    
                // Send response to the client
                $response->send();
    
                $this->view->message="invalid password";
                die();
            }

           

            $this->dispatcher->forward(
                [
                    'controller' => 'login',
                    'action'     => 'logout',

                ]
            );
            // $response= new Response();
            // $response->redirect('logout');
        }
    }

    public function logoutAction()
    {

        $session = $this->session;
        $session->start();
        // $session->start();




        $logdata = $this->request->getPost();
        if (isset($logdata['logout'])) {

            // $this->cookies->set('login', 'abc', time()-5346344);
            $coki = $this->cookies->get('login');
            $coki->delete('login');;
            $this->dispatcher->forward(
                [
                    'controller' => 'login',
                    'action'     => 'loginuser'
                ]
            );
        }

        $date = $this->date;
        $this->view->date = $date;
    }
}
