<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Anuncios;
use App\Models\Categorias;
use App\Models\Provincias;
use App\Models\Anuncios_provincias;
use App\Http\Requests\StoreAnuncioRequest;
use Auth;

class AnunciosControllerOptimized extends Controller
{
    /**
     * Criar novo anúncio com validação adequada
     */
    public function criarAnuncio(StoreAnuncioRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $anuncio = Anuncios::create([
                'titulo' => $request->titulo,
                'user_id' => Auth::id(),
                'validade' => $request->validade,
                'descricao' => $request->descricao,
                'forma_de_candidatura' => $request->forma_de_candidatura,
                'categoria_id' => $request->categoria_id,
                'estado_anuncio' => 'Publicado',
            ]);

            // Associar províncias usando sync (mais eficiente)
            $anuncio->provincias()->attach($request->provincias);

            DB::commit();
            
            return redirect()->back()->with('success', 'Anúncio publicado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erro ao criar anúncio: ' . $e->getMessage());
            return redirect()->back()
                ->with('erro', 'Erro ao publicar anúncio. Tente novamente.')
                ->withInput();
        }
    }

    /**
     * Ver detalhes do anúncio com eager loading
     */
    public function verAnuncio($id)
    {
        $anuncio = Anuncios::with([
            'user',
            'empregador.provincia',
            'categoria',
            'provincias',
            'candidaturas.user'
        ])->findOrFail($id);

        $categorias = Categorias::all();
        $provincias = Provincias::all();
        $anuncios_provincias = Anuncios_provincias::where('anuncio_id', $id)->get();

        return view('anuncio', compact('anuncio', 'provincias', 'categorias', 'anuncios_provincias'));
    }

    /**
     * Editar anúncio com validação
     */
    public function editarAnuncio(StoreAnuncioRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $anuncio = Anuncios::findOrFail($request->id);
            
            // Verificar autorização
            if ($anuncio->user_id !== Auth::id()) {
                return redirect()->back()->with('erro', 'Você não tem permissão para editar este anúncio.');
            }

            $anuncio->update([
                'titulo' => $request->titulo,
                'validade' => $request->validade,
                'descricao' => $request->descricao,
                'forma_de_candidatura' => $request->forma_de_candidatura,
                'categoria_id' => $request->categoria_id,
            ]);

            // Atualizar províncias usando sync
            $anuncio->provincias()->sync($request->provincias);

            DB::commit();
            
            return redirect()->back()->with('success', 'Anúncio atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erro ao editar anúncio: ' . $e->getMessage());
            return redirect()->back()
                ->with('erro', 'Erro ao atualizar anúncio. Tente novamente.')
                ->withInput();
        }
    }

    /**
     * Apagar anúncio com verificação de autorização
     */
    public function apagarAnuncio($id)
    {
        try {
            $anuncio = Anuncios::findOrFail($id);
            
            // Verificar autorização
            if ($anuncio->user_id !== Auth::id() && Auth::user()->privilegio !== 'admin') {
                return redirect()->back()->with('erro', 'Você não tem permissão para apagar este anúncio.');
            }

            $anuncio->delete();
            
            return redirect()->back()->with('success', 'Anúncio apagado com sucesso!');
        } catch (\Exception $e) {
            \Log::error('Erro ao apagar anúncio: ' . $e->getMessage());
            return redirect()->back()->with('erro', 'Erro ao apagar anúncio. Tente novamente.');
        }
    }

    /**
     * Busca otimizada com eager loading e cache
     */
    public function search(Request $request)
    {
        $categorias = Categorias::all();
        $provincias = Provincias::all();
        $anuncios_provincias = Anuncios_provincias::all();

        // Base query com eager loading
        $query = Anuncios::with(['user', 'empregador', 'categoria', 'provincias'])
            ->where('estado_anuncio', 'Publicado')
            ->where('validade', '>=', now());

        // Filtro por palavra-chave
        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('titulo', 'like', '%' . $request->keyword . '%')
                  ->orWhere('descricao', 'like', '%' . $request->keyword . '%');
            });
        }

        // Filtro por categoria
        if ($request->filled('categoria') && $request->categoria != 'null') {
            $query->where('categoria_id', $request->categoria);
        }

        // Filtro por província
        if ($request->filled('provincia') && $request->provincia != 'null') {
            $query->whereHas('provincias', function($q) use ($request) {
                $q->where('provincias.id', $request->provincia);
            });
        }

        // Ordenar por data de criação (mais recentes primeiro)
        $anuncios = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('index', compact('anuncios', 'provincias', 'categorias', 'anuncios_provincias'));
    }

    /**
     * Listar anúncios de um empregador específico
     */
    public function meusAnuncios()
    {
        $anuncios = Anuncios::with(['categoria', 'provincias', 'candidaturas'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('empregador.meus-anuncios', compact('anuncios'));
    }

    /**
     * Estatísticas do anúncio
     */
    public function estatisticas($id)
    {
        $anuncio = Anuncios::with(['candidaturas.user.candidato'])
            ->findOrFail($id);

        // Verificar autorização
        if ($anuncio->user_id !== Auth::id()) {
            abort(403, 'Não autorizado');
        }

        $stats = [
            'total_candidaturas' => $anuncio->candidaturas()->count(),
            'candidaturas_hoje' => $anuncio->candidaturas()->whereDate('created_at', today())->count(),
            'candidaturas_semana' => $anuncio->candidaturas()->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'candidaturas_mes' => $anuncio->candidaturas()->whereMonth('created_at', now()->month)->count(),
        ];

        return view('empregador.anuncio-estatisticas', compact('anuncio', 'stats'));
    }
}

