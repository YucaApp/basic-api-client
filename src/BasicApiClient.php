<?php
namespace Yuca;

use Exception;
use InvalidArgumentException;

class BasicApiClient
{
    
    /**
     * The base uri of api url
     * @var string
     */
    protected $baseUrl;
    
    /**
     * The username of basic http authentication
     * @var string
     */
    protected $username = '';
    
    /**
     * The password of basic http authentication
     * @var string
     */
    protected $password = '';
    
    /**
     * Return result data as 'array' or 'object'
     * @var string
     */
    protected $return = 'object';

    /**
     * Construct the options
     */
    public function __construct(array $options)
    {
        foreach ($options as $key => $value) {
            if (property_exists(self::class, $key)) {
                $this->$key = $value;
            }
        }

        $vars = get_object_vars($this);
        foreach ($vars as $key => $val) {
            if (is_null($val)) {
                throw new InvalidArgumentException($key . ' is required.');
            }
        }
    }

    /**
     * HTTP POST request call
     * @param  striing $function   
     * @param  array  $parameters 
     * @return object/array             
     */
    public function post($function, array $parameters = [])
    {
        return $this->request('post', $function, $parameters);
    }

    /**
     * HTTP GET request call
     * @param  striing $function   
     * @param  array  $parameters 
     * @return object/array             
     */
    public function get($function, array $parameters = [])
    {
        return $this->request('get', $function, $parameters);
    }

    /**
     * Perform HTTP request call
     * @param  string $method     POST|GET
     * @param  string $function   
     * @param  array  $parameters 
     * @return object/array             
     */
    public function request($method, $function, array $parameters = [])
    {
        $url = trim($this->baseUrl, '/') . '/' . trim($function, '/');
        $params = http_build_query($parameters);

        $context = [];
        $headers = [];

        if ($this->username && $this->password) {
	        $headers[] = 'Authorization: Basic ' . base64_encode($this->username . ':' . $this->password);
	    }

        if (strtoupper($method) == 'POST') {
            $context['http']['method'] = 'POST';
            $context['http']['content'] = $params;
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        } else {
            $url .= '?' . $params;
        }

        // Put header in context
        $context['http']['header'] = $headers;

        $contents = file_get_contents($url, false, stream_context_create($context));

        if ($contents !== false) {
        	return json_decode($contents, $this->return == 'array');
        } else {
        	throw new Exception('Error processing request.');
        }
    }
}