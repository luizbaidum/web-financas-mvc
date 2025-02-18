function submitFormCrud() {
    let id_form = '#idform-crud';
    let action = $(id_form).attr('data-action');
    let data = createPostData($(id_form)[0]);
    let redirect = $(id_form)[0].dataset.redirect;

    requireAjaxOperation({action, id_form, data, redirect})
};

function createPostData(formulario) {
    let post_data = new FormData();

    new FormData(formulario).forEach((value, key) => {
        post_data.append(key, value);
    });
 
    return post_data;
}

$('#excluir').click(async function() {

    let action = $(this).attr('data-action');
    let data = arraySelecteds();
    let redirect = true;

    if (dados.entries().next().done) {
        modalAlerta('Atenção', 'Por favor, selecione ao menos um item para excluir.');
    } else {
        let r_confirmacao = await confirmacao();

        if (r_confirmacao)
            requireAjaxOperation({action, data, redirect})
    }
});

function confirmacao() {
    let r_confirmacao = confirm('Confirma exclusão?');
    return r_confirmacao;
}

function arraySelecteds() {

    let array_of_values = new FormData;

    let selected_selects = $('input[name="item_selecionado"]:checked').each(function () {
        array_of_values.append('itens[]', this.value)
    });

    return array_of_values;
}