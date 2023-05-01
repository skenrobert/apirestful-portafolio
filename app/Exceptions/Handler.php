<?php

namespace App\Exceptions;
use Throwable;
use App\Traits\ApiResponser;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    use ApiResponser;

    protected $dontReport = [];


     protected $internalDontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        HttpResponseException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
        ValidationException::class,
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        if($exception instanceof ValidationException){
            return $this->convertValidationExceptionToResponse($exception, $request);

        }

        if($exception instanceof ModelNotFoundException){
            // $code = $exception->getStatusCode();
            $modelo = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("No Existe ninguna instacia de {$modelo} con el id especificado", 404);

        }

        if($exception instanceof AuthenticationException){
           // return $this->unauthenticated($request, $exception);
            // return $this->errorResponse('No esta autenticado', 401);
            return response()->json('No esta autenticado');
        }

        if($exception instanceof AuthorizationException){
            // return $this->errorResponse('No posse permisos para ejecutar esta acción.', $exception->getStatusCode());
            return $this->errorResponse('No posse permisos para ejecutar esta acción.', 403);

        }

        if($exception instanceof NotFoundHttpException){
            return $this->errorResponse('No se encontró la URL especificada.', 404);
            // return $this->errorResponse('No se encontró la URL especificada.', $exception->getStatusCode());
        }

        if($exception instanceof MethodNotAllowedHttpException){
            // return $this->errorResponse('El metodo especificado en la peticion no es valido', $exception->getStatusCode());
            return $this->errorResponse('El metodo especificado en la peticion no es valido', 405);

        }

        if($exception instanceof HttpException){
            return $this->errorResponse($exception->getMessage() , $exception->getStatusCode());

        }

        if($exception instanceof QueryException){
            $codigo = $exception->errorInfo[1];

            if($codigo == 1451) {

                // return $this->errorResponse('No se puede eliminar de forma permanente el recurso porque esta relacionado con algun otro.', $exception->getStatusCode());
                return $this->errorResponse('No se puede eliminar de forma permanente el recurso porque esta relacionado con algun otro.', 409);
              
            }

        }

        if(config('app.debug')){
            return parent::render($request, $exception);
         }

        // dd($request, $exception);
        return $this->errorResponse('Internal Error Server - Falla Inesperada. Intente Luego', 500);
        // return $this->errorResponse('Falla Inesperada. Intente Luego', $exception->getStatusCode());


    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();

        // return $this->errorResponse($errors, $exception->getStatusCode());
        return $this->errorResponse($errors, 422);//TODO de los request

    }


    // public function prepareException($request, Exception $e)
    // {
    //     $e = $this->prepareException($e0);

    //     if($e instanceof HttpResponseException){
    //         return $e->getResponse();
    //     }elseif ($e instanceof AuthenticationException){
    //         return $this->unauthenticated($request, $e);
    //     }elseif ($e instanceof ValidationException){
    //         return $this->convertValidationExceptionToResponse($e, $request);
    //     }

    //     return $this->prepareResponse($request, $e);


    // }


    // public function prepareException($request, Exception $e)
    // {
    //     // $e = $this->prepareException($e0);

        // if($e instanceof HttpResponseException){
        //     return $e->getResponse();
        // }elseif ($e instanceof AuthenticationException){
        //     return $this->unauthenticated($request, $e);
        // }elseif ($e instanceof ValidationException){

        // }


    // }




}
