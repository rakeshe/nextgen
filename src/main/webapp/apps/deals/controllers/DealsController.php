<?php

/**
 *
 * @package    DealsController.php
 * @author     K.N. Santosh Hegde
 * @since      14/05/2015
 * @version    1.0
 */

namespace HC\Deals\Controllers;

use HC\Deals\Models\DealsModel;
use Phalcon\Http\Client\Request;
use Phalcon\Http\Response;

class DealsController extends ControllerBase {


    const DEFAULT_CITY = 'Sydney';

    const DEFAULT_WHEN = '30-days';

    const DEFAULT_URL = 'n/sale/deals';

    private $cityData;

    /** @var  \HC\Deals\Models\DealsModel  */
    private $model;

    private $city;

    private $when;

    private $sort;

    private $appendURL;

    private $userId;

    private $userInfo;

    public function initialize() {

        $this->init();

        if ($this->request->isPost() && $this->request->isAjax()) {

            $hotelData = $this->model->getHotels($this->request->getPost('region', 'string'),
                $this->request->getPost('city', 'string'));

            die($hotelData);
        }

        if (NULL !== $this->userId)
            $this->setUserInfo();

    }

    public function setUserInfo() {

        $uInfo = $this->model->getLoyaltyInfo('');
        $lInfo = json_decode($this->model->getUserInfo(''), TRUE);


        if (NULL !== $uInfo) {

            foreach(json_decode($uInfo, TRUE) as $key => $val) {

                if ($key == 'lite_member') {
                    $this->userInfo['mId']   = (!isset($val['member_id'])) ? '' : $val['member_id'];
                    $this->userInfo['name']  = (!isset($val['name'])) ? '' : $val['name'];
                    $this->userInfo['email'] = (!isset($val['email_address'])) ? '' : $val['email_address'];
                }
            }
        }

        if (NULL !== $lInfo) {

            $this->userInfo['mid'] = $lInfo['loyalty_member_number'];
            $this->userInfo['tierType'] = $lInfo['tier_type'];
            $this->userInfo['availAmount'] = $lInfo['available_amount'];
            $this->userInfo['availAmountInUsrCurr'] = $lInfo['available_amount_in_member_currency'];
        }
    }


    public function init() {

        $this->model = new \HC\Deals\Models\DealsModel();

        $this->setParams();
    }

    private function setParams() {

       // var_dump($this->dispatcher->getParams());
        //var_dump($this->request->get()); exit;

        //if exists and should be validated
        if (isset($this->dispatcher->getParams()[0]))
            $this->city = $this->dispatcher->getParams()[0];
        else {
            $this->city = self::DEFAULT_CITY;
            $this->appendURL .= self::DEFAULT_CITY;
        }


        //if exists and should be validated

        if (isset($this->dispatcher->getParams()[1]))
            $this->when = $this->dispatcher->getParams()[1];
        else {
            $this->when = self::DEFAULT_WHEN;
            $this->appendURL .= (NULL !== $this->appendURL) ? '/' . self::DEFAULT_WHEN
                                    : self::DEFAULT_WHEN;
        }

        if (isset($this->request->get()['sort']))
            $this->sort = $this->request->get()['sort'];

        if ($this->cookies->get('mid')->__toString() != '') {
            $this->userId = $this->cookies->get('mid')->__toString();
        }

        //$this->userId = 123;
    }

    public function indexAction() {

        $this->cityData = $this->model->getCityDocument();

        // Add Webtrends tracking
        $webTrends = new \HC\Common\Helpers\WebtrendsHelper();

        // Get Cms Documents
        $docFooterSeo =  $this->model->getCmsDocument(DealsModel::DOC_NAME_FOOTER_SEO_LINKS, true);
        $docFooterAbout = $this->model->getCmsDocument(DealsModel::DOC_NAME_FOOTER_ABOUT, true);

        $this->view->setVars(
            [
                'appVersion'          => APPLICATION_VERSION,
                'cityData'            => $this->cityData,
                'city'                => $this->city,
                'when'                => $this->when,
                'sort'                => $this->sort,
                'appendURL'           => $this->appendURL,
                'url'                 => self::DEFAULT_URL,
                'hData'               => $this->model->getHotels('', $this->city),
                'userInfo'            => json_encode($this->userInfo),
                'wtMetaData'          => $webTrends
                    ->setOwwPage($this->router->getRewriteUri())
                    ->getWtMetaData(),
                'wtDataCollectorData' => $webTrends->getWtDataCollectorData(),
                'clubPromotion'       => $this->model->getCmsDocument(DealsModel::PROMOTIONS_CLUB_DOC_NAME),
                'pmPromotion'         => $this->model->getCmsDocument(DealsModel::PROMOTIONS_PM_DOC_NAME),
                'docFooterSeo'        => $docFooterSeo->html,
                'docFooterAbout'      => $docFooterAbout->html
            ]
        );

        $this->view->pick('default/index/index');
    }

    protected function getWtMetaData(){
        return [
            'DCSext.LNG' => null === $this->languageCode ? 'en_AU' : $this->languageCode ,
            'DCSext.pos' => 'HCL',
            'DCSext.hostname' => 'www.hotelclub.com',
            'DCSext.owwPage' =>  $this->router->getRewriteUri()
        ];

    }
}