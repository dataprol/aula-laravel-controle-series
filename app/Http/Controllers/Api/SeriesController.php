<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
    }

    public function index(Request $request)
    {
        $query = Series::query();
        if ($request->has('nome')) {
            $query->where('nome', $request->nome);
        }
        return $query->paginate(5);

        /* if (!$request->has('nome')) {
            return Series::all()->toQuery()->paginate(5);
        }

        return Series::whereNome($request->nome)->get(); */
    }

    public function store(SeriesFormRequest $request)
    {
        return response()
            ->json($this->seriesRepository
                ->add($request), 201);
    }

    public function show(int $seriesId)
    {
        $series = Series::with('seasons.episodes')->find($seriesId);
        if ($series === null) {
            return response()->json(['message' => 'Serie não encontrada'], 404);
        }
        return $series;
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
    }

    public function destroy(int $seriesId, \Illuminate\Contracts\Auth\Authenticatable $user)
    {
        if ($user->tokenCan('series:delete') || $user->tokenCan('is_admin')) {
            Series::destroy($seriesId);
            return response()->noContent();
        }else{
            return response()->json(['message'=> 'Sem permissão para remover'],404);
        }
    }
}
