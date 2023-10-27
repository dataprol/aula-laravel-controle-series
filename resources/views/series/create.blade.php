<x-layout title="Nova Série">
    <form action="{{ route('series.store') }}" method="post">
        @csrf

        <div class="row mb-3">
            <div class="col-8">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" autofocus
                    value="{{ old('nome') }}">
                </input>
            </div>
            <div class="col-2">
                <label for="seasonsQty" class="form-label">Temporadas:</label>
                <input type="text" class="form-control" id="seasonsQty" name="seasonsQty"
                    value="{{ old('seasonsQty') }}">
                </input>
            </div>
            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">Episódios p/temporada:</label>
                <input type="text" class="form-control" id="episodesPerSeason" name="episodesPerSeason"
                    value="{{ old('episodesPerSeason') }}">
                </input>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</x-layout>
