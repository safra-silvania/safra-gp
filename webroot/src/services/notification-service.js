import Toastr from "toastr2";

import "toastr2/dist/toastr.min.css";

const options = {
    newestOnTop: false,
    progressBar: true,
    closeButton: true,
    closeEasing: "easeInBack",
    positionClass: "toast-bottom-right",
};

const toastr = new Toastr(options);

export default class NotificationService {
    static success(message, title = "Sucesso") {
        toastr.success(message, title);
    }
    static info(message, title = "Informação") {
        toastr.info(message, title);
    }
    static error(message, title = "Erro") {
        toastr.error(message, title);
    }
}
