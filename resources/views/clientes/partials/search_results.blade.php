    <ul class="list-group">
        @forelse($clientes as $cliente)
            <li class="list-group-item list-group-item-action"
                data-cliente_id="{{ $cliente->id }}"
                data-nome="{{ $cliente->nome }}"
                data-fone="{{ $cliente->fone }}"
                data-endereco="{{ $cliente->endereco }}">
                {{ $cliente->nome }}
            </li>
        @empty
            <li class="list-group-item">Nenhum cliente encontrado</li>
        @endforelse
    </ul>
