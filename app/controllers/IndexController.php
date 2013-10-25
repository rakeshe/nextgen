<?php
/**
 *
 * @author     Rakesh Shrestha
 * @since      25/10/13 11:02 AM
 * @version    1.0
 */

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Phalcon\Tag::setTitle('Welcome');
        parent::initialize();
    }

    public function indexAction()
    {
        if (!$this->request->isPost()) {
            $this->flash->notice('This is a hotelclub application.
                Currently under construction.
                Please don\'t provide us any personal information. Thanks');
        }
    }
}
