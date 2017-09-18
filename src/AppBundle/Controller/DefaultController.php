<?php

namespace AppBundle\Controller;

use AppBundle\Service\MiddlwareInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @var MiddlwareInterface
     */
    private $middlware;

    /**
     * DefaultController constructor.
     */
    public function __construct(MiddlwareInterface $middlware)
    {
        $this->middlware = $middlware;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/test-set-di", name="test_set_di")
     */
    public function setDi()
    {
        $string = $this->middlware->getStringResponse();

        return new Response($string);
    }
}
