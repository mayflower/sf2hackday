<?php
namespace LogTweets\Bundle\OrganisationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class StartController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}