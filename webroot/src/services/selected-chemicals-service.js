const CONTROLLER = "selected-chemicals";

export default class SelectedChemicalsService {
    constructor() {}

    static select(planId, chemicalId) {
        let baseUrl = document.getElementById("api-base-url").value;

        return new Promise(function (resolve, reject) {
            let ajaxReq = $.ajax({
                url: `${baseUrl}/${CONTROLLER}/select-chemical.json`,
                type: "POST",
                data: {
                    planId: planId,
                    chemicalId: chemicalId,
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

    static unselect(planId, chemicalId) {
        let baseUrl = document.getElementById("api-base-url").value;

        return new Promise(function (resolve, reject) {
            let ajaxReq = $.ajax({
                url: `${baseUrl}/${CONTROLLER}/unselect-chemical.json`,
                type: "POST",
                data: {
                    planId: planId,
                    chemicalId: chemicalId,
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
