<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReimburseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'approval_rate'         => $this->approval_rate,
            'transfer_destination'  => $this->transfer_destination,
            'transfer_amount'       => $this->transfer_amount,
            'description'           => $this->description,
            'approval_due_date'     => $this->approval_due_date,
            'group_id'              => $this->group_id,
            'member'                => new MemberResource($this->member),
            'GroupChat'             => new GroupResource($this->group),


        ];
    }
}
