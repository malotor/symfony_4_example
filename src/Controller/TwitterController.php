<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class TwitterController extends Controller
{

    public function index()
    {

        return new JsonResponse(['message' => "Hello World"]);
    }
}
