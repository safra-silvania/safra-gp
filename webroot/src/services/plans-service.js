import NotificationService from "./notification-service";

const CONTROLLER = "plans";

export default class PlansService {
    constructor() {}

    static getPlanningData(planId) {
        let baseUrl = document.getElementById("api-base-url").value;

        return new Promise(function (resolve, reject) {
            let ajaxReq = $.ajax({
                url: `${baseUrl}/${CONTROLLER}/get-planning-data/${planId}.json`,
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

    static reorder(id, index, operation) {
        let baseUrl = document.getElementById("api-base-url").value;

        return new Promise(function (resolve, reject) {
            let ajaxReq = $.ajax({
                url: `${baseUrl}/${CONTROLLER}/reorder/${id}.json`,
                type: "POST",
                data: {
                    operation: operation,
                    index: index,
                },
                crossDomain: true,
                dataType: "json",
                beforeSend: function () {
                    loading(true, "#planning-table");
                },
                success: function (response) {
                    // if (data && data.hasError) NotificationService.error(data.message);
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

    static bindDetailToSelectedSeed(planId, detailId, selectedSeedId) {
        let baseUrl = document.getElementById("api-base-url").value;

        return new Promise(function (resolve, reject) {
            let ajaxReq = $.ajax({
                url: `${baseUrl}/${CONTROLLER}/bind-detail-to-selected-seed/${planId}.json`,
                type: "POST",
                data: {
                    planId: planId,
                    detailId: detailId,
                    selectedSeedId: selectedSeedId,
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

    static updateDetailPopulation(planId, detailId, population) {
        let baseUrl = document.getElementById("api-base-url").value;

        return new Promise(function (resolve, reject) {
            let ajaxReq = $.ajax({
                url: `${baseUrl}/${CONTROLLER}/update-detail-population/${planId}.json`,
                type: "POST",
                data: {
                    planId: planId,
                    detailId: detailId,
                    population: population,
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
