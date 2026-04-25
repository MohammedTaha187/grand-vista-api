<?php

namespace Modules\Setting\Http\Requests\Api\V1\HotelSetting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreHotelSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'key' => 'required|string|max:255|unique:hotel_settings,key',
            'value' => 'nullable|string',
            'type' => ['required', Rule::in(['string', 'integer', 'boolean', 'json', 'file'])],
            'group' => ['required', Rule::in(['general', 'contact', 'social', 'seo', 'payment', 'email', 'appearance'])],
            'is_public' => 'boolean',
        ];
    }
}
