<?php

namespace App\Http\Requests;

use App\Client;
use App\Utilities\Image;
use App\Http\Utilities\Country;
use Illuminate\Foundation\Http\FormRequest;

class StoreClient extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Client::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'logo' => 'required|image',
            'country' => 'required|string|max:255|in:'.Country::csv(),
            'description' => 'required|string|max:255',
            'site' => 'required|url',
        ];
    }

    /**
     * Get the prepared data from the request.
     *
     * @return array
     */
    public function prepared()
    {
        $attributes = $this->validated();

        $attributes['logo'] = Image::fit($this->file('logo')->store('logos'));

        return $attributes;
    }
}
