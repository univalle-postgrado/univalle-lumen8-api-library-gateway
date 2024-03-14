<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\BooksService;
use App\Services\AuthorsService;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\RequestException;

class BookController extends Controller
{
    use ApiResponser;

    public $booksService;
    public $authorsService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BooksService $booksService,  AuthorsService $authorsService)
    {
        $this->booksService = $booksService;
        $this->authorsService = $authorsService;
    }

    public function index(Request $request)
    {
        $queryString = http_build_query($request->query());
        return $this->successResponse($this->booksService->index('v1', $queryString));
    }

    public function get($id)
    {
        return $this->successResponse($this->booksService->get('v1', $id));
    }

    public function post(Request $request)
    {
        $data = $request->all();

        try {
            // Verificamos si existe el author con su ID
            $this->authorsService->get('v1', $data['author_id']);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() == 404) {
                return $this->errorResponse('El Author con el ID #' . $data['author_id'] . ' no existe', Response::HTTP_BAD_REQUEST);
            } else {
                // Manejar otros errores de solicitud aquí
                return $this->errorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
            }
        }

        $user = Auth::user();
        $data['created_by'] = $user->email;
        return $this->successResponse($this->booksService->post('v1', $data));
    }

    public function put(Request $request, $id)
    {
        $data = $request->all();

        try {
            // Verificamos si existe el author con su ID
            $this->authorsService->get('v1', $data['author_id']);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() == 404) {
                return $this->errorResponse('El Author con el ID #' . $data['author_id'] . ' no existe', Response::HTTP_BAD_REQUEST);
            } else {
                // Manejar otros errores de solicitud aquí
                return $this->errorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
            }
        }

        $user = Auth::user();
        $data['updated_by'] = $user->email;
        return $this->successResponse($this->booksService->put('v1', $id, $data));
    }

    public function patch(Request $request, $id)
    {
        $data = $request->all();

        if (!empty($data['author_id'])) {
            try {
                // Verificamos si existe el author con su ID
                $this->authorsService->get('v1', $data['author_id']);
            } catch (RequestException $e) {
                if ($e->getResponse() && $e->getResponse()->getStatusCode() == 404) {
                    return $this->errorResponse('El Author con el ID #' . $data['author_id'] . ' no existe', Response::HTTP_BAD_REQUEST);
                } else {
                    // Manejar otros errores de solicitud aquí
                    return $this->errorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
                }
            }
        }

        $user = Auth::user();
        $data['updated_by'] = $user->email;
        return $this->successResponse($this->booksService->patch('v1', $id, $data));
    }

    public function delete($id)
    {
        return $this->successResponse($this->booksService->delete('v1', $id));
    }

}
