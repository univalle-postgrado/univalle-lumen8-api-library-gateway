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

    public function index($version, $queryString = '')
    {
        return $this->performRequest('GET', "/$version/authors?$queryString");
    }

    public function get($version, $id)
    {
        return $this->performRequest('GET', "/$version/authors/$id");
    }

    public function post($version, $data)
    {
        return $this->performRequest('POST', "/$version/authors", $data);
    }

    public function put($version, $id, $data)
    {
        return $this->performRequest('PUT', "/$version/authors/$id", $data);
    }

    public function patch($version, $id, $data)
    {
        return $this->performRequest('PATCH', "/$version/authors/$id", $data);
    }

    public function delete($version, $id)
    {
        return $this->performRequest('DELETE', "/$version/authors/$id");
    }

}
?>