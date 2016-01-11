<?php
  namespace sampleMessageBoard\application\controller;
  use OAuth\OAuth2\Service\Amazon;
  use OAuth\Common\Storage\Session;
  use OAuth\Common\Consumer\Credentials;

  class AuthController implements iAuth{
    protected $sessionManager;
    protected $siteCredentials;
    public function setSessionManager(iSessionManager $sessionManager){
        $this->sessionManager = $sessionManager;
    }
    public function setApp($app){
      $this->app = $app;
    }
    public function setSiteCredentials($credentials){
      $this->siteCredentials = $credentials;
    }
    public function authenticate($site){
      if(!isset($this->siteCredentials[$site]){
        return;
      } else {
        $credentials = new Credentials(
          $this->siteCredentials[$site]['key'],
          $this->siteCredentials[$site]['secret'],

        )
      }
    }
  }
?>
