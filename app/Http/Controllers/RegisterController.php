<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
/**
     * @var clientRepository
     */
    protected $clientRepository;

    /**
     * AccountController constructor.
     *
     * @param  $clientRepository
     */
    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Register a new Account.
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        try{
            $this->clientRepository->register($request);

            return response()->json(['status'   =>  'success']);

        } catch (\Exception $exception) {
            return response([
                    'status'   =>  'failed',
                    'message' =>  $exception->getMessage()
                ], $exception->getCode());
        }
    }
}
