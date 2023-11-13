<?php

class FlashMessage{

    public static function set(string $message, int $type = SUCCESS)
    {
        $flashMessage = new stdClass;
        $flashMessage->message = $message;
        $flashMessage->type = $type;
        $_SESSION["flashMessage"] = $flashMessage;
    }

    public static function display(){
        if (isset($_SESSION['flashMessage'])) {
            switch ($_SESSION['flashMessage']->type) {
                case ERROR:
                    $className = 'alert-danger';
                    break;
                case SUCCESS:
                    $className = 'alert-success';
                    break;
            }
            echo '<div class="alert '.$className.'">'.$_SESSION['flashMessage']->message.'</div>';
            unset($_SESSION['flashMessage']);
        }
    }

}