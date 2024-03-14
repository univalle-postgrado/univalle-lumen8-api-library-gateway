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

    public $authorsService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorsService $authorsService)
    {
        $this->authorsService = $authorsService;
    }

    public function index(Request $request)
    {
        $queryString = http_build_query($request->query());
        return $this->successResponse($this->authorsService->index('v1', $queryString));
    }

    public function get($id)
    {
        return $this->successResponse($this->authorsService->get('v1', $id));
    }

    public function post(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();
        $data['created_by'] = $user->email;
        return $this->successResponse($this->authorsService->post('v1', $data));
    }

    public function put(Request $request, $id)
    {
        $user = Auth::user();

        $data = $request->all();
        $data['updated_by'] = $user->email;
        return $this->successResponse($this->authorsService->put('v1', $id, $data));
    }

    public function patch(Request $request, $id)
    {
        $user = Auth::user();

        $data = $request->all();
        $data['updated_by'] = $user->email;
        return $this->successResponse($this->authorsService->patch('v1', $id, $data));
    }

    public function delete($id)
    {
        return $this->successResponse($this->authorsService->delete('v1', $id));
    }

}
