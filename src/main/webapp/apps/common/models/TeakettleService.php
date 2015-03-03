<?php
/**
 *
 * Abstract object for Teakettle Web Group of Services. TK Registry  pwers various RESTful web services that connects to
 * various Orbitz product hosts.
 *
 * @package    TeakettleService.php
 * @author     Rakesh Shrestha
 * @since      27/2/15 1:47 PM
 * @version    1.0
 */

namespace HC\Api\Models;
use Phalcon\Http\Client\Request;
use Phalcon\Http\Response;

Abstract class TeakettleService
{

    const DEFAULT_LOCALE = 'en-AU';
    const SERVICE_URI_BASE = '//teakettle.qa1.o.com/';

    protected $provider;
    protected $token;
    protected $referrer;
    protected $salt;
    protected $headers;
    protected $params;
    protected $request;
    protected $response;

}