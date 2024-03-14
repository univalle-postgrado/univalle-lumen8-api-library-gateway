<?php
namespace App\Services;

use App\Traits\ConsumesExternalService;

class BooksService {
    use ConsumesExternalService;

    public $baseUri;

    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    public function index($version, $queryString = '')
    {
        return $this->performRequest('GET', "/$version/books?$queryString");
    }

    public function get($version, $id)
    {
        return $this->performRequest('GET', "/$version/books/$id");
    }

    public function post($version, $data)
    {
        return $this->performRequest('POST', "/$version/books", $data);
    }

    public function put($version, $id, $data)
    {
        return $this->performRequest('PUT', "/$version/books/$id", $data);
    }

    public function patch($version, $id, $data)
    {
        return $this->performRequest('PATCH', "/$version/books/$id", $data);
    }

    public function delete($version, $id)
    {
        return $this->performRequest('DELETE', "/$version/books/$id");
    }

}
?>