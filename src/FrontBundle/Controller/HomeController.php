<?php

namespace TastPHP\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use TastPHP\Common\Controller;
use TastPHP\Framework\Http\Response;
use TastPHP\Framework\Http\Request;
class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
//        $request = $this->get('Request');
//        $data = $request->query->all();

//        dump($request->query->all());
//        $users = $this->getUserService()->getAllUser();
//        dump($users);
        return json_encode(["name"=>"tastphp"]);
    }

    private function getUserService()
    {
        return $this->registerService('User.UserService');
    }
}