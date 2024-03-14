<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AuthorsService;
use Illuminate\Support\Facades\Auth;

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
        return $this->successResponse($this->authorService->index('v1', $queryString));
    }

    public function get($id)
    {
        return $this->successResponse($this->authorService->get('v1', $id));
    }

    public function post(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();
        $data['created_by'] = $user->email;
        return $this->successResponse($this->authorService->post('v1', $data));
    }

    public function put(Request $request, $id)
    {
        $user = Auth::user();

        $data = $request->all();
        $data['updated_by'] = $user->email;
        return $this->successResponse($this->authorService->put('v1', $id, $data));
    }

    public function patch(Request $request, $id)
    {
        $user = Auth::user();

        $data = $request->all();
        $data['updated_by'] = $user->email;
        return $this->successResponse($this->authorService->patch('v1', $id, $data));
    }

    public function delete($id)
    {
        return $this->successResponse($this->authorService->delete('v1', $id));
    }

}
