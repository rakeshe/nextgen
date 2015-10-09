<?php
/**
 *
 * @package    modelFactory.php
 * @author     Rakesh Shrestha
 * @since      18/5/15 4:50 PM
 * @version    1.0
 */
namespace HC\Api\Models;

class ModelFactory
{

    public static function build($model)
    {
        $apiModel = null;
        $apiModelName = __NAMESPACE__ . '\\' . ucfirst($model) . 'Model';
        if (class_exists($apiModelName)) {
            $apiModel = new $apiModelName();
            $apiModel->setControllerName($model);

        } else {
            $apiModel = new ApiModel();
        }
        return $apiModel;

    }
}