<?php
/**
 *
 * @package    ClubController.php
 * @author     Rakesh Shrestha
 * @since      7/10/15 10:13 AM
 * @version    1.0
 */
namespace HC\Api\Controllers;

use Phalcon\Http\Response,
    Phalcon\Validation\Message;


class MigrateController extends ControllerBase
{

    protected $enableOffer = true; // true | false
    protected $viewVars;
    protected $locale;
    protected $tier;
    protected $offerGroup;

    public function initialize()
    {
        parent::initialize();
    }


    public function pageAction(){
        $this->enableView();
        $this->view->setVars($this->getViewVars());

        $this->renderView();
    }

    /**
     * @return mixed
     */
    public function getViewVars()
    {
        if(null === $this->viewVars) $this->setViewVars();
        return $this->viewVars;
    }


    /**
     * @return array
     */
    protected function setViewVars(){
        $data = json_decode($this->apiModel->getCacheData(), true);
        $this->locale = $this->apiModel->getLocale();

        if(null === $this->locale){
            $this->locale = 'en_au';
        }
        $this->viewVars =
        [
            'protocol'       => stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://',
            'serverName'     => $_SERVER['SERVER_NAME'],
            'appVersion'     => APPLICATION_VERSION,
            'theme'          => 'api-club/',
            'data'           => $data,
//            'tier'          => $this->tier,
            'locale'         => $this->apiModel->getLocale(),
//            'enableOffer' => $this->enableOffer

        ];

        return $this;

    }
}