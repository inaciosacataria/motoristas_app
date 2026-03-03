<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * Cria nova publicidade (HTML).
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:smart_ads,name'],
            'slug' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'enabled' => ['nullable', 'boolean'],
        ]);

        DB::table('smart_ads')->insert([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'body' => $data['body'],
            'adType' => 'HTML',
            'image' => null,
            'imageUrl' => null,
            'imageAlt' => null,
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
     * Atualiza uma publicidade existente (nome, slug, body, enabled).
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
            'body' => ['required', 'string'],
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

        DB::table('smart_ads')->where('id', $id)->update([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'body' => $data['body'],
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

