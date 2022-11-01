$(document).ready(function () {
    const apiUrl = 'http://sibers.local/app/api/';

    const page_size = 5;
    let page = 1;
    let sort = 'id';
    let sort_dir = 'ASC'

    const getToken = async () => {
      const token = await localStorage.getItem('token');
      return token;
    };

    const redirectToLogin = () => {
        return document.location.href = `${location.origin}/views/login.php`;
    }

    const tableRowTemplate = '<tr>' +
                        '<td>%id%</td>' +
                        '<td>%login%</td>' +
                        '<td>%name%</td>' +
                        '<td>%last_name%</td>' +
                        '<td>' +
                            '<button data-id="%id%" class="btn btn-danger delete-user-btn mr-1">Delete</button>' +
                            '<a href="view.php?user_id=%id%" class="btn btn-primary mr-1">View</a>' +
                            '<a href="update.php?user_id=%id%" class="btn btn-success">Update</a>' +
                        '</td>' +
                    '</tr>';

    const createTableTemplate = (data) => {
        let result = tableRowTemplate;
        for (const [key, value] of Object.entries(data)) {
            result = result.replaceAll(`%${key}%`, value);
        }
        return result;
    };

    const renderUsersList = async (data) => {
        $('#users-list-body').empty();
        data.forEach(elem => {
            const template = createTableTemplate(elem);
            $('#users-list-body').append(template);
        });
    };

    const renderPagination = async (pages_count) => {
        $('#pagination').empty();
        for (let i = 1; i <= pages_count; i++) {
            let paginationBtn = '';
            if (i === page) {
                paginationBtn = `<li data-page="${i}" class="page-item active"><a class="page-link" href="javascript://">${i}</a></li>`;
            } else {
                paginationBtn = `<li data-page="${i}" class="page-item"><a class="page-link" href="javascript://">${i}</a></li>`;
            }
            $('#pagination').append(paginationBtn);
        }
    }

   const getUsersList = async () => {
       const params = new URLSearchParams({
           page_size: page_size,
           page: page,
           sort: sort,
           sort_dir: sort_dir
       });

       const token = await getToken();
       if (!token) {
           return redirectToLogin();
       }

        const headers = {
            Authentication: `Bearer ${token}`
        }

       const response = await fetch(
           `${apiUrl}user/getUsers.php?${params}`,
           {headers}
           );
       const result = await response.json();

       if (result.status === 401) {
           return redirectToLogin();
       }

       return result;
   };

   const initRender = async () => {
       const { status, error, data } = await getUsersList();

       if (status === 200) {
           $('#start-loading').addClass('d-none');

           renderUsersList(data.users);
           renderPagination(data.pages_count);

           $('#user-table-cont').removeClass('d-none');
       }
   };

   initRender();

   $(document).on('click', '.delete-user-btn', async function () {
        $('.update-table').removeClass('d-none');
        const id = $(this).data('id');

       const token = await getToken();
       if (!token) {
           return redirectToLogin();
       }
       const headers = {
           Authentication: `Bearer ${token}`
       }
        const response = await fetch(
            `${apiUrl}user/deleteUser.php?user_id=${id}`,
            {headers}
        );
        const { status } = await response.json();

        if (status === 401) {
            return redirectToLogin();
        }

        if (status === 200) {
            const usersResponse = await getUsersList();
            if (usersResponse.status === 200) {
                renderUsersList(usersResponse.data.users);
                renderPagination(usersResponse.data.pages_count);
            }
        }

       $('.update-table').addClass('d-none');
   });

   $(document).on('click', '.page-item', async function () {
       $('.update-table').removeClass('d-none');

       page = $(this).data('page');
       const usersResponse = await getUsersList();
       if (usersResponse.status === 200) {
           renderUsersList(usersResponse.data.users);
           renderPagination(usersResponse.data.pages_count);
       }

       $('.update-table').addClass('d-none');
   });

   $(document).on('change', '#sort', async function () {
       $('.update-table').removeClass('d-none');

       sort = $(this).val();
       const usersResponse = await getUsersList();
       if (usersResponse.status === 200) {
           renderUsersList(usersResponse.data.users);
           renderPagination(usersResponse.data.pages_count);
       }

       $('.update-table').addClass('d-none');
   });

   $(document).on('click', '#change-sort-dir-btn', async function () {
       $('.update-table').removeClass('d-none');

       sort_dir = sort_dir === 'ASC' ? 'DESC' : 'ASC';
       const usersResponse = await getUsersList();
       if (usersResponse.status === 200) {
           renderUsersList(usersResponse.data.users);
           renderPagination(usersResponse.data.pages_count);
       }

       $('.update-table').addClass('d-none');
   });

   $(document).on('click', '#exit-btn', async function () {
       await localStorage.removeItem('token');
       return document.location.href = `${location.origin}/views/login.php`;
   });
});