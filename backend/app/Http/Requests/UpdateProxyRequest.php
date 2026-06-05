<?php

namespace App\Http\Requests;

use App\Models\Proxy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProxyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Proxy|null $proxy */
        $proxy = $this->route('proxy');

        return [
            'host' => ['required', 'string', 'max:255'],
            'port' => ['required', 'integer', 'between:1,65535'],
            'username' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('proxies')->ignore($proxy?->id)->where(fn ($query) => $query
                    ->where('host', $this->input('host'))
                    ->where('port', $this->input('port'))),
            ],
            'password' => ['nullable', 'string', 'max:255'],
        ];
    }
}
