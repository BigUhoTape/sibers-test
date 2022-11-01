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
        $('#update-user-btn').prop('href', `update.php?user_id=${user_id}`);

        const roleResponse = await fetchRoles();
        const userResponse = await fetchUser();

        if (userResponse.status === 200 && roleResponse.status === 200) {
            const index = roleResponse.data.findIndex(elem => elem.id === userResponse.data.role_id);
            if (index >= 0) {
                userResponse.data.role_id = roleResponse.data[index].keyword;
            }

            for (const [key, value] of Object.entries(userResponse.data)) {
                $(`#value-${key}`).text(value);
            }
        }

        $('#start-loading').addClass('d-none');
        $('#main-content').removeClass('d-none');
    };

    initRender();

    $(document).on('click', '#delete-user-btn', async function () {
        $('.delete-user-process').removeClass('d-none');

        const token = await getToken();
        if (!token) {
            return redirectToLogin();
        }
        const headers = {
            Authentication: `Bearer ${token}`
        }

        const response = await fetch(
            `${apiUrl}user/deleteUser.php?user_id=${user_id}`,
            {headers}
        );
        const { status } = await response.json();

        if (status === 401) {
            return redirectToLogin();
        }

        if (status === 200) {
            return document.location.href = `${location.origin}/views/index.php`;
        }

        $('.delete-user-process').addClass('d-none');
    });
});