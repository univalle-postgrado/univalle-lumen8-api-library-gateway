<?php
namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthorsService {
    use ConsumesExternalService;

    public $baseUri;

    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
        $this->secret = config('services.authors.secret');
    }

    public function getIndex($version, $queryString = '')
    {
        return $this->performRequest('GET', "/authors?$queryString");
    }

}
?>