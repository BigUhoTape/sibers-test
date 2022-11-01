$(document).ready(function () {
    const apiUrl = 'http://sibers.local/app/api/';

    const url = new URL(location.href);
    const user_id = url.searchParams.get("user_id");

    const getToken = async () => {
        const token = await localStorage.getItem('token');
        return token;
    };

    const redirectToLogin = () => {
        return document.location.href = `${location.origin}/views/login.php`;
    }

    const fetchRoles = async () => {
        const token = await getToken();
        if (!token) {
            return redirectToLogin();
        }
        const headers = {
            Authentication: `Bearer ${token}`
        }

        const response = await fetch(
            `${apiUrl}role/getRoles.php`,
            {headers}
        );
        const result = await response.json();

        if (result.status === 401) {
            return redirectToLogin();
        }

        return result;
    };

    const fetchUser = async () => {
        const token = await getToken();
        if (!token) {
            return redirectToLogin();
        }
        const headers = {
            Authentication: `Bearer ${token}`
        }

        const response = await fetch(
            `${apiUrl}user/getUser.php?user_id=${user_id}`,
            {headers}
        );
        const result = await response.json();

        if (result.status === 401) {
            return redirectToLogin();
        }

        return result;
    };

    const initRender = async () => {
        const roleResponse = await fetchRoles();
        const userResponse = await fetchUser();

        if (roleResponse.status === 200 && userResponse.status === 200) {
            roleResponse.data.forEach(elem => {
                let result = null;
                if (elem.id === userResponse.data.role_id) {
                    result = `<option value="${elem.id}" selected>${elem.keyword}</option>`;
                } else {
                    result = `<option value="${elem.id}">${elem.keyword}</option>`;
                }
                $('#role_id').append(result);
            });

            for (const [key, value] of Object.entries(userResponse.data)) {
                $(`#${key}`).val(value);
            }
        }

        $('#start-loading').addClass('d-none');
        $('#update-user-cont').removeClass('d-none');
    }

    initRender();

    $(document).on('submit', 'form', async function (e) {
        e.preventDefault();
        $('.delete-user-process').removeClass('d-none');
        $('.form-group').each(function () {
            $(this).find('.form-control').removeClass('is-invalid');
            $(this).find('.form-control').attr('aria-invalid', 'false');
            $(this).find('.invalid-feedback').text('');
        });

        const data = $(this).serializeArray();
        const result = {id: user_id};

        $.map(data, function(n, i){
            result[n['name']] = n['value'];
        });

        const token = await getToken();
        if (!token) {
            return redirectToLogin();
        }

        const response = await fetch(
            `${apiUrl}user/updateUser.php`,
        {
                headers: {
                    'Content-Type': 'application/json;charset=utf-8',
                    Authentication: `Bearer ${token}`
                },
                method: 'POST',
                body: JSON.stringify(result)
            }
        );
        const res = await response.json();

        if (res.status === 200) {
            return document.location.href = `${location.origin}/views/view.php?user_id=${user_id}`;
        }

        $('.delete-user-process').addClass('d-none');

        if (res.status === 422) {
            for (const [key, value] of Object.entries(res.data)) {
                let err_input = $(`#${key}`);
                err_input.addClass('is-invalid');
                err_input.attr('aria-invalid', 'true');
                err_input.closest('div').find('.invalid-feedback').text(value);
            }
        }
    });
});