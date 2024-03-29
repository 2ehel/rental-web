<?php

namespace App\Http\Requests;

use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
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
            'cust_id' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'duration_option' => ['required'],
            'duration' => ['required'],
            'start_date' => ['required', 'date', new DateBetween],
            // 'car_owner_id' => ['required'],
            'car_id' => ['required'],
            'booking_status' => ['required'],
            'total_pay' => ['required'],
        ];
    }
}
