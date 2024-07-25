<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-500 dark:text-yellow-500 leading-tight">
            {{ __('Criar Novo Exercício') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2d2d2d] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-yellow-500 dark:text-yellow-500">
                    <form action="{{ route('exercicios.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" class="form-control text-black" required>
                            @error('nome')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="grupo_muscular">Grupo Muscular</label>
                            <input type="text" name="grupo_muscular" class="form-control text-black" required>
                            @error('grupo_muscular')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dificuldade">Dificuldade</label>
                            <select name="dificuldade" class="form-control text-black" required>
                                <option value="easy">Fácil</option>
                                <option value="normal">Normal</option>
                                <option value="hard">Difícil</option>
                            </select>
                            @error('dificuldade')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="observacoes">Observações</label>
                            <textarea name="observacoes" class="form-control text-black"></textarea>
                            @error('observacoes')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
