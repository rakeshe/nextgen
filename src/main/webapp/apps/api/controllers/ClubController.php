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


class ClubController extends ControllerBase
{

    protected $enableOffer = true; // true | false
    protected $viewVars;
    protected $tier;
    protected $offerGroup;

    public function initialize()
    {
        parent::initialize();
    }


    public function offersAction(){
        //enable view
/*        $data = json_decode($this->apiModel->getCacheData(), true);
        $offerGroup = null !==  $this->apiModel->offerGroup ? str_replace('-',' ',  $this->apiModel->offerGroup)  : null;
        $tier = $this->apiModel->tier;
        if(null === $tier){
            $tier = 'Silver';
            $enableOfferUri = false;
        }
        $viewData = !empty($data[$offerGroup][$tier]) ?
            $data[$offerGroup][$tier]
            : null;*/
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
        $this->tier = $this->apiModel->tier;

        if(null === $this->tier){
            $this->tier = 'Silver';
            $this->enableOffer = false;
        }
        $this->viewVars =
        [
            'protocol'       => stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://',
            'serverName'     => $_SERVER['SERVER_NAME'],
            'appVersion'     => APPLICATION_VERSION,
            'theme'          => 'api-club/',
            'data'           => $data,
            'tier'          => $this->tier,
            'locale'         => $this->apiModel->getLocale(),
            'enableOffer' => $this->enableOffer

        ];

        return $this;

    }
}