<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class ValidMobile implements Rule
{
	
	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct () {
	
	}
	
	/**
	 * Determine if the validation rule passes.
	 *
	 * @param string $attribute
	 * @param mixed  $value
	 * @return bool
	 */
	public function passes ( $attribute , $value ) {
		// TODO: Implement passes() method.
		return preg_match('/^(0|0098|\+98)9(0[1-5]|[1 3]\d|2[0-2]|98)\d{7}$/' , $value);
	}
	
	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message () {
		return 'The mobile number format is invalid and the mobile number must be 10 digits';
	}
}
