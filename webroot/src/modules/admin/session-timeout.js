import UsersService from "../../services/users-service";

export default class SessionTimeout {
    constructor() {
        this.now = new moment($("#now").val());
        this.form = $("#form-session-timeout");

        this.form.on("submit", (e) => {
            e.preventDefault();
            this.tryLogin();
        });
    }

    tryLogin() {
        // UsersService.tryLogin(this.form.serialize());
    }

    timeOut() {
        $("#sessionTimeoutModal").modal({
            backdrop: "static",
            keyboard: false,
        });

        $("#sessionTimeoutModal").modal("toggle");
    }
}

new SessionTimeout();
