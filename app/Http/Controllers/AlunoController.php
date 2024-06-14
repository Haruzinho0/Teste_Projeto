<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Rules\CPF;
use Carbon\Carbon;

class AlunoController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Aluno::query();

        // Aplicar filtro de termo de pesquisa por nome
        if ($request->has('termo')) {
            $termo = strtolower($request->input('termo'));
            $query->where(DB::raw('LOWER(nome)'), 'LIKE', "%{$termo}%");
        }

        // Aplicar filtro de pesquisa por CPF
        if ($request->has('cpf')) {
            $cpf = $request->input('cpf');
            $query->where('cpf', 'LIKE', "%{$cpf}%");
        }

        // Aplicar filtro de status
        if ($request->has('status')) {
            $status = $request->input('status');

            // Se 'Removido' estiver presente nos filtros, não filtramos por status para que os alunos removidos sejam incluídos na lista
            if (!in_array('Removido', $status)) {
                $query->whereIn('status', $status);
            }
        }

        // Filtrar alunos removidos apenas se 'Removido' estiver presente nos filtros
        if (!in_array('Removido', $request->input('status', []))) {
            $query->where('status', '!=', 'Removido');
        }

        $query->with('status');

        // Obter os alunos com base nos filtros
        $alunos = $query->orderBy('nome')->get();

        $alunos->each(function ($aluno) {
            $aluno->idade = $aluno->data_nascimento ? Carbon::parse($aluno->data_nascimento)->age : 'N/A';
        });

        // Renderize a view 'alunos' e passe os resultados da pesquisa
        return view('alunos.index', compact('alunos'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alunos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => ['required', 'string', 'unique:alunos,cpf', new CPF],
            'rg' => 'nullable|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'sexo' => 'required|in:M,F,Outro',
            'data_nascimento' => 'required|date',
            'endereco' => 'nullable|string',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Já existe uma conta cadastrada com este CPF.',
            'sexo.required' => 'O campo sexo é obrigatório.',
            'data_nascimento.required' => 'O campo data de nascimento é obrigatório.',
        ]);

        Aluno::create([
            'nome' => $request->input('nome'),
            'cpf' => $request->input('cpf'),
            'rg' => $request->input('rg'),
            'telefone' => $request->input('telefone'),
            'sexo' => $request->input('sexo'),
            'data_nascimento' => $request->input('data_nascimento'),
            'endereco' => $request->input('endereco'),
        ]);

        // Redirecionamento após o cadastro
        return redirect()->route('alunos.index')->with('success', 'Aluno cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aluno $aluno)
    {
        return view('alunos.show', compact('aluno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => ['required', new CPF],
            'rg' => 'nullable|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'sexo' => 'required|in:M,F,Outro',
            'data_nascimento' => 'required|date',
            'endereco' => 'nullable|string',
            'status' => 'required|in:Ativo,Inativo,Pendente,Removido', 
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Já existe uma conta cadastrada com este CPF.',
            'sexo.required' => 'O campo sexo é obrigatório.',
            'data_nascimento.required' => 'O campo data de nascimento é obrigatório.',
        ]);

        $aluno = Aluno::findOrFail($id);

        // Atualiza os dados do aluno
        $aluno->nome = $request->input('nome');
        $aluno->cpf = $request->input('cpf');
        $aluno->rg = $request->input('rg');
        $aluno->telefone = $request->input('telefone');
        $aluno->sexo = $request->input('sexo');
        $aluno->data_nascimento = Carbon::parse($request->input('data_nascimento'));
        $aluno->endereco = $request->input('endereco');
        $aluno->status = $request->input('status'); // Atualiza o status

        // Salva as alterações no banco de dados
        $aluno->save();

        return redirect()->route('alunos.show', $aluno->id)->with('success', 'Perfil do aluno atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $aluno = Aluno::findOrFail($id);

        $aluno->status = 'Removido';
        $aluno->save();

        // Redirecione de volta para a lista de alunos
        return redirect()->route('alunos.index')->with('success', 'Aluno removido com sucesso.');
        // Lógica para excluir o aluno com o ID fornecido
    }


    public function remove($id)
    {
        // Encontre o aluno pelo ID
        $aluno = Aluno::findOrFail($id);

        $aluno->status = 'Removido';
        $aluno->save();

        // Redirecione de volta para a lista de alunos
        return redirect()->route('alunos.index')->with('success', 'Aluno removido com sucesso.');
    }


    public function search(Request $request)
    {
        $termo = $request->input('termo');

        // Converter o termo de pesquisa para minúsculas
        $termoMinusculo = strtolower($termo);

        // Realize a pesquisa de alunos com base no termo de pesquisa em minúsculas
        $alunos = Aluno::whereRaw('LOWER(nome) LIKE ?', ["%{$termoMinusculo}%"])->get();

        // Carregue a visão parcial com os resultados da pesquisa
        return view('alunos.parcial.lista_alunos', compact('alunos'));
    }
}
