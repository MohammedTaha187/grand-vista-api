<?php

namespace Modules\Setting\Http\Requests\Api\V1\HotelSetting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHotelSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $hotelSetting = $this->route('hotel_setting');
        $id = is_object($hotelSetting) ? $hotelSetting->id : $hotelSetting;

        return [
            'key' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('hotel_settings', 'key')->ignore($id)],
            'value' => 'nullable|string',
            'type' => ['sometimes', 'required', Rule::in(['string', 'integer', 'boolean', 'json', 'file'])],
            'group' => ['sometimes', 'required', Rule::in(['general', 'contact', 'social', 'seo', 'payment', 'email', 'appearance'])],
            'is_public' => 'boolean',
        ];
    }
}
