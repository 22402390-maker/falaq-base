@extends('layouts.app')

@section('title', $evento->titulo . ' — FalaQ')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-5 gap-6">

    <!-- Formulário de envio de Pergunta -->
    <div class="md:col-span-2">
        <div class="bg-gray-900 border border-gray-700 rounded-lg shadow-md p-6">
            <h4 class="text-xl font-bold mb-4">💬 Faça sua Pergunta</h4>

            <form action="{{ route('eventos.perguntas.store', $evento->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="texto" class="block text-sm text-gray-400 mb-1">Texto da Pergunta</label>

                    <textarea name="texto" id="texto" rows="4"
                              class="w-full p-3 rounded-md bg-gray-800 text-white border @error('texto') border-red-500 @else border-gray-600 @enderror"
                              placeholder="Digite sua dúvida ou comentário para o palestrante...">{{ old('texto') }}</textarea>

                    @error('texto')
                        <p class="text-red-500 text-sm font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 text-white font-bold px-4 py-2 rounded-md hover:bg-blue-700 transition">
                    Enviar Pergunta
                </button>
            </form>
        </div>
    </div>

    <!-- Mural de Perguntas -->
    <div class="md:col-span-3">
        <div class="flex justify-between items-center mb-4">
            <h4 class="text-xl font-bold">📋 Perguntas do Evento</h4>
            <span class="text-gray-400 text-sm">Total no Banco: {{ $evento->perguntas->count() }}</span>
        </div>

        @forelse($perguntas as $pergunta)
            <div class="mb-4 p-4 bg-gray-800 border border-gray-700 rounded-2xl rounded-tl-none shadow-md">
                <p class="text-lg text-white mb-3">{{ $pergunta->texto }}</p>
                <div class="flex justify-between items-center text-gray-400 text-sm">
                    <span>Status:
                        <span class="bg-green-600 text-white text-xs px-2 py-1 rounded-full">{{ $pergunta->status }}</span>
                    </span>
                    <span>{{ $pergunta->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-400 bg-gray-800 rounded-lg p-6">
                Nenhuma pergunta enviada ainda. Seja o primeiro!
            </div>
        @endforelse

        @if(method_exists($perguntas, 'links'))
            <div class="flex justify-center mt-6">
                {{ $perguntas->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
