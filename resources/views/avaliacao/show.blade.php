<!-- resources/views/avaliacao/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-500 dark:text-yellow-500 leading-tight">
            {{ __('Detalhes da Avaliação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2d2d2d] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-yellow-500 dark:text-yellow-500">
                    <form action="{{ route('avaliacoes.update', $avaliacao->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group flex flex-wrap">
                            <div class="w-full sm:w-1/2">
                                <label for="avaliador">Avaliador</label>
                                <input type="text" id="avaliador" name="avaliador" class="text-black" value="{{ $avaliacao->avaliador }}" required readonly disabled>
                                @error('avaliador')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full sm:w-1/2">
                                <label for="data">Data</label>
                                <input type="date" id="data" name="data" class="text-black" value="{{ $avaliacao->data }}" required readonly disabled>
                                @error('data')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group flex flex-wrap">
                            <div class="w-full sm:w-1/2">
                                <label for="altura">Altura</label>
                                <input type="number" step="0.01" id="altura" name="altura" class="text-black" value="{{ $avaliacao->altura }}" required readonly disabled>
                                @error('altura')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full sm:w-1/2">
                                <label for="idade">Idade</label>
                                <input type="number" id="idade" name="idade" class="text-black" value="{{ $avaliacao->idade }}" required readonly disabled>
                                @error('idade')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group flex flex-wrap">
                            <div class="w-full sm:w-1/2">
                                <label for="peso">Peso</label>
                                <input type="number" step="0.1" id="peso" name="peso" class="text-black" value="{{ $avaliacao->peso }}" required readonly disabled>
                                @error('peso')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full sm:w-1/2">
                                <label for="porcentagem_gordura">% Gordura</label>
                                <input type="number" step="0.1" id="porcentagem_gordura" name="porcentagem_gordura" class="text-black" value="{{ $avaliacao->porcentagem_gordura }}" required readonly disabled>
                                @error('porcentagem_gordura')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <h3>Parte Gordura</h3>
                        <div class="form-group flex flex-wrap">
                            @foreach(['braco_direito_gordura' => 'Braço Direito', 'braco_esquerdo_gordura' => 'Braço Esquerdo', 'perna_direita_gordura' => 'Perna Direita', 'perna_esquerda_gordura' => 'Perna Esquerda', 'tronco_gordura' => 'Tronco'] as $field => $label)
                                <div class="w-full sm:w-1/2">
                                    <label for="{{ $field }}">{{ $label }}</label>
                                    <input type="number" step="0.1" id="{{ $field }}" name="{{ $field }}" class="text-black" value="{{ $avaliacao->$field }}" required readonly disabled>
                                    @error($field)
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endforeach
                        </div>

                        <h3>Parte Massa Muscular</h3>
                        <div class="form-group flex flex-wrap">
                            @foreach(['massa_muscular' => 'Massa Muscular', 'braco_direito_muscular' => 'Braço Direito', 'braco_esquerdo_muscular' => 'Braço Esquerdo', 'perna_direita_muscular' => 'Perna Direita', 'perna_esquerda_muscular' => 'Perna Esquerda', 'tronco_muscular' => 'Tronco'] as $field => $label)
                                <div class="w-full sm:w-1/2">
                                    <label for="{{ $field }}">{{ $label }}</label>
                                    <input type="number" step="0.1" id="{{ $field }}" name="{{ $field }}" class="text-black" value="{{ $avaliacao->$field }}" required readonly disabled>
                                    @error($field)
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endforeach
                        </div>

                        <h3>Escala Constituição</h3>
                        <div class="form-group flex flex-wrap">
                            @foreach(['massa_ossea' => 'Massa Óssea', 'gordura_visceral' => 'Gordura Visceral', 'porcentagem_agua' => '% Água', 'taxa_metabolica_basal' => 'Taxa Metabólica Basal', 'idade_metabolica' => 'Idade Metabólica'] as $field => $label)
                                <div class="w-full sm:w-1/2">
                                    <label for="{{ $field }}">{{ $label }}</label>
                                    <input type="number" step="0.1" id="{{ $field }}" name="{{ $field }}" class="text-black" value="{{ $avaliacao->$field }}" required readonly disabled>
                                    @error($field)
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endforeach
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
            var campos = document.querySelectorAll('input[type="text"], input[type="number"], input[type="date"], select, textarea');
            campos.forEach(function(campo) {
                valoresOriginais[campo.name] = campo.value;
                campo.removeAttribute('readonly');
                campo.removeAttribute('disabled');
            });
            document.getElementById('btnSalvar').style.display = 'block';
            document.getElementById('btnCancelar').style.display = 'inline-block';
        }

        function cancelarEdicao() {
            var campos = document.querySelectorAll('input[type="text"], input[type="number"], input[type="date"], select, textarea');
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
