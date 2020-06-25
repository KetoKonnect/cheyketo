<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'line_items' => $this->line_items,
            'payment_method' => $this->payment_method,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'status' => $this->status,
            'customer' => $this->user,
            'created_at' => $this->created_at->toFormattedDateString()
        ];
    }
}
