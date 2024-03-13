<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AuthorsService;

class AuthorController extends Controller
{
    use ApiResponser;

    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorsService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index(Request $request)
    {
        $queryString = http_build_query($request->query());
        return $this->successResponse($this->authorService->getIndex('v1', $queryString));
    }

}
