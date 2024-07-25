<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-500 dark:text-yellow-500 leading-tight">
            {{ __('Detalhes do Exercício') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2d2d2d] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-yellow-500 dark:text-yellow-500">
                    <form action="{{ route('exercicios.update', $exercicio->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" class="form-control text-black" value="{{ $exercicio->nome }}" required readonly disabled>
                            @error('nome')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="grupo_muscular">Grupo Muscular</label>
                            <input type="text" name="grupo_muscular" class="form-control text-black" value="{{ $exercicio->grupo_muscular }}" required readonly disabled>
                            @error('grupo_muscular')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dificuldade">Dificuldade</label>
                            <select name="dificuldade" class="form-control text-black" required disabled>
                                <option value="easy" {{ $exercicio->dificuldade == 'easy' ? 'selected' : '' }}>Fácil</option>
                                <option value="normal" {{ $exercicio->dificuldade == 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="hard" {{ $exercicio->dificuldade == 'hard' ? 'selected' : '' }}>Difícil</option>
                            </select>
                            @error('dificuldade')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="observacoes">Observações</label>
                            <textarea name="observacoes" class="form-control text-black" readonly disabled>{{ $exercicio->observacoes }}</textarea>
                            @error('observacoes')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-actions">
                            <button type="button" onclick="habilitarEdicao()" class="btn btn-primary">Editar</button>
                            <button type="submit" id="btnSalvar" style="display: none;" class="btn btn-success">Salvar</button>
                            <button type="button" id="btnCancelar" style="display: none;" onclick="cancelarEdicao()" class="btn btn-danger">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var valoresOriginais = {};

        function habilitarEdicao() {
            var campos = document.querySelectorAll('input[type="text"], select, textarea');
            campos.forEach(function(campo) {
                valoresOriginais[campo.name] = campo.value;
                campo.removeAttribute('readonly');
                campo.removeAttribute('disabled');
            });
            document.getElementById('btnSalvar').style.display = 'block';
            document.getElementById('btnCancelar').style.display = 'inline-block';
        }

        function cancelarEdicao() {
            var campos = document.querySelectorAll('input[type="text"], select, textarea');
            campos.forEach(function(campo) {
                campo.value = valoresOriginais[campo.name] || '';
                campo.setAttribute('readonly', true);
                campo.setAttribute('disabled', true);
            });
            document.getElementById('btnSalvar').style.display = 'none';
            document.getElementById('btnCancelar').style.display = 'none';
        }
    </script>
</x-app-layout>
