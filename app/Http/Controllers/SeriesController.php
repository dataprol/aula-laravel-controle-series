<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware(Autenticador::class)->except("index");
    }

    public function index(Request $request)
    {
        //$series = Serie::query()->orderBy('nome')->get();
        //$series = Series::query()->get();
        $series = Series::all();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')
            ->withSeries($series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request )
    {

        $series = $this->repository->add($request);

        //return redirect()->route('series.index');
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' adicionada com sucesso!");
    }

    public function destroy(Series $series)
    {
        $series->delete();

        /*         $requisicao->session()
        ->flash('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso!");
         */
        //return redirect()->route('series.index');
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso!");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->withSerie($series);
    }

    public function update(Series $series, SeriesFormRequest $requisicao)
    {
        $serieNomeAnterior = $series->nome;
        $series->fill($requisicao->all());
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série alterada de '{$serieNomeAnterior}' para '{$series->nome}' com sucesso!");
    }
}
