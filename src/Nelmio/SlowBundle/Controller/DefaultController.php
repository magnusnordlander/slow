<?php

namespace Nelmio\SlowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     * @Cache(smaxage="300")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/noop/", name="noop")
     * @Template()
     * @Cache(smaxage="300")
     */
    public function noopAction()
    {
        return array();
    }

    /**
     * @Route("/all/", name="all")
     * @Template()
     * @Cache(smaxage="300")
     */
    public function slowAllAction()
    {
        $manager = $this->get('nelmio_slow.slow_manager');

        return array(
            'results' => array(
                'bob' => $manager->runSleepyhead(),
                'cracker' => $manager->runCracker(),
                'sleepyhead' => $manager->runBob(),
                'tree builder' => $manager->runTreeBuilder(),
                'resizer' => $manager->runResizer(),
            ),
        );
    }

    /**
     * @Route("/composed/", name="composed")
     * @Template()
     */
    public function composedAction()
    {
        return array();
    }
}
