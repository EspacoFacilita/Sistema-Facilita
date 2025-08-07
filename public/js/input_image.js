document.addEventListener('DOMContentLoaded', function () {
    const layoutInput = document.getElementById('layout');
    const previewImg = document.getElementById('preview');
    const noImageMessage = document.getElementById('no-image-message');
    const removeButton = document.getElementById('removeImageButton');
    const form = document.querySelector('form');

    // Armazena o caminho original da imagem carregada
    const originalImageSrc = previewImg.src;

    // Atualiza o preview da imagem
    function updatePreview(src = '') {
        if (src) {
            previewImg.src = src;
            previewImg.style.display = 'block';
            noImageMessage.style.display = 'none';
            removeButton.style.display = 'block';
        } else {
            previewImg.src = '';
            previewImg.style.display = 'none';
            noImageMessage.style.display = 'block';
            removeButton.style.display = 'none';
        }
    }

    // Restaura a imagem original
    function restoreOriginalImage() {
        updatePreview(originalImageSrc);
        layoutInput.value = ''; // Reseta o input, pois a imagem restaurada é a original
    }

    // Função para converter DataURL para Blob
    function dataURLtoBlob(dataURL) {
        const [header, base64Data] = dataURL.split(',');
        const mime = header.match(/:(.*?);/)[1];
        const binary = atob(base64Data);
        const array = new Uint8Array(binary.length);

        for (let i = 0; i < binary.length; i++) {
            array[i] = binary.charCodeAt(i);
        }

        return new Blob([array], { type: mime });
    }

    // Preview ao carregar imagem via input
    layoutInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                updatePreview(e.target.result);
            };
            reader.readAsDataURL(file);
        } else {
            updatePreview(); // Reseta se nenhum arquivo for selecionado
        }
    });

    // Limpa a imagem e reseta o input
    removeButton.addEventListener('click', function () {
        if (confirm('Você tem certeza que deseja remover a imagem?')) {
            layoutInput.value = '';
            updatePreview();
        }
    });

    // Adiciona imagem colada (Ctrl + V) ao input e preview
    window.addEventListener('paste', function (event) {
        const items = event.clipboardData.items;
        for (let item of items) {
            if (item.type.startsWith('image')) {
                const file = item.getAsFile();
                const reader = new FileReader();

                reader.onload = function (e) {
                    updatePreview(e.target.result);

                    // Simula a adição do arquivo no input file
                    const dataTransfer = new DataTransfer();
                    const blob = dataURLtoBlob(e.target.result);
                    const simulatedFile = new File([blob], 'pasted-image.png', { type: blob.type });
                    dataTransfer.items.add(simulatedFile);
                    layoutInput.files = dataTransfer.files;
                };

                reader.readAsDataURL(file);
                break;
            }
        }
    });

    // Verifica antes de enviar o formulário
    form.addEventListener('submit', function (event) {
        if (!layoutInput.files.length && (!previewImg.src || previewImg.src === originalImageSrc)) {
            event.preventDefault();
            alert('Por favor, selecione ou cole uma imagem antes de enviar.');
        }
    });

    // Verifica se há uma imagem original para mostrar o botão "Restaurar"
    if (originalImageSrc && originalImageSrc !== window.location.href) {
        const restoreButton = document.createElement('button');
        restoreButton.type = 'button';
        restoreButton.textContent = 'Restaurar Imagem Original';
        restoreButton.className = 'btn btn-secondary ms-2';
        restoreButton.addEventListener('click', restoreOriginalImage);

        // Insere o botão ao lado do botão de remoção
        removeButton.parentNode.insertBefore(restoreButton, removeButton.nextSibling);
    }

    // Inicialização: verifica se há uma imagem carregada no preview
    if (previewImg.src && previewImg.src !== window.location.href) {
        updatePreview(previewImg.src);
    } else {
        updatePreview();
    }
});
