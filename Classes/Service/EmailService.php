<?php

namespace Service;

use InvalidArgumentException;
use Util\ConstantesGenericasUtil;
use Repository\EmailRepository;
use Mailgun\Mailgun;
use guzzlehttp\guzzle\Client as Client;

class EmailService
{
    private const RECURSOS_POST = ['PostSendEmails'];
    private const APIKEY = '1a2f6ea2865fd21ce81ac1f288a5adbd-10eedde5-6fa66aff';
    private const APIDOMAIN = 'https://api.mailgun.net/v3/sandbox7f7630fe63ff408299bf1098a312c4e5.mailgun.org';

    private array $request;
    private array $dadosRequest;

    private object $EmailRepository;

    public function __construct($request = [], $dadosRequest){
        $this->request = $request;
        $this->dadosRequest = $dadosRequest;
        $this->EmailRepository = new EmailRepository();
    }

    public function validarPost(){
        $return = null;
        $recurso = $this->request['recurso'];
        
        if(in_array($recurso, self::RECURSOS_POST, true)){
            $return = $this->$recurso();
        }
        else{
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        if($return == null){
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_GENERICO);
        }
        return $return;
    }

    private function PostSendEmails(){
        $htmlCode = $this->dadosRequest['html'];
        $destinos = explode('/', trim($this->dadosRequest['destinos'], '/'));

        /*
        $client = new \vendor\guzzlehttp\guzzle\Client(['verify' => false]);
        //$adapter = new \Http\Adapter\Guzzle7\Client($client);
        $mailgun = new Mailgun($client, self::APIKEY, $adapter);
        $params = array(
            'from'    => 'pauloleospaes@gmail.com'  ,
            'to'      => 'pauloleonardopaes@gmail.com',
            'subject' => 'Hello',
            'text'    => 'Testing some Mailgun awesomness!'
            );

        $result = $mailgun->messages()->send(self::APIDOMAIN, $params);
        /*
        $mgClient = Mailgun::create('1a2f6ea2865fd21ce81ac1f288a5adbd-10eedde5-6fa66aff', 'https://api.mailgun.net/v3/sandbox7f7630fe63ff408299bf1098a312c4e5.mailgun.org');
        $domain = "https://api.mailgun.net/v3/sandbox7f7630fe63ff408299bf1098a312c4e5.mailgun.org";
        $params = array(
        'from'    => 'pauloleospaes@gmail.com'  ,
        'to'      => 'pauloleonardopaes@gmail.com',
        'subject' => 'Hello',
        'text'    => 'Testing some Mailgun awesomness!'
        );
        $result = $mgClient->messages()->send($domain, $params);
        */
        echo 'testcomplete';
        exit;

    }
}
