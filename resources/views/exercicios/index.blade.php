<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-500 dark:text-yellow-500 leading-tight">
            {{ __('Lista de Exercícios') }}
        </h2>
        <x-nav-link :href="route('exercicios.create')" :active="request()->routeIs('exercicios.create')" class="text-yellow-500 hover:text-yellow-400">
            {{ __('Criar Exercício') }}
        </x-nav-link>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2d2d2d] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-yellow-500 dark:text-yellow-500">
                    <div class="pesquisar">
                        <form action="{{ route('exercicios.index') }}" method="GET" class="search-form">
                            <div class="pesquisar">
                                <input type="text" id="termoPesquisa" name="termo" placeholder="Pesquisar por nome" value="{{ Request::input('termo') }}" class="search-box text-black">
                                <input type="text" id="grupoMuscularPesquisa" name="grupo_muscular" placeholder="Pesquisar por grupo muscular" value="{{ Request::input('grupo_muscular') }}" class="search-box text-black">
                                <select name="dificuldade[]" class="form-control text-black" multiple>
                                    <option value="easy" {{ in_array('easy', Request::input('dificuldade', [])) ? 'selected' : '' }}>Fácil</option>
                                    <option value="normal" {{ in_array('normal', Request::input('dificuldade', [])) ? 'selected' : '' }}>Normal</option>
                                    <option value="hard" {{ in_array('hard', Request::input('dificuldade', [])) ? 'selected' : '' }}>Difícil</option>
                                </select>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="button-pesquisar">Pesquisar</button>
                                <a href="{{ route('exercicios.index') }}" class="limpar-pesquisa">Limpar Pesquisa</a>
                            </div>
                        </form>
                    </div>

                    @if($exercicios->isNotEmpty())
                        <div id="listaExerciciosContainer">
                            <h2 class="header-yellow">Lista de Exercícios</h2>
                            <table class="min-w-full bg-[#2d2d2d]">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs text-yellow-500 uppercase tracking-wider">Nome</th>
                                        <th class="px-4 py-3 text-left text-xs text-yellow-500 uppercase tracking-wider">Grupo Muscular</th>
                                        <th class="px-4 py-3 text-left text-xs text-yellow-500 uppercase tracking-wider">Dificuldade</th>
                                        <th class="px-4 py-3 text-left text-xs text-yellow-500 uppercase tracking-wider">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exercicios as $exercicio)
                                        <tr class="bg-[#3d3d3d]">
                                            <td class="px-4 py-4 text-yellow-500 whitespace-nowrap">{{ $exercicio->nome }}</td>
                                            <td class="px-4 py-4 text-yellow-500 whitespace-nowrap">{{ $exercicio->grupo_muscular }}</td>
                                            <td class="px-4 py-4 text-yellow-500 whitespace-nowrap">
                                                {{ ucfirst($exercicio->dificuldade == 'easy' ? 'Fácil' : ($exercicio->dificuldade == 'normal' ? 'Normal' : 'Difícil')) }}
                                            </td>
                                            <td class="px-4 py-4 text-yellow-500 whitespace-nowrap">
                                                <a href="{{ route('exercicios.show', $exercicio->id) }}" class="text-blue-500 hover:text-blue-700">Ver</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-yellow">Nenhum exercício encontrado.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
