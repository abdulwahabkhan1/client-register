<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\GeocodeService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    protected $userRepository;

    /**
     * AccountRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Client $model, UserRepositoryInterface $userRepository)
    {
        $this->model = $model;

        $this->userRepository = $userRepository;
    }

    /**
     * Get Accounts Raw query
     *
     * @param array $filters
     * @param array $sort
     * @return mixed
     */
    public function allRaw(array $filters = [], array $sort = [])
    {
        $model = $this->model->selectRaw('clients.id AS id, client_name,
            address1, address2, city, state, country, latitude, longitude,
            phone_no1, phone_no2, start_validity, end_validity,
            clients.status as status, clients.created_at, clients.updated_at,
            COUNT(users.id) as total_users,
            SUM(IF(users.status = "Active", 1, 0)) AS active_users,
            SUM(IF(users.status = "Inactive", 1, 0)) AS inactive_users
        ')
            ->join('users', 'users.client_id', '=' ,'clients.id');

        foreach($filters as $key => $value){
            $model->where($key, $value);
        }

        foreach($sort as $key => $value){
            $model->sortBy($key, $value);
        }

        $model->groupByRaw('clients.id, client_name,
        address1, address2, city, state, country, latitude, longitude,
        phone_no1, phone_no2, start_validity, end_validity,
        clients.status, clients.created_at, clients.updated_at');

        return $model->paginate();
    }


    /**
     * Register Client
     *
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request)
    {
        $coordinates = $this->getCoordinates($request->address1);

        //Create Client
        $clientData = [
            "client_name"       =>  $request->get('name'),
            "address1"          =>  $request->get('address1'),
            "address2"          =>  $request->get('address2'),
            "city"              =>  $request->get('city'),
            "state"             =>  $request->get('state'),
            "country"           =>  $request->get('country'),
            "latitude"          =>  $coordinates['lat'] ?? null,
            "longitude"         =>  $coordinates['long'] ?? null,
            "phone_no1"         =>  $request->get('phoneNo1'),
            "phone_no2"         =>  $request->get('phoneNo2'),
            "zip"               =>  $request->get('zipCode'),
            "start_validity"    =>  now()->format("Y-m-d"),
            "end_validity"      =>  now()->addDays(15)->format("Y-m-d"),
            "status"            =>  'Active'
        ];

        $client = $this->create($clientData);

        //Create user
        $userData = [
            "client_id" => $client->id,
            "first_name" => $request->user['firstName'],
            "last_name" => $request->user['lastName'],
            "email" => $request->user['email'],
            "password" => Hash::make($request->user['password']),
            "phone" => $request->user['phone'],
            "last_password_reset" => now()->format("Y-m-d H:i:s"),
            "status" => 'Active'
        ];

        $this->userRepository->create($userData);
    }

    /**
     * Get Coordinates
     */
    protected function getCoordinates($address)
    {
        try{
            $coordinates = Redis::get($address);

            if($coordinates){
                return json_decode($coordinates, true);
            }

            $geocodeService = new GeocodeService();

            $coordinates = $geocodeService->getCoordinates($address);

            Redis::set($address, json_encode($coordinates));

            return $coordinates;

        } catch ( \Exception $exception){
            //Log or report exceptinon and continue execution
            return [
                'lat'   =>  null,
                'long'  =>  null
            ];
        }
    }

}
