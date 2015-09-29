<?php
/**
 *
 * @package    MailChimpMember.php
 * @author     Rakesh Shrestha
 * @since      29/9/15 12:33 PM
 * @version    1.0
 */
namespace HC\HCFA\Models;

class MailChimpMember
{
    const DEFAULT_ERROR_MESSAGE = 'Error. Agent ID and email address do not match. Please try again.';
    const RESPONSE_MESSAGE_EMAIL_NOT_IN_LIST = 'The email address passed does not exist on this list';
    const ERROR_MESSAGE_EMAIL_NOT_IN_LIST = 'That email address does not exist on our file, please use the email address where you received this registration invite.';

    protected $success;
    protected $errors;
    protected $error;
    protected $email;
    protected $id;
    protected $euid;
    protected $email_type;
    protected $ip_signup;
    protected $timestamp_signup;
    protected $ip_opt;
    protected $timestamp_opt;
    protected $member_rating;
    protected $info_changed;
    protected $web_id;
    protected $leid;
    protected $language;
    protected $list_id;
    protected $list_name;
    protected $merges;
    protected $status;
    protected $timestamp;
    protected $is_gmonkey;
    protected $lists;
    protected $geo;
    protected $clients;
    protected $static_segments;
    protected $notes;

    public function init(array $data)
    {
        if (!empty($data['success'])) {
            $this->setSuccess($data['success']);
        }
        if (!empty($data['errors'])) {
            $this->setErrors($data['errors']);
        }
        if (!empty($data['data'][0])) {

            foreach ($data['data'][0] as $key => $value) {

                $objName      = $this->camelize($key);
                $functionName = 'set' . $objName;
                if (method_exists($this, $functionName)) {
                    $this->$functionName($value);
                }

            }
        }

    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getEuid()
    {
        return $this->euid;
    }

    public function setEuid($euid)
    {
        $this->euid = $euid;
        return $this;
    }

    public function getEmailType()
    {
        return $this->email_type;
    }

    public function setEmailType($email_type)
    {
        $this->email_type = $email_type;
        return $this;
    }

    public function getIpSignup()
    {
        return $this->ip_signup;
    }

    public function setIpSignup($ip_signup)
    {
        $this->ip_signup = $ip_signup;
        return $this;
    }

    public function getTimestampSignup()
    {
        return $this->timestamp_signup;
    }

    public function setTimestampSignup($timestamp_signup)
    {
        $this->timestamp_signup = $timestamp_signup;
        return $this;
    }

    public function getIpOpt()
    {
        return $this->ip_opt;
    }

    public function setIpOpt($ip_opt)
    {
        $this->ip_opt = $ip_opt;
        return $this;
    }

    public function getTimestampOpt()
    {
        return $this->timestamp_opt;
    }

    public function setTimestampOpt($timestamp_opt)
    {
        $this->timestamp_opt = $timestamp_opt;
        return $this;
    }

    public function getMemberRating()
    {
        return $this->member_rating;
    }

    public function setMemberRating($member_rating)
    {
        $this->member_rating = $member_rating;
        return $this;
    }

    public function getInfoChanged()
    {
        return $this->info_changed;
    }

    public function setInfoChanged($info_changed)
    {
        $this->info_changed = $info_changed;
        return $this;
    }

    public function getWebId()
    {
        return $this->web_id;
    }

    public function setWebId($web_id)
    {
        $this->web_id = $web_id;
        return $this;
    }

    public function getLeid()
    {
        return $this->leid;
    }

    public function setLeid($leid)
    {
        $this->leid = $leid;
        return $this;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    public function getListId()
    {
        return $this->list_id;
    }

    public function setListId($list_id)
    {
        $this->list_id = $list_id;
        return $this;
    }

    public function getListName()
    {
        return $this->list_name;
    }

    public function setListName($list_name)
    {
        $this->list_name = $list_name;
        return $this;
    }

    public function getMerges()
    {
        return $this->merges;
    }

    public function setMerges($merges)
    {
        $this->merges = $merges;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    public function getIsGmonkey()
    {
        return $this->is_gmonkey;
    }

    public function setIsGmonkey($is_gmonkey)
    {
        $this->is_gmonkey = $is_gmonkey;
        return $this;
    }

    public function getLists()
    {
        return $this->lists;
    }

    public function setLists($lists)
    {
        $this->lists = $lists;
        return $this;
    }

    public function getGeo()
    {
        return $this->geo;
    }

    public function setGeo($geo)
    {
        $this->geo = $geo;
        return $this;
    }

    public function getClients()
    {
        return $this->clients;
    }

    public function setClients($clients)
    {
        $this->clients = $clients;
        return $this;
    }

    public function getStaticSegments()
    {
        return $this->static_segments;
    }

    public function setStaticSegments($static_segments)
    {
        $this->static_segments = $static_segments;
        return $this;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param mixed $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return mixed
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param mixed $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }


    public function getParsedErrorMessage()
    {
        return $this->getError(
        ) === self::RESPONSE_MESSAGE_EMAIL_NOT_IN_LIST ? self::ERROR_MESSAGE_EMAIL_NOT_IN_LIST : self::DEFAULT_ERROR_MESSAGE;
    }

    public function isUpdateAllowed($email, $id, $uidName)
    {

        $customInfo = $this->getMerges();
        $uid        = empty($customInfo[$uidName]) ? null : $customInfo[$uidName];

        if ($this->getSuccess() && $this->getErrors() == 0) {

            // New rego is when only email is known and Agent Id is not known
            if ($this->getEmail() == $email && null == $customInfo) {
                return true;
            }
            // Update is when both agent id and email is known
            if ($this->getEmail() == $email && null !== $uid && $uid == $id) {
                return true;
            }
        }
    }


    public function decamelize($word)
    {
        return preg_replace(
            '/(^|[a-z])([A-Z])/e',
            'strtolower(strlen("\\1") ? "\\1_\\2" : "\\2")',
            $word
        );
    }

    public function camelize($word)
    {
        return preg_replace('/(^|_)([a-z])/e', 'strtoupper("\\2")', $word);
    }
}