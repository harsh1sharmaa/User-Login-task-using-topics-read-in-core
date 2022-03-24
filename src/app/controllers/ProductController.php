<?php



use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Http\Request;
use Phalcon\Session\Manager;
use Phalcon\Session\Adapter\Stream;






class ProductController extends Controller
{

    public function indexAction()
    {
        return '<h1>Hello!!!</h1>';
    }


    public function addproductAction()
    {

        // $DB = $this->db;
        // print_r($DB);
        $productdat = $this->request->getPost();

        $name = $productdat['name'];
        $price = $productdat['price'];
        // echo $name;
        // echo $price;
        // print_r($productdat);
        // die();

        $product = new Products();
        $product->name = $name;
        $product->price = $price;
        $product->save();
        $response = new Response();
        $this->response->redirect('/login/loginuser');

        // echo 'add ';
        // die();
    }

    public function displayAction()
    {

        $product = Products::find();


        echo count($product);
        $this->view->data = $product;
        // die();


    }
}
