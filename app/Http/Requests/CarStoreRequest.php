<?php

namespace App\Http\Requests;

use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CarStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'model' => ['required'],
            'brand' => ['required'],
            'car_plate' => ['required'],
            'year_register' => ['required'],
            // 'car_owner_id' => ['required'],
            'charge_per_hour' => ['required'],
            'charge_per_day' => ['required'],
            'image' =>['required'],
            'description' =>['required']
        ];
    }
}
