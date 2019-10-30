<?php

namespace App\Controller\Base;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Template("base\base.html.twig")
     */
    public function indexAction() {
        return [];
    }
}