<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCandidatoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'celular' => ['required', 'numeric', 'digits_between:9,13', 'unique:users,celular'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'data_nascimento' => ['required', 'date', 'before:' . now()->subYears(18)->format('Y-m-d')],
            'nacionalidade' => ['required', 'string', 'max:100'],
            'sexo' => ['required', 'in:Masculino,Feminino'],
            'grau_academico' => ['nullable', 'string', 'max:100'],
            'provincia_id' => ['required', 'exists:provincias,id'],
            'endereco' => ['required', 'string', 'max:500'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'numero_carta_conducao' => ['nullable', 'string', 'max:50'],
            'validade_conducao' => ['nullable', 'in:Sim,Não'],
            'inibicao_anterior' => ['nullable', 'in:Sim,Não'],
            'inibicao_motivo' => ['nullable', 'string', 'max:1000'],
            'envolvimento_acidente' => ['nullable', 'in:Sim,Não'],
            'acidente_descricao' => ['nullable', 'string', 'max:1000'],
            'telefone_alt' => ['nullable', 'numeric', 'digits_between:9,13'],
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
            'name.required' => 'O nome é obrigatório.',
            'name.min' => 'O nome deve ter no mínimo 3 caracteres.',
            'celular.required' => 'O celular é obrigatório.',
            'celular.unique' => 'Este celular já está registrado.',
            'celular.digits_between' => 'O celular deve ter entre 9 e 13 dígitos.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_nascimento.before' => 'Você deve ter pelo menos 18 anos.',
            'provincia_id.required' => 'Selecione uma província.',
            'provincia_id.exists' => 'Província inválida.',
            'categoria_id.required' => 'Selecione uma categoria de habilitação.',
            'categoria_id.exists' => 'Categoria inválida.',
            'sexo.required' => 'Selecione o sexo.',
            'endereco.required' => 'O endereço é obrigatório.',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Remove espaços extras do nome
        if ($this->has('name')) {
            $this->merge([
                'name' => trim($this->name),
            ]);
        }
    }
}
