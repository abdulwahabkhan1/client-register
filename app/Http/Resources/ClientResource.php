<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ClientResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                "id"            =>  $item->id,
                "name"          =>  $item->client_name,
                "address1"      =>  $item->address1,
                "address2"      =>  $item->address2,
                "city"          =>  $item->city,
                "state"         =>  $item->state,
                "country"       =>  $item->country,
                "zipCode"       =>  $item->phone_no1,
                "latitude"      =>  $item->latitude,
                "longitude"     =>  $item->longitude,
                "phoneNo1"      =>  $item->phone_no1,
                "phoneNo2"      =>  $item->phone_no2,
                "totalUser"     =>  [
                        "all"      => $item->users->count(),
                        "active"   => $item->users->where('status',"Active")->count(),
                        "inactive" => $item->users->where('status',"Inactive")->count(),
                ],
                "startValidity" =>  $item->start_validity,
                "endValifity"   =>  $item->end_validity,
                "status"        =>  $item->status,
                "createdAt"     =>  $item->created_at,
                "updatedAt"     =>  $item->updated_at
            ];
        });
    }
}
