<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnuncioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->privilegio === 'empregador';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'titulo' => ['required', 'string', 'max:255', 'min:10'],
            'validade' => ['required', 'date', 'after:today'],
            'descricao' => ['required', 'string', 'min:50', 'max:5000'],
            'forma_de_candidatura' => ['required', 'string', 'in:online,email,presencial'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'provincias' => ['required', 'array', 'min:1'],
            'provincias.*' => ['required', 'exists:provincias,id'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'titulo.required' => 'O título do anúncio é obrigatório.',
            'titulo.min' => 'O título deve ter no mínimo 10 caracteres.',
            'validade.required' => 'A data de validade é obrigatória.',
            'validade.after' => 'A data de validade deve ser posterior a hoje.',
            'descricao.required' => 'A descrição é obrigatória.',
            'descricao.min' => 'A descrição deve ter no mínimo 50 caracteres.',
            'descricao.max' => 'A descrição não pode exceder 5000 caracteres.',
            'categoria_id.required' => 'Selecione uma categoria.',
            'categoria_id.exists' => 'Categoria inválida.',
            'provincias.required' => 'Selecione pelo menos uma província.',
            'provincias.*.exists' => 'Uma ou mais províncias selecionadas são inválidas.',
            'forma_de_candidatura.required' => 'Selecione a forma de candidatura.',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Remove espaços extras
        if ($this->has('titulo')) {
            $this->merge([
                'titulo' => trim($this->titulo),
            ]);
        }

        if ($this->has('descricao')) {
            $this->merge([
                'descricao' => trim($this->descricao),
            ]);
        }
    }
}
