<?php

/*
 * This file is part of Jitamin.
 *
 * Copyright (C) 2016 Jitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jitamin\Helper;

use Jitamin\Core\Base;

/**
 * Application Helper.
 */
class AppHelper extends Base
{
    /**
     * Get setting variable.
     *
     * @param string $param
     * @param mixed  $default_value
     *
     * @return mixed
     */
    public function setting($param, $default_value = '')
    {
        return $this->settingModel->get($param, $default_value);
    }

    /**
     * Make sidebar menu active.
     *
     * @param string $controller
     * @param string $action
     * @param string $plugin
     *
     * @return string
     */
    public function checkMenuSelection($controller, $action = '', $plugin = '')
    {
        $result = strtolower($this->getRouterController()) === strtolower($controller);

        if ($result && $action !== '') {
            $result = strtolower($this->getRouterAction()) === strtolower($action);
        }

        if ($result && $plugin !== '') {
            $result = strtolower($this->getPluginName()) === strtolower($plugin);
        }

        return $result ? 'class="active"' : '';
    }

    /**
     * Get plugin name from route.
     *
     * @return string
     */
    public function getPluginName()
    {
        return $this->router->getPlugin();
    }

    /**
     * Get router controller.
     *
     * @return string
     */
    public function getRouterController()
    {
        return $this->router->getController();
    }

    /**
     * Get router action.
     *
     * @return string
     */
    public function getRouterAction()
    {
        return $this->router->getAction();
    }

    /**
     * Get javascript language code.
     *
     * @return string
     */
    public function jsLang()
    {
        return $this->languageModel->getJsLanguageCode();
    }

    /**
     * Get date format for Jquery DatePicker.
     *
     * @return string
     */
    public function getJsDateFormat()
    {
        $format = $this->dateParser->getUserDateFormat();
        $format = str_replace('m', 'mm', $format);
        $format = str_replace('Y', 'yy', $format);
        $format = str_replace('d', 'dd', $format);

        return $format;
    }

    /**
     * Get time format for Jquery Plugin DateTimePicker.
     *
     * @return string
     */
    public function getJsTimeFormat()
    {
        $format = $this->dateParser->getUserTimeFormat();
        $format = str_replace('H', 'HH', $format);
        $format = str_replace('i', 'mm', $format);
        $format = str_replace('g', 'h', $format);
        $format = str_replace('a', 'tt', $format);

        return $format;
    }

    /**
     * Get current skin.
     *
     * @return string
     */
    public function getSkin()
    {
        return $this->skinModel->getCurrentSkin();
    }

    /**
     * Get current timezone.
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezoneModel->getCurrentTimezone();
    }

    /**
     * Get session flash message.
     *
     * @return string
     */
    public function flashMessage()
    {
        $success_message = $this->flash->getMessage('success');
        $failure_message = $this->flash->getMessage('failure');

        if (!empty($success_message)) {
            return '<div class="alert alert-success alert-dismissible alert-fade-out">'.
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.
                    $this->helper->text->e($success_message).
                    '</div>';
        }

        if (!empty($failure_message)) {
            return '<div class="alert alert-error alert-dismissible">'.
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.
                    $this->helper->text->e($failure_message).
                    '</div>';
        }

        return '';
    }
}
