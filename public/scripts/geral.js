$('#id-modal-alerta').on('show.bs.modal', function (e) {
    $('#id-modal-form').modal('hide');
});

$(document).on('click', '.render-ajax', function (e) {
    let url_action = e.currentTarget.dataset.url;
    let div_destino = e.currentTarget.dataset.div;
    let modal = e.currentTarget.dataset.modal ?? false;

    requireAjaxRender(
        {
            action: url_action, 
            div_destino: div_destino, 
            modal: modal
        }
    );
});

$(document).on('submit', '.submit-form-render-ajax', function (e) {
    e.preventDefault();

    let url_action = e.currentTarget.dataset.action;
    let div_destino = e.currentTarget.dataset.div;
    let modal = e.currentTarget.dataset.modal ?? false;
    let method = e.currentTarget.method ?? 'POST';
    let data = createPostData(e.currentTarget);

    requireAjaxRender(
        {
            action: url_action, 
            data: data,
            div_destino: div_destino, 
            modal: modal,
            method: method
        }
    );
});

$(document).on('click', '.limpar-pesquisa', function (e) {
    let btn = e.currentTarget;
    let form = btn.closest('#idFormPesquisa');
    let url_action = form.action;
    url_action = url_action.split('?')[0];

    window.location.href = url_action;
})

$(document).on('change', '.exibir-objetivos', function (e) {
    try {
        let categoria = document.getElementById('idCategoria').value;
        let conta = document.getElementById('idContaInvest').value;
        let select = document.getElementById('idObjetivo');
        let div = document.getElementById('idSelectObjetivo');

        removeOptions(select);
        div.classList.remove('d-block');
        div.classList.add('d-none');

        if (categoria != '' && conta != '') {
            if (categoria === '10 - sinal: +') {
                div.classList.remove('d-none');
                div.classList.add('d-block');

                insertOptions(select, options_obj, conta);
            }
        }
    } catch (error) {
        console.error(error);
    }
})

$(document).on('submit', '.submit-form-crud-ajax', function (e) {
    e.preventDefault();

    let url_action = e.currentTarget.dataset.action;
    let modal = e.currentTarget.dataset.modal ?? false;
    let data = createPostData(e.currentTarget);
    let redirect = e.currentTarget.dataset.redirect;
    let id_form = e.currentTarget.id;

    requireAjaxOperation({
        action: url_action, 
        data: data, 
        redirect: redirect,
        id_form: id_form,
        modal: modal
    })
});

$(document).on('click', '.obter-orcamentos', function (e) {

    let url_action = e.currentTarget.dataset.url;
    let div_destino = e.currentTarget.dataset.div;
    let post_data = new FormData();

    post_data.append('mesAnoOrigem', document.getElementById('idMesOrigem').value);

    requireAjaxRender(
        {
            action: url_action, 
            data: post_data,
            div_destino: div_destino,
            method: 'POST'
        }
    );
});