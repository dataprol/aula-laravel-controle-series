<x-layout title="Episodes" :mensagem-sucesso="$mensagemSucesso">
    <form method="POST">
        @csrf
        <ul class="list-group">
            @foreach ($episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center">

                    Episode {{ $episode->number }}
                    @auth
                        <input type="checkbox" name="episodes[]" value="{{ $episode->id }}"
                            @if ($episode->watched) @checked(true) @endif />
                    @endauth
                </li>
            @endforeach
        </ul>

        <button class="btn btn-primary mt-2 mb-2">Salvar</button>
    </form>
</x-layout>
