const CONTROLLER = "users";

export default class UsersService {
    constructor() {}

    static tryLogin(formData) {
        let baseUrl = document.getElementById("api-base-url").value;

        return new Promise(function (resolve, reject) {
            let ajaxReq = $.ajax({
                url: `${baseUrl}/${CONTROLLER}/try-login.json`,
                type: "POST",
                data: formData,
                crossDomain: true,
                dataType: "json",
                beforeSend: function () {
                    loading(true, "#planning-table");
                },
                success: function (response) {
                    resolve(response.data);
                },
                error: function (data) {
                    let message = data.responseJSON
                        ? data.responseJSON
                        : data.message;
                    NotificationService.error(message);
                    reject(data);
                },
                complete: function () {
                    loading(false, "#planning-table");
                },
            });
        });
    }
}
