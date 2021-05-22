import NotificationService from "./notification-service";

const CONTROLLER = "files";

export default class FilesService {
    constructor() {}

    static getFilesByField(fieldId) {
        let baseUrl = document.getElementById("api-base-url").value;

        return new Promise(function (resolve, reject) {
            let ajaxReq = $.ajax({
                url: `${baseUrl}/${CONTROLLER}/get-files-by-field/${fieldId}.json`,
                type: "GET",
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
