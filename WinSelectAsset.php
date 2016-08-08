<?php

/**
 * @copyright Copyright &copy; Neptunee Lee, yiioc.com, 2014 - 2015
 * @package yii2-widgets
 * @subpackage yii2-widget-winselect
 * @version 1.0.1
 */

namespace qdzsoft\winselect;

/**
 * Asset bundle for Window Select widget
 *
 * @author Neptune Lee <neptune.lee@outlook.com>
 * @since 1.0
 */
class WinSelectAsset extends \yii\web\AssetBundle
{

    public function init()
    {
        $this->sourcePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets';
        $this->js = ['js/winselect.js'];
        parent::init();
    }
}
