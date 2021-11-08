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
    private const MYAPIDOMAIN = 'sandbox7f7630fe63ff408299bf1098a312c4e5.mailgun.org';
    private const EMAILSENTNAME = 'no_reply@apiphp.com';

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
        $success = [];
        $errors = [];
        $htmlCode = $this->dadosRequest['html'];
        $destinos = explode('/', trim($this->dadosRequest['destinos'], '/'));
        $mgClient = Mailgun::create(self::APIKEY, self::APIDOMAIN);
        
        for ($i=0; $i < count($destinos) ; $i++) { 
            $params[$i] = array(
                'from'    => self::EMAILSENTNAME,
                'to'      => $destinos[$i],
                'subject' => 'Hello',
                'html' => $htmlCode
            );
            $execute = $mgClient->messages()->send(self::MYAPIDOMAIN, $params[$i]);
            if($execute['isError'] != 0){
                $errors[$i] = $destinos[$i];    
            }
            else{
                $success[$i] = $destinos[$i];
            }
        }
        $result  = array(
            'Sucessos:' => $success ,
            'Erros:' =>$errors
        );
        return $result;

    }
}
