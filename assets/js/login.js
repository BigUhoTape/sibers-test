$(document).ready(function () {
    const apiUrl = 'http://sibers.local/app/api/';

    $(document).on('submit', 'form', async function (e) {
        e.preventDefault();
        $('#error-alert').addClass('d-none');
        $('.delete-user-process').removeClass('d-none');
        $('.form-group').each(function () {
            $(this).find('.form-control').removeClass('is-invalid');
            $(this).find('.form-control').attr('aria-invalid', 'false');
            $(this).find('.invalid-feedback').text('');
        });

        const data = $(this).serializeArray();
        const result = {};

        $.map(data, function(n, i){
            result[n['name']] = n['value'];
        });

        const response = await fetch(
            `${apiUrl}auth/auth.php`,
            {
                headers: {
                    'Content-Type': 'application/json;charset=utf-8',
                },
                method: 'POST',
                body: JSON.stringify(result)
            }
        );
        const res = await response.json();

        if (res.status === 200) {
            await localStorage.setItem('token', res.data);
            return document.location.href = `${location.origin}/views/index.php`;
        }

        $('.delete-user-process').addClass('d-none');

        if (res.status === 422) {
            for (const [key, value] of Object.entries(res.data)) {
                let err_input = $(`#${key}`);
                err_input.addClass('is-invalid');
                err_input.attr('aria-invalid', 'true');
                err_input.closest('div').find('.invalid-feedback').text(value);
            }
            return;
        }

        $('#error-alert').removeClass('d-none');
        $('#error-alert').text(res.error);
    });
})