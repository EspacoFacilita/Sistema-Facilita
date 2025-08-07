document.addEventListener('DOMContentLoaded', () => {
    const userType = document.body.getAttribute('data-usertype');  // Obtém o tipo de usuário

    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            let query = this.value;
            let page = this.getAttribute('data-page'); // Obtém a página atual
            fetch(`/search-orders?query=${query}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('table tbody');
                    tbody.innerHTML = ''; // Limpa a tabela
                    if (data.data.length === 0) {
                        tbody.innerHTML = '<tr><td class="text-center" colspan="6">Nenhuma Ordem Encontrada</td></tr>';
                        return;
                    }
                    data.data.forEach(ordem => {
                        const tr = document.createElement('tr');
                        const formatDate = (dateStr) => {
                            const [year, month, day] = dateStr.split('-');
                            return `${day}/${month}/${year}`;
                        };       
                        // Verifica se a ordem está atrasada considerando data e hora
                        const agora = new Date();
                        const dataEntrega = new Date(`${ordem.data_de_entrega}T${ordem.hora_de_entrega}`); // Combina data e hora
                        const atrasado = ordem.status !== 'Entregue' && ordem.status !== 'Concluido' && dataEntrega < agora;

                        tr.innerHTML = `
                            <td class="align-middle">${ordem.id}</td>
                            <td class="align-middle">${ordem.cliente}</td>
                            <td class="align-middle">${ordem.servico}</td>
                            <td class="align-middle">${ordem.nome_funcionario}</td>
                            <td class="align-middle">${formatDate(ordem.data_de_entrega)} ${ordem.hora_de_entrega}</td>
                            <td class="align-middle">
                                <span class="px-3 py-2 rounded ${getStatusClass(ordem.status)}">
                                    ${ordem.status.charAt(0).toUpperCase() + ordem.status.slice(1)}
                                </span>
                                ${atrasado ? `<span class="px-3 py-2 mx-1 rounded bg-dark text-white">Atrasado</span>` : ''}
                            </td>
                            <td class="align-middle">
                                <div class="btn-group" role="group">
                                    <a href="/admin/ordemdeservico${ordem.id}" class="btn bg-secondary text-white fs-6">Ver Mais</a>

                                    
                                    <!-- Adiciona o botão de 'Entregar' apenas se o tipo de usuário for 'Caixa' -->
                                    ${userType === 'Caixa' ? `
                                        
                                        <a href="/admin/ordemdeservico/${ordem.id}/entregar" onclick="return confirm('Você tem certeza que quer passar para entregue?')" class="mx-1 d-flex align-items-center btn bg-success text-white">Entregar</a>

                                        
                                    ` : ''}
                                </div>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });

                    // Atualiza a navegação da página
                    updatePagination(data);
                })
                .catch(error => {
                    console.error('Erro ao buscar ordens:', error);
                });
        });
    }

    function getStatusClass(status) {
        switch (status) {
            case 'Pendente': return 'bg-danger text-white';
            case 'Impressão': return 'bg-warning text-dark';
            case 'Laser': return "backgroundColorLaser text-darkLaser";
            case 'Produção': return 'bg-primary text-white';
            case 'Concluido': return 'bg-success text-white';
            case 'Entregue': return 'bg-success text-white'; // Para ordens entregues
            default: return 'bg-secondary text-white';
        }
    }

    function updatePagination(data) {
        // Aqui você pode adicionar a lógica para mostrar os links de paginação
        // com base nos dados de metadados retornados, como total, current_page, last_page, etc.
    }
});




document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search-client');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            let query = this.value;
            fetch(`/search-clientes?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('table tbody');
                    tbody.innerHTML = ''; // Limpa a tabela
                    if (data.length === 0) {
                        tbody.innerHTML = '<tr><td class="text-center" colspan="4">Nenhum cliente encontrado</td></tr>';
                        return;
                    }
                    data.forEach(cliente => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td class="text-center align-middle">${cliente.name}</td>
                            <td class="text-center align-middle">${cliente.endereco}</td>
                            <td class="text-center align-middle">${cliente.telefone}</td>
                            <td class="text-center align-middle">
                                <div class="btn-group" role="group">
                                    <span class="p-2">
                                        <a style="background-color: #FF8A00; border: 2px solid #FF8A00;" 
                                           href="${cliente.editUrl}" class="btn text-white">Editar</a>
                                        <a href="${cliente.deleteUrl}?_method=DELETE" class="btn btn-danger">Delete</a>
                                    </span>
                                </div>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });
                })
                .catch(error => {
                    console.error('Erro ao buscar clientes:', error);
                });
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search-funcionario');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            let query = this.value;
            fetch(`/search-funcionarios?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('table tbody');
                    tbody.innerHTML = ''; // Limpa a tabela
                    if (data.length === 0) {
                        tbody.innerHTML = '<tr><td class="text-center" colspan="4">Nenhum funcionario encontrado</td></tr>';
                        return;
                    }
                    data.forEach(funcionario => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td class="text-center align-middle">${funcionario.id}</td>
                            <td class="text-center align-middle">${funcionario.name}</td>
                            <td class="text-center align-middle">${funcionario.usertype}</td>
                            <td class="text-center align-middle">
                                <div class="btn-group" role="group">
                                    <span class="p-2">
                                      <a style="background-color: #FF8A00; border: 2px solid #FF8A00;" 
                                           href="${funcionario.editUrl}" class="btn text-white">Editar</a>
                                        <a href="${funcionario.deleteUrl}?_method=DELETE" class="btn btn-danger">Delete</a>
                                    </span>
                                </div>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });
                })
                .catch(error => {
                    console.error('Erro ao buscar funcionarios:', error);
                });
        });
    }
});


