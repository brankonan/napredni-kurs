<?php

 class Email {
    private string $receiver;
    private string $subject;
    private string $message;

    public function __construct( string $receiver, string $subject,  string $message) {
        $this->receiver = $receiver;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function getReciver() {
        return $this->receiver;
    }

}


    class EmailFactory {
        public static function create($receiver, $subject, $message) {
            return new Email($receiver, $subject, $message);
        }
    }



    class MailService{
        private static $instance;
        private $count;

        private function __construct()
        {
            $this->count = 0;
        }

        static function getInstance() {
            if(self::$instance == NULL){
                self::$instance = new MailService();

            }
            return self:: $instance;
        }

         public function sendEmail(Email $mail) {
            echo "Sending email to: recipient" . $mail->getReciver();
            $this->count++;

        }
    }

    $emailFactory = new EmailFactory();
    $email = $emailFactory->create('asdasd', 'asdasd', 'asdasd');

    MailService::getInstance()->sendEmail($email); 

    
