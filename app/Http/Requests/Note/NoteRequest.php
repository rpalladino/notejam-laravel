<?php

namespace App\Http\Requests\Note;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->pad && ! $this->padBelongsToUser()) {
            return false;
        }

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
            'name' => 'required',
            'text' => 'required'
        ];
    }

    /**
     * Check if the given pad belongs to the current user
     *
     * @return boolean
     */
    protected function padBelongsToUser()
    {
        $criteria = ['id' => $this->pad];
        return (boolean) $this->user()->pads()->where($criteria)->count();
    }
}
