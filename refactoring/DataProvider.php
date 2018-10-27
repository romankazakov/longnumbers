<?php
namespace Integration;
use \Integration\DataProviderInterface;

class DataProvider implements DataProviderInterface
{
    private $host;
    private $user;
    private $password;

    public function __construct($host, $user, $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }
    
    /**
     * @return array
     */
    public function getProvidedData(array $request)
    {
        // returns a response from external service
    }
}
