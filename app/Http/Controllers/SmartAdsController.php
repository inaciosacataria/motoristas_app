<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SmartAdsController extends Controller
{
    /**
     * Lista todas as publicidades.
     * Apenas administradores (rota protegida por middleware admin).
     */
    public function index()
    {
        $ads = DB::table('smart_ads')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.smart-ads-modern', compact('ads'));
    }

    /**
     * Cria nova publicidade (Imagem ou HTML).
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:smart_ads,name'],
            'slug' => ['required', 'string', 'max:255'],
            'adType' => ['required', 'in:IMAGE,HTML'],
            'body' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'imageUrl' => ['nullable', 'url'],
            'imageAlt' => ['nullable', 'string', 'max:255'],
            'enabled' => ['nullable', 'boolean'],
        ]);

        // Se for imagem, garantir que o ficheiro foi enviado
        if ($data['adType'] === 'IMAGE' && !$request->hasFile('image')) {
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Selecione uma imagem para o banner.');
        }

        $imagePath = null;
        if ($data['adType'] === 'IMAGE') {
            $imagePath = $request->file('image')->store('smart-ads', 'public');
        }

        DB::table('smart_ads')->insert([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'body' => $data['adType'] === 'HTML' ? ($data['body'] ?? '') : null,
            'adType' => $data['adType'],
            'image' => $imagePath,
            'imageUrl' => $data['imageUrl'] ?? null,
            'imageAlt' => $data['imageAlt'] ?? null,
            'views' => 0,
            'clicks' => 0,
            'enabled' => $request->boolean('enabled'),
            'placements' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('smart-ads.index')
            ->with('success', 'Publicidade criada com sucesso.');
    }

    /**
     * Atualiza uma publicidade existente.
     */
    public function update($id, Request $request)
    {
        $ad = DB::table('smart_ads')->where('id', $id)->first();
        if (!$ad) {
            return redirect()->route('smart-ads.index')->with('erro', 'Publicidade não encontrada.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'adType' => ['required', 'in:IMAGE,HTML'],
            'body' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'imageUrl' => ['nullable', 'url'],
            'imageAlt' => ['nullable', 'string', 'max:255'],
            'enabled' => ['nullable', 'boolean'],
        ]);

        // Garantir unicidade do name se for alterado
        $nameExists = DB::table('smart_ads')
            ->where('name', $data['name'])
            ->where('id', '!=', $id)
            ->exists();

        if ($nameExists) {
            return redirect()->route('smart-ads.index')
                ->with('erro', 'Já existe uma publicidade com esse nome.');
        }

        $imagePath = $ad->image;
        if ($data['adType'] === 'IMAGE' && $request->hasFile('image')) {
            // Remover imagem antiga se existir
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('smart-ads', 'public');
        }

        DB::table('smart_ads')->where('id', $id)->update([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'body' => $data['adType'] === 'HTML' ? ($data['body'] ?? '') : null,
            'adType' => $data['adType'],
            'image' => $imagePath,
            'imageUrl' => $data['imageUrl'] ?? null,
            'imageAlt' => $data['imageAlt'] ?? null,
            'enabled' => $request->boolean('enabled'),
            'updated_at' => now(),
        ]);

        return redirect()->route('smart-ads.index')
            ->with('success', 'Publicidade atualizada com sucesso.');
    }

    /**
     * Ativa/desativa rapidamente uma publicidade.
     */
    public function toggle($id)
    {
        $ad = DB::table('smart_ads')->where('id', $id)->first();
        if (!$ad) {
            return redirect()->route('smart-ads.index')->with('erro', 'Publicidade não encontrada.');
        }

        DB::table('smart_ads')->where('id', $id)->update([
            'enabled' => !$ad->enabled,
            'updated_at' => now(),
        ]);

        return redirect()->route('smart-ads.index')
            ->with('success', 'Estado da publicidade atualizado.');
    }

    /**
     * Remove uma publicidade.
     */
    public function destroy($id)
    {
        DB::table('smart_ads')->where('id', $id)->delete();

        return redirect()->route('smart-ads.index')
            ->with('success', 'Publicidade removida com sucesso.');
    }
}

