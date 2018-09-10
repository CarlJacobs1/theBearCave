<?php
namespace Classes;
require_once $_SERVER['DOCUMENT_ROOT'] .'/Composer/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/Include/dbConnection.php';


use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

#require_once('./systemConfig.php');

class email {

    const HTML_MAIL_PATH = '../Files/Email/';

    #HTML Mail Constants
    const HTML_MAIL_NEW_USER_REGISTRATION = 'newUserRegistrationEmail.html';

    public $to;
    public $subject;
    public $message;
    public $html_message;
    private $from_email;
    private $reply_email;
    private $password;
    private $alias;
    private $host;
    private $port;

    public function __construct($to
        , $subject
        , $message
        , $html_message = true) {

        $this->to           = $to;
        $this->subject      = $subject;
        $this->message      = $message;
        $this->html_message = $html_message;

        $this->getEmailSettings();
    }

    public function sendEmail() {
        $mail = new PHPMailer();

        try {

            $mail->isSMTP();
            $mail->SMTPDebug  = 0;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host       = $this->host;
            $mail->Port       = $this->port;
            $mail->isHTML($this->html_message);

            $mail->Username = $this->from_email;
            $mail->Password = $this->password;

            $mail->setFrom($this->from_email, $this->alias);
            $mail->addAddress($this->to);
            $mail->addReplyTo($this->reply_email);

            $mail->Subject = $this->subject;
            $mail->Body    = $this->message;
            $mail->send();
        } catch (Exception $e) {
            echo $mail->errorInfo();

        }

        #var_dump($mail);
    }

    public function getEmailSettings() {

        $systemConfig  = new systemConfig();
        $emailSettings = $systemConfig->getConfigBySystemConfigGroupId(systemConfig::SYS_CONF_GRP_EMAIL_DETAILS);

        foreach ($emailSettings as $emailSetting) {

            switch ($emailSetting['id']) {
            case systemConfig::SYS_CONF_FROM_EMAIL_ADDRESS:
                $this->from_email = $emailSetting['value'];
                break;
            case systemConfig::SYS_CONF_REPLY_EMAIL_ADDRESS:
                $this->reply_email = $emailSetting['value'];
                break;
            case systemConfig::SYS_CONF_EMAIL_ALIAS:
                $this->alias = $emailSetting['value'];
                break;
            case systemConfig::SYS_CONF_EMAIL_PASSWORD:
                $this->password = $emailSetting['value'];
                break;
            case systemConfig::SYS_CONFIG_EMAIL_HOST:
                $this->host = $emailSetting['value'];
                break;
            case systemConfig::SYS_CONFIG_EMAIL_PORT:
                $this->port = $emailSetting['value'];
                break;
            }

        }

    }

    static function getHTMLEmailFromFile($fileName) {

        $htmlContent = file_get_contents(email::HTML_MAIL_PATH . $fileName);

        return $htmlContent;

    }

}

?>