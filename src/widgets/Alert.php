<?php

namespace sahmed237\yii2admintheme\widgets;

class Alert extends \yii\bootstrap5\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - $key is the name of the session flash variable
     * - $value is the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $alertTypes = [
        'error'   => 'alert-danger',
        'danger'  => 'alert-danger',
        'success' => 'alert-success',
        'info'    => 'alert-info',
        'warning' => 'alert-warning'
    ];
    /**
     * @var string the options for rendering the close button tag.
     */
    public $closeButton = [];

    public function init()
    {
        parent::init();
        $session = \Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $appendClass = isset($this->options['class']) ? ' ' . $this->options['class'] : '';
        foreach ($flashes as $type => $flash) {
            if (!isset($this->alertTypes[$type])) {
                continue;
            }
            foreach ((array) $flash as $i => $message) {
                echo '<div class="alert ' . $this->alertTypes[$type] . $appendClass . ' alert-dismissible fade show" role="alert">' .
                    $message .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'.
                    '</div>';
            }
            $session->removeFlash($type);
        }
    }
}
