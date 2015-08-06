<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Calculator:index.html.twig', array(
        ));
    }

    /**
     * @Route("/calc/{number1}/{op}/{number2}", name="calc")
     *
     * @param string    $number1
     * @param string    $op
     * @param string    $number2
     *
     * @return string
     */
    public function calculateAction($number1, $op, $number2)
    {
        $res = '';

        switch ($op)
        {
            case '+':
                $res = bcadd($number1, $number2);
            break;
            case '-':
                $res = bcsub($number1, $number2);
            break;
            case 'x':
                $res = bcmul($number1, $number2);
            break;
            case 'd':
                $res = bcdiv($number1, $number2);
            break;
            default:
                $res = '';
        }

        return new Response($res);
    }
}
