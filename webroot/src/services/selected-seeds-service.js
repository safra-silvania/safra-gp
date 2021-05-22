const CONTROLLER = "selected-seeds";

export default class SelectedSeedsService {
    constructor() {}

    static select(planId, seedId) {
        let baseUrl = document.getElementById("api-base-url").value;

        return new Promise(function (resolve, reject) {
            let ajaxReq = $.ajax({
                url: `${baseUrl}/${CONTROLLER}/select-seed.json`,
                type: "POST",
                data: {
                    planId: planId,
                    seedId: seedId,
                },
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

    static unselect(planId, seedId) {
        let baseUrl = document.getElementById("api-base-url").value;

        return new Promise(function (resolve, reject) {
            let ajaxReq = $.ajax({
                url: `${baseUrl}/${CONTROLLER}/unselect-seed.json`,
                type: "POST",
                data: {
                    planId: planId,
                    seedId: seedId,
                },
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
