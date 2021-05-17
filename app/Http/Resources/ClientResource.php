<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"            =>  $this->id,
            "name"          =>  $this->client_name,
            "address1"      =>  $this->address1,
            "address2"      =>  $this->address2,
            "city"          =>  $this->city,
            "state"         =>  $this->state,
            "country"       =>  $this->country,
            "zipCode"       =>  $this->phone_no1,
            "latitude"      =>  $this->latitude,
            "longitude"     =>  $this->longitude,
            "phoneNo1"      =>  $this->phone_no1,
            "phoneNo2"      =>  $this->phone_no2,
            "totalUser"     =>  [
                    "all"      => $this->total_users,
                    "active"   => $this->active_users,
                    "inactive" => $this->inactive_users,
            ],
            "startValidity" =>  $this->start_validity,
            "endValifity"   =>  $this->end_validity,
            "status"        =>  $this->status,
            "createdAt"     =>  $this->created_at,
            "updatedAt"     =>  $this->updated_at
        ];
    }
}
