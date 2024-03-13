<?php

namespace Modules\Transaction\app\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        $data  = parent::toArray($request);
        return [
            'success' => true,
            'data'=> $data
        ];
    }
}