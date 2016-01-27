<?php
  namespace sampleMessageBoard\application\controller;
  use OAuth\OAuth2\Service\Amazon;
  use OAuth\OAuth2\Service\Google;
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
    public function getAuthService($site, $landingPage){
      $uriFactory = new \OAuth\Common\Http\Uri\UriFactory();
      $currentUri = $uriFactory->createFromSuperGlobalArray($_SERVER);
      $currentUri->setQuery('');
      $serviceFactory = new \OAuth\ServiceFactory();

      $credentials = new Credentials(
        $this->siteCredentials[$site]['key'],
        $this->siteCredentials[$site]['secret'],
        $landingPage
      );
      $storage = new Session();
      $service = $serviceFactory->createService($site, $credentials, $storage, array('userinfo_email', 'userinfo_profile'));
      return $service;
    }
    public function getToken($service, $code = null, $state = null){
      $token = $service->requestAccessToken($code, $state);
      return $token;
    }
    // public function authenticate($site, $landingPage){
    //   if(!isset($this->siteCredentials[$site]){
    //     return;
    //   } else {
    //
    //     if(!empty($_GET['code'])){
    //
    //     } else if(!empty($_GET['go']) && $_GET['go'] == 'go'){
    //       $app->redirect($service->getAuthorizationUri());
    //     }
    //   }
    // }
  }
?>
