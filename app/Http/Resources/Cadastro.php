<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Cadastro extends JsonResource
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
            'title' => $this->title,
            'body' => $this->body
        ];
    }

    /**
     * Additional information
     *
     * @param \Illuminate\Http\Request  $request
     */
    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'author_url' => url('https://github.com/FrederycoMiguel')
        ];
    }
}
