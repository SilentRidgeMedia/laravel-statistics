<?php

namespace SilentRidge\Statistics\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class RawStatisticsStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape([ 'uuid' => "string", 'data' => "string" ])] public function rules(): array
    {
        return [
            'uuid' => 'required|string',
            'data' => 'required|array',
        ];
    }
}
