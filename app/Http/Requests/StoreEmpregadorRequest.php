<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpregadorRequest extends FormRequest
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
            'newemail' => ['required', 'email', 'max:255', 'unique:users,email'],
            'nuit' => ['required', 'numeric', 'digits:9', 'unique:empregadors,nuit'],
            'sector_actividade' => ['required', 'string', 'max:100'],
            'sector_especificado' => ['nullable', 'string', 'max:255', 'required_if:sector_actividade,Outro'],
            'representante' => ['required', 'string', 'max:255'],
            'telefone' => ['required', 'numeric', 'digits_between:9,13', 'unique:users,celular'],
            'telefone_alt' => ['nullable', 'numeric', 'digits_between:9,13'],
            'website' => ['nullable', 'url', 'max:255'],
            'endereco' => ['required', 'string', 'max:500'],
            'provincia_id' => ['required', 'exists:provincias,id'],
            'sobre' => ['nullable', 'string', 'max:2000'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
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
            'name.required' => 'O nome da empresa é obrigatório.',
            'name.min' => 'O nome da empresa deve ter no mínimo 3 caracteres.',
            'newemail.required' => 'O email é obrigatório.',
            'newemail.email' => 'Forneça um email válido.',
            'newemail.unique' => 'Este email já está registrado.',
            'nuit.required' => 'O NUIT é obrigatório.',
            'nuit.digits' => 'O NUIT deve ter exatamente 9 dígitos.',
            'nuit.unique' => 'Este NUIT já está registrado.',
            'sector_actividade.required' => 'Selecione o setor de atividade.',
            'sector_especificado.required_if' => 'Especifique o setor de atividade.',
            'representante.required' => 'O nome do representante é obrigatório.',
            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.unique' => 'Este telefone já está registrado.',
            'telefone.digits_between' => 'O telefone deve ter entre 9 e 13 dígitos.',
            'website.url' => 'Forneça uma URL válida.',
            'endereco.required' => 'O endereço é obrigatório.',
            'provincia_id.required' => 'Selecione uma província.',
            'provincia_id.exists' => 'Província inválida.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
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
        if ($this->has('name')) {
            $this->merge([
                'name' => trim($this->name),
            ]);
        }

        if ($this->has('representante')) {
            $this->merge([
                'representante' => trim($this->representante),
            ]);
        }

        // Se o setor não for "Outro", limpar o campo sector_especificado
        if ($this->sector_actividade !== 'Outro') {
            $this->merge([
                'sector_especificado' => null,
            ]);
        }
    }
}
