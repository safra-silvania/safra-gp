this.countLoading = 0;
function loading(flag, element = "#planning-table") {
    var $el = $(element);
    if (flag === true) {
        this.countLoading += 1;
        $el.trigger("loading-overlay:show");
    } else {
        this.countLoading -= 1;
        $el.trigger("loading-overlay:hide");
    }
}

function setMasks() {
    $(".decimal").mask("000.000.000,00", { reverse: true });
    $(".short-integer").mask("000");
    $(".cpf").mask("000.000.000-00");

    var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, "").length === 11
                ? "(00) 00000-0000"
                : "(00) 0000-00009";
        },
        spOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            },
        };

    $(".phone").mask(SPMaskBehavior, spOptions);
}

function toggleSidebar() {
    let collapsed = !$("html").hasClass("sidebar-left-collapsed");

    $.ajax({
        type: "get",
        url:
            $("#sidebar-left-toggle").attr("data-target-url") + "/" + collapsed,
        success: function (result) {},
    });
}

function viewAuditLog() {
    let div = $("#audit-timeline");

    let url = $("#view-audit-log").attr("data-target-url");

    $.ajax({
        type: "get",
        url: url,
        success: function (result) {
            let list = "";
            let month = "";
            let monthIterator = "";

            $(JSON.parse(result)).each(function (index, log) {
                if (monthIterator === log.month) {
                    month = "";
                } else {
                    monthIterator = log.month;
                    month =
                        '\
                    <div class="tm-title">\
                        <h3 class="h5 text-uppercase">' +
                        moment()
                            .month(log.month - 1)
                            .format("MMMM") +
                        "</h3>\
                    </div>\
                ";
                }

                let meta = JSON.parse(log.meta);
                let datetime = new moment(log.created);
                let original = log.original ? JSON.parse(log.original) : "";
                let changed = log.changed ? JSON.parse(log.changed) : "";
                let labels = "";

                if (log.type == "create") original = "";

                switch (log.type) {
                    case "create":
                        labels =
                            '<span class="label label-primary">Inclusão</span>';
                        break;
                    case "update":
                        labels = '<span class="label label-info">Edição</span>';
                        break;
                    case "delete":
                        labels =
                            '<span class="label label-danger">Exclusão</span>';
                        break;

                    default:
                        break;
                }

                labels +=
                    '<span class="label label-primary mr-xs ml-xs">' +
                    meta.user.name +
                    "</span>";

                list +=
                    "\
                " +
                    month +
                    '\
                <ol class="tm-items">\
                    <li>\
                        <div class="tm-box">\
                            <p class="text-muted mb-none">' +
                    datetime.format("LLLL") +
                    "\
                            &nbsp;\
                            " +
                    labels +
                    '</p>\
                            <div class="row">\
                                <div class="col-lg-6"><strong><u>VALOR ORIGINAL</u></strong></div>\
                                <div class="col-lg-6"><strong><u>NOVO VALOR</u></strong></div>\
                            </div>\
                            <div class="row">\
                                <div class="col-lg-6">' +
                    JSON.stringify(original) +
                    '</div>\
                                <div class="col-lg-6">' +
                    JSON.stringify(changed) +
                    "</div>\
                            </div>\
                            <!--\
                            <p>\
                                Checkout! How cool is that!\
                            </p>\
                            -->\
                        </div>\
                    </li>\
                </ol>\
            ";
            });

            let template =
                '\
            <div class="timeline timeline-simple mt-xlg mb-md">\
                <div class="tm-body">\
                    ' +
                list +
                "\
                </div>\
            </div>\
        ";

            div.html(template);
        },
    });
}

$(document).ready(function () {
    setMasks();

    $("#view-audit-log").click(() => viewAuditLog());
    $("#sidebar-left-toggle").click(() => toggleSidebar());
});
