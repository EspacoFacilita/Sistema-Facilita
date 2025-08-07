// Função para permitir apenas números no campo "usuarioId"
function somenteNumeros(event) {
    const input = event.target;
    input.value = input.value.replace(/[^0-9]/g, '');  // Substitui qualquer caractere que não seja número
    buscarUsuario(); // Chama a função de busca do nome assim que o input for alterado
}
// Função para buscar o nome do usuário via Ajax
function buscarUsuario() {
    const usuarioId = document.getElementById("usuarioId").value;
    // Verificar se o ID é um número válido
    if (!usuarioId) {
        document.getElementById("resultadoNome").value = "Digite um ID válido!";
        return;
    }
    // Usar Fetch API para fazer a requisição
    fetch(`/login/${usuarioId}`)
    .then(response => {
        // Verifica se a resposta é ok (código 2xx)
        if (!response.ok) {
            throw new Error('Usuário não encontrado!');
        }
        return response.json(); // Espera-se uma resposta JSON
    })
    .then(data => {
        console.log(data); // Exibe o JSON recebido
        document.getElementById("resultadoNome").value = data.name; // Preenche o campo com o nome
    })
    .catch(error => {
        console.log(error); // Exibe o erro completo
        document.getElementById("resultadoNome").value = error.message;
    });
}
