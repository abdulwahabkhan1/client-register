<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Illuminate\Http\Request;

class AccountsController extends Controller
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
     * Get all accounts.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $accounts = $this->clientRepository->all(
            [],
            $request->get('filters', []),
            $request->get('sort', [])
        );

        return new ClientResource($accounts);

    }
}
