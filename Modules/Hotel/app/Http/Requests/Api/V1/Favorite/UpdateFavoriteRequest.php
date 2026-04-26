<?php

namespace Modules\Hotel\Http\Requests\Api\V1\Favorite;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFavoriteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('favorite'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['sometimes', 'required', 'uuid', 'exists:users,id'],
            'room_type_id' => ['sometimes', 'required', 'uuid', 'exists:room_types,id'],
        ];
    }
}
