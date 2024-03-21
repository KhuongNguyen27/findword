<?php

namespace Modules\Employee\app\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        $data = parent::toArray($request);
        return [
            'success' => true,
            'data' => $data
        ];
    }
}
