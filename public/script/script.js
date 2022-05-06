$(document).ready(function () {
    $('#saveCreateList').click(function () {
        var nom = $('#createList').val();
        if (nom !== '') {
            $.ajax({
                url: '/list',
                type: "POST",
                data: {nom: nom},
                success: function (data) {
                    $('#list').append(`<li class="li-left-column mt-4">
                                <div class="col-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                         class="bi bi-list" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                              d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                </div>
                                <div class="col-10 list-left-column">
                                    <a href=""${$(location).attr('origin') + '/list/' + data.id}) }}"">${nom}</a>
                                </div>
                            </li>`);
                    $('#closeModal').click();
                }
            })
        }
    })


    $('#saveCreateTask').click(function () {
        var nom = $('#createTask').val();
        var listId = $('#createTask').attr("data-listId");
        if (nom !== '') {
            $.ajax({
                url: '/task',
                type: "POST",
                data: {nom: nom, listId: listId},
                success: function (data) {
                    $('#task').append(`<label>${nom}</label>`);
                    $('#closeModal2').click();
                }
            })
        }
    })


    $('#saveDelete').click(function (event) {
        event.preventDefault;

        const id = this.id
        {
            $.ajax({
                url: '/task',
                type: "POST",
                data: {nom: nom},
                success: function (data) {
                    $('#list').append(`<li>${nom}</li>`);
                }
            })
        }
    })
})