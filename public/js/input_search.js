document.addEventListener("DOMContentLoaded", () => {
    const userType = document.body.getAttribute("data-usertype"); // Obtém o tipo de usuário

    const searchInput = document.getElementById("search");
    if (searchInput) {
        searchInput.addEventListener("input", function () {
            let query = this.value;
            let page = this.getAttribute("data-page"); // Obtém a página atual
            fetch(`/search-orders?query=${query}&page=${page}`)
                .then((response) => response.json())
                .then((data) => {
                    const tbody = document.querySelector("table tbody");
                    tbody.innerHTML = ""; // Limpa a tabela
                    if (data.data.length === 0) {
                        tbody.innerHTML =
                            '<tr><td class="text-center" colspan="7">Nenhuma Ordem Encontrada</td></tr>';
                        return;
                    }
                    data.data.forEach((ordem) => {
                        const tr = document.createElement("tr");
                        const formatDate = (dateStr) => {
                            const [year, month, day] = dateStr.split("-");
                            return `${day}/${month}/${year}`;
                        };
                        // Verifica se a ordem está atrasada considerando data e hora
                        const agora = new Date();
                        const dataEntrega = new Date(
                            `${ordem.data_de_entrega}T${ordem.hora_de_entrega}`
                        ); // Combina data e hora
                        const atrasado =
                            ordem.status !== "Entregue" &&
                            ordem.status !== "Concluido" &&
                            dataEntrega < agora;

                        tr.innerHTML = `
                            <td class="align-middle text-center">${
                                ordem.id
                            }</td>
                            <td class="align-middle text-center">${
                                ordem.cliente
                            }</td>
                            <td class="align-middle text-center" style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${
                                ordem.servico
                            }</td>
                            <td class="align-middle text-center">${
                                ordem.nome_funcionario
                            }</td>
                            <td class="align-middle text-center">${formatDate(
                                ordem.data_de_entrega
                            )} ${ordem.hora_de_entrega}</td>
                            
                            
                            <td class="align-middle">
                                <div class="d-flex flex-column align-items-center">
                                    <span class="px-3 py-2 rounded ${getStatusClass(
                                        ordem.status
                                    )} text-center w-28">
                                        ${
                                            ordem.status
                                                .charAt(0)
                                                .toUpperCase() +
                                            ordem.status.slice(1)
                                        }
                                    </span>
                                    ${
                                        atrasado
                                            ? `<span class="px-3 py-2 w-28 text-center mt-1 rounded bg-dark text-white">Atrasado</span>`
                                            : ""
                                    }
                                </div>
                            </td>
                            <td class="align-middle text-center">
                                <div class="btn-group" role="group">
                                <span class="mr-2 text-center">
                                    <a href="/admin/ordemdeservico${
                                        ordem.id
                                    }" class="btn bg-secondary text-white fs-6 w-24">Ver Mais</a>
                                </span>
                                <span>
                                    <a href="/admin/ordemdeservico${
                                        ordem.id
                                    }?print=1" type="button" class="btn bg-black text-white fs-6">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                                    </svg>
                                                    </a>
                                </span>

                                    
                                    <!-- Adiciona o botão de 'Entregar' apenas se o tipo de usuário for 'Caixa' -->
                                    ${
                                        userType === "Caixa"
                                            ? `
                                        
                                        <a href="/admin/ordemdeservico/${ordem.id}/entregar" onclick="return confirm('Você tem certeza que quer passar para entregue?')" class="mx-1 d-flex align-items-center btn bg-success text-white">Entregar</a>

                                        
                                    `
                                            : ""
                                    }
                                </div>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });

                    // Atualiza a navegação da página
                    updatePagination(data);
                })
                .catch((error) => {
                    console.error("Erro ao buscar ordens:", error);
                });
        });
    }

    function getStatusClass(status) {
        switch (status) {
            case "Pendente":
                return "bg-danger text-white";
            case "Impressão":
                return "bg-warning text-dark";
            case "Laser":
                return "backgroundColorLaser text-darkLaser";
            case "Produção":
                return "bg-primary text-white";
            case "Concluido":
                return "bg-success text-white";
            case "Entregue":
                return "bg-success text-white"; // Para ordens entregues
            default:
                return "bg-secondary text-white";
        }
    }

    function updatePagination(data) {
        // Aqui você pode adicionar a lógica para mostrar os links de paginação
        // com base nos dados de metadados retornados, como total, current_page, last_page, etc.
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search-client");
    if (searchInput) {
        searchInput.addEventListener("input", function () {
            let query = this.value;
            fetch(`/search-clientes?query=${query}`)
                .then((response) => response.json())
                .then((data) => {
                    const tbody = document.querySelector("table tbody");
                    tbody.innerHTML = ""; // Limpa a tabela
                    if (data.length === 0) {
                        tbody.innerHTML =
                            '<tr><td class="text-center" colspan="4">Nenhum cliente encontrado</td></tr>';
                        return;
                    }
                    data.forEach((cliente) => {
                        const tr = document.createElement("tr");
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
                .catch((error) => {
                    console.error("Erro ao buscar clientes:", error);
                });
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search-funcionario");
    if (searchInput) {
        searchInput.addEventListener("input", function () {
            let query = this.value;
            fetch(`/search-funcionarios?query=${query}`)
                .then((response) => response.json())
                .then((data) => {
                    const tbody = document.querySelector("table tbody");
                    tbody.innerHTML = ""; // Limpa a tabela
                    if (data.length === 0) {
                        tbody.innerHTML =
                            '<tr><td class="text-center" colspan="4">Nenhum funcionario encontrado</td></tr>';
                        return;
                    }
                    data.forEach((funcionario) => {
                        const tr = document.createElement("tr");
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
                .catch((error) => {
                    console.error("Erro ao buscar funcionarios:", error);
                });
        });
    }
});
