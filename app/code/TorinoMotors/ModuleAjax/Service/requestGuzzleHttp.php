<?php

namespace TorinoMotors\ModuleAjax\Service;

use Exception;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\HTTP\AsyncClient\GuzzleAsyncClient;
use Magento\Framework\HTTP\AsyncClient\Request;
use Magento\Framework\HTTP\AsyncClient\Response;

class requestGuzzleHttp
{
    const ENCODE_JSON = 'json';

    /** 
     * @var string $tokenUrl 
    */
    protected $tokenUrl = "";

    /** 
     * @var mixed $credentials 
    */
    protected $credentials;

    /** 
     * @var array $headers 
    */
    protected $headers = [];

    /** 
     * @var string $token 
    */
    protected $token = "";

    /**
     *  @var string $requestUri
     */
    protected $requestUri = "";

    /**
     *  @var string $requestEndpoint
     */
    protected $requestEndpoint = "";

    /** @var \Magento\Framework\HTTP\Client\Curl $curl */
    protected $curl;

    /** @var \Magento\Framework\HTTP\AsyncClient\GuzzleAsyncClient $asyncClient */
    protected $asyncClient;

    /** @var \Magento\Framework\HTTP\AsyncClient\RequestFactory $requestFactory */
    protected $requestFactory;
    public function __construct(
        Curl $curl,
        GuzzleAsyncClient $asyncClient
    ) {
        $this->curl = $curl;
        $this->asyncClient = $asyncClient;
    }

    final public function setTokenUrl(string $url): void {
        $this->tokenUrl = $url;
    }

    final public function getTokenUrl(): string {
        return $this->tokenUrl;
    }
    
    /** 
     * @param array $credentials [
     *      'index' => $value
     * ]
     * @param string $encode JSON or empty string
     */
    final public function setCredentials(array $credentials, string $encode = ''): void {
        if(strtoupper($encode) === 'JSON'){
            $data = json_encode($credentials);
        }else{
            $data = $credentials;
        }
        $this->credentials = $data;
    }

    /** 
     * @param array $headers [
     *      'Content-Type' => "application/json",
     *      'Content-Length' => dataLength
     * ]
     * @param string $encode JSON or empty string
     */
    final public function setHeaders(array $headers): void {
        $this->headers = $headers;
    }

    final public function setUri(string $uri): void {
        $this->requestUri = $uri;
    }

    final public function getUri(): string {
        return $this->requestUri;
    }

    final public function setEndpoint(string $endpoint): void {
        $this->requestEndpoint = $endpoint;
    }

    final public function getEndpoint(): string{
        return $this->requestEndpoint;
    }

    public function setToken(){
        try{
            $this->curl->setHeaders($this->headers);
            $this->curl->post($this->tokenUrl, $this->credentials);
        }catch(Exception $e){
            throw $e;
        }
        $this->token = json_decode($this->curl->getBody());
    }

    /**
     * Fetch some data from API
     */
    // public function (array $params = [], string $method = Request::HTTP_METHOD_GET)
    // {
    //     if(!$this->getUrl()){ throw new Exception(__('Missing Url')); }
    //     if(!$this->getEndpoint()){ throw new Exception(__('Missing Endpoint')); }
    //     $response = $this->doRequest($this->getEndpoint(), $params, $method);
    //     $status = $response->getStatusCode(); // 200 status code
    //     $responseBody = $response->getBody();
    //     $responseContent = $responseBody->getContents(); // here you will have the API response in JSON format
    //     return $responseContent;
    // }

    protected function createRequest(string $method = Request::METHOD_GET, $body = ''): Request{
        if($this->token){
            $headers = ["Authorization" => 'Bearer '.$this->token, "Content-Type" => "application/json", "Accept" => "application/json"]; 
        }else{
            $headers = '';
        }
        $request = new Request(
            $this->getUri().$this->getEndpoint(),
            $method,
            $headers,
            $body
        );
        return $request;
    }

    public function doRequest(
        string $method,
        string $body = ''
    ): Response{
        $response = $this->asyncClient->request($this->createRequest($method, $body))->get();
        return $response; 
    }
    // private function doRequest(
    //     string $uriEndpoint,
    //     array $params = [],
    //     string $requestMethod = Request::HTTP_METHOD_GET
    // ): Response {
    //     /** @var Client $client */
    //     $client = $this->clientFactory->create(['config' => [
    //         'base_uri' => $this->getUrl(),
    //         'timeout' => 4,
    //         'connect_timeout' => 4
    //     ]]);

    //     try {
    //         $response = $client->request(
    //             $requestMethod,
    //             $uriEndpoint,
    //             $params
    //         );
    //     } catch (GuzzleException $exception) {
    //         /** @var Response $response */
    //         $response = $this->responseFactory->create([
    //             'status' => $exception->getCode(),
    //             'reason' => $exception->getMessage()
    //         ]);

    //         throw new Exception(__("[Status]: ". $response->getStatusCode(). " [ErrorMessage]: ". $response->getReasonPhrase()));
    //     }
    //     return $response;
    // }
}
