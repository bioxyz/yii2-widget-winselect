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
class WinSelectWidget extends \yii\bootstrap\InputWidget
{
    const CLOSE_WINDOW_YES = 'true';
    const CLOSE_WINDOW_NO = 'false';

    const CLEAR_BUTTON_YES = 'true';
    const CLEAR_BUTTON_NO = 'false';
    
    const WINDOW_MODE_SAME = 'true';
    const WINDOW_MODE_DIFF = 'false';
    

    /**
     * {$controller_name}/winpopup will be used as url of popup window
     * 
     * @var string Controller Name
     */
    public $controller_name;
    
    /**
     * 
     * @var int Width of Window
     */
    public $width = 600;
    
    /**
     *
     * @var int Height of Window 
     */
    public $height = 600;
    
    /**
     *
     * @var string parameters of url, like xx=xx&yy=yy&zz=zz
     */
    public $url_params;
    
    /**
     *
     * @var int close Window: 1; do NOT close winodw: 0
     */
    public $close_window = self::CLOSE_WINDOW_YES;
    
    /**
     *
     * @var int display clear button: 1;
     */
    public $clear_button = self::CLEAR_BUTTON_YES;
    
    /**
     * this is a array, which is used to generate json data
     * 
     * @var string the json string for child window
     */
    public $callback_data;
    
    /**
     *
     * @var int same window name: 1; different window name: 0
     */
    public $window_mode = self::WINDOW_MODE_SAME;
            
    /**
     * @inherit doc
     * @throw InvalidConfigException
     */
    public function init()
    {
        if (empty($this->options['class'])) {
            $this->options['class'] = 'form-control';
        }
        
        if ($this->clear_button) {
            $this->clear_button = self::CLEAR_BUTTON_YES;
        } else {
            $this->clear_button = self::CLEAR_BUTTON_NO;
        }
        
        if ($this->close_window) {
            $this->close_window = self::CLOSE_WINDOW_YES;
        } else {
            $this->close_window = self::CLOSE_WINDOW_NO;
        }
        
        if ($this->window_mode) {
            $this->window_mode = self::WINDOW_MODE_SAME;
        } else {
            $this->window_mode = self::WINDOW_MODE_DIFF;
        }
        
        parent::init();

        $this->registerAssets();
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        WinSelectAsset::register($view);
    }
    
    public function run()
    {
        $js = ['onclick' => sprintf('open_window("%s",%s, %s,"%s",%s,%s,%s,%s);', 
                        $this->controller_name,
                        $this->width,
                        $this->height,
                        $this->url_params,
                        \yii\helpers\Json::encode($this->callback_data),
                        $this->close_window,
                        $this->clear_button,
                        $this->window_mode
                    ),
                'readonly' => true,
            ];
        
        $options = ArrayHelper::merge($js, $this->options);
                
        echo \yii\helpers\Html::activeTextInput($this->model, $this->attribute, $options);
    }
}