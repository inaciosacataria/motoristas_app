@props(['anuncio', 'provincias', 'anunciosProvincias'])

<a href="/anuncio/{{ $anuncio->id }}" {{ $attributes->merge(['class' => 'job-card']) }}>
    <div class="p-6">
        <!-- Company Logo -->
        <div class="flex justify-center mb-4">
            @php
                $logoEmpresa = null;
                // Priorizar logotipo sobre foto_url
                if (isset($anuncio->logotipo) && $anuncio->logotipo && $anuncio->logotipo != 'none') {
                    $logoEmpresa = $anuncio->logotipo;
                } elseif (isset($anuncio->foto_url) && $anuncio->foto_url && $anuncio->foto_url != 'none') {
                    $logoEmpresa = $anuncio->foto_url;
                }
            @endphp
            
            @if($logoEmpresa)
                <img src="{{ asset($logoEmpresa) }}" alt="{{ $anuncio->empresa }}" class="h-16 w-16 object-contain rounded-lg" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="h-16 w-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg flex items-center justify-center" style="display: none;">
                    <span class="text-white text-xl font-bold">{{ substr($anuncio->empresa ?? 'E', 0, 1) }}</span>
                </div>
            @else
                <div class="h-16 w-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg flex items-center justify-center">
                    <span class="text-white text-xl font-bold">{{ substr($anuncio->empresa ?? 'E', 0, 1) }}</span>
                </div>
            @endif
        </div>
        
        <!-- Job Title -->
        <h3 class="font-semibold text-lg text-gray-900 mb-2 line-clamp-2 hover:text-primary-600 transition-colors">
            {{ $anuncio->titulo }}
        </h3>
        
        <!-- Company Name -->
        <p class="text-gray-600 text-sm mb-3 flex items-center gap-2">
            <i class="fas fa-building text-primary-600"></i>
            {{ $anuncio->empresa }}
        </p>
        
        <!-- Location -->
        <p class="text-gray-600 text-sm mb-4 flex items-center gap-2">
            <i class="fas fa-map-marker-alt text-primary-600"></i>
            @php
                $locais = [];
                foreach ($anunciosProvincias as $ap) {
                    if($ap->anuncio_id == $anuncio->id) {
                        foreach ($provincias as $prov) {
                            if($ap->provincia_id == $prov->id) {
                                $locais[] = $prov->name;
                            }
                        }
                    }
                }
                echo count($locais) > 1 ? 'Vários locais' : ($locais[0] ?? 'Não especificado');
            @endphp
        </p>
        
        <!-- Tags -->
        <div class="flex flex-wrap gap-2 mb-4">
            @if($anuncio->created_at->diffInDays() < 7)
                <span class="badge badge-success">
                    <i class="fas fa-star mr-1"></i> Novo
                </span>
            @endif
            @if($anuncio->validade < now()->addDays(7))
                <span class="badge badge-warning">
                    <i class="fas fa-clock mr-1"></i> Expira em breve
                </span>
            @endif
        </div>
        
        <!-- Footer -->
        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            <span class="text-xs text-gray-500">
                {{ $anuncio->created_at->diffForHumans() }}
            </span>
            <i class="fas fa-arrow-right text-primary-600"></i>
        </div>
    </div>
</a>

