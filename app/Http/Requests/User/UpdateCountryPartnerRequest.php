<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UpdateCountryPartnerRequest extends CreateCountryPartnerRequest
{
    /**
     * @var User
     */
    private $user;

    /**
     *
     * @param Route $route
     */
    function __construct(Route $route)
    {
        $this->user = $route->parameter('country_partner');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'              => 'required|string|max:160',
            'role'              => 'required|exists:roles,name',
            'username'          => ['required', 'string', 'max:64', Rule::unique('users')->ignore($this->user)],
            'email'             => ['required', 'email', 'max:64', Rule::unique('users')->ignore($this->user)],
            'password'          => Password::min(8)
                                        ->letters()
                                        ->numbers()
                                        ->symbols()
                                        ->uncompromised(),
            'organisation'      => 'required|exists:organizations,name',
            'country'           => 'required|string|max:64',
        ];
    }
}