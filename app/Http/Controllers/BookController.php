<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\BooksService;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    use ApiResponser;

    public $bookService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BooksService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index(Request $request)
    {
        $queryString = http_build_query($request->query());
        return $this->successResponse($this->bookService->index('v1', $queryString));
    }

    public function get($id)
    {
        return $this->successResponse($this->bookService->get('v1', $id));
    }

    public function post(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();
        $data['created_by'] = $user->email;
        return $this->successResponse($this->bookService->post('v1', $data));
    }

    public function put(Request $request, $id)
    {
        $user = Auth::user();

        $data = $request->all();
        $data['updated_by'] = $user->email;
        return $this->successResponse($this->bookService->put('v1', $id, $data));
    }

    public function patch(Request $request, $id)
    {
        $user = Auth::user();

        $data = $request->all();
        $data['updated_by'] = $user->email;
        return $this->successResponse($this->bookService->patch('v1', $id, $data));
    }

    public function delete($id)
    {
        return $this->successResponse($this->bookService->delete('v1', $id));
    }

}
