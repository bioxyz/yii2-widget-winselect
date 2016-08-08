<?php

/**
 * @copyright Copyright &copy; Neptune Lee, yiioc.com, 2014 - 2016
 * @package yii2-widgets
 * @subpackage yii2-widget-winselect
 * @version 1.0.1
 */

namespace qdzsoft\winselect;

use yii\helpers\ArrayHelper;
use qdzsoft\winselect\WinSelectAsset;

/**
 * Browser Window Select is a widget for select what it belongs 
 * 
 * @see http://www.yiioc.com/yii2-widget-winselect
 * @see http://github.com/qdzsoft/yii2-widget-winselect
 * @author Neptunee Lee <neptune.lee@outlook.com>
 * @since 1.0.1
 */
class WinSelectGridView extends \yii\grid\GridView
{
    public function init()
    {
        $this->registerAssets();
        parent::init();
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $assetDir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets';
        $view = $this->getView();
        
        // register bundle for base url
        $bundle = WinSelectPopupAsset::register($view);

        $view->registerJsFile(implode('/', [$bundle->baseUrl, 'js', 'winselect_init_popup_data.js']), 
                                ['position' => \yii\web\View::POS_READY]);
        $view->registerJsFile(implode('/', [$bundle->baseUrl, 'js', 'winselect_popup.js']), 
                ['position' => \yii\web\View::POS_HEAD]);
        
        // init model data
        $models = $this->dataProvider->getModels();
        $r = [];
        foreach ($models as $m){
            $r[$m->id] = \yii\helpers\ArrayHelper::toArray($m);
        }
        $js = sprintf("var associated_javascript_data = %s;", \yii\helpers\Json::encode($r));
        $view->registerJs($js, \yii\web\View::POS_BEGIN);
    }
}