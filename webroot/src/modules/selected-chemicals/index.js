import SelectedChemicalsService from "../../services/selected-chemicals-service.js";
import * as Consts from "../../consts.js";

class SelectedChemicalsIndex {
    constructor() {
        this.listeners();
    }

    listeners() {
        let self = this;
        $(document).on("click", ".checked-chemical", function () {
            let chemicalId = $(this).val();
            if (this.checked) self.select(chemicalId);
            else self.unselect(chemicalId);
        });

        var $table = $("#selected-chemicals");
        $table.dataTable({
            bProcessing: true,
            sAjaxSource: $table.attr("data-url"),
            columns: [
                { data: "checkbox" },
                { data: "id" },
                { data: "note" },
                { data: "name" },
                { data: "chemical_class.name" },
                { data: "dose" },
                { data: "chemical_target.name" },
                { data: "chemical_groups" },
                { data: "application_modes" },
                { data: "cultures" },
                { data: "application_seasons" },
                { data: "supplier.name" },
                { data: "incompatibility" },
                { data: "observation" },
            ],
            columnDefs: [
                {
                    targets: 0,
                    className: "text-middle text-center",
                    title: "&nbsp;",
                    orderable: false,
                    render: function (data, type, full, meta) {
                        let isChecked =
                            full.selected_chemicals != null &&
                            full.selected_chemicals.length > 0;

                        let checked = isChecked ? 'checked="checked"' : "";

                        return `<input type="checkbox" ${checked} class="checked-chemical" name="chemicals[]" value="${full.id}" />`;
                    },
                },
                {
                    targets: 1,
                    className: "text-center note-class",
                    title: "Cód",
                    orderable: true,
                    render: function (data, type, full, meta) {
                        return `<strong>#${full.id}</strong>`;
                    },
                },
                {
                    targets: 2,
                    className: "text-center note-class",
                    title: "Nota",
                    orderable: true,
                    render: function (data, type, full, meta) {
                        return `<span class="${full.chemical_note.class}">${full.chemical_note.name}</span>`;
                    },
                },
                {
                    targets: 5,
                    className: "text-left",
                    title: "Dose",
                    orderable: true,
                    render: function (data, type, full, meta) {
                        return `${full.dose} ${full.chemical_measure_unit.initial}`;
                    },
                },
                {
                    targets: 7,
                    className: "text-left",
                    title: "Grupo",
                    orderable: true,
                    render: function (data, type, full, meta) {
                        let grupos = "";
                        full.chemical_groups.map(
                            (x) => (grupos += `${x.name} <br>`)
                        );

                        return grupos;
                    },
                },
                {
                    targets: 8,
                    className: "text-left",
                    title: "Modos de Ação",
                    orderable: true,
                    render: function (data, type, full, meta) {
                        let modos = "";
                        full.chemical_action_modes.map(
                            (x) => (modos += `${x.name} <br>`)
                        );

                        return modos;
                    },
                },
                {
                    targets: 9,
                    className: "text-left",
                    title: "Culturas",
                    orderable: true,
                    render: function (data, type, full, meta) {
                        let culturas = "";
                        full.cultures.map(
                            (x) => (culturas += `${x.name} <br>`)
                        );

                        return culturas;
                    },
                },
                {
                    targets: 10,
                    className: "text-left",
                    title: "Épocas de Aplicação",
                    orderable: true,
                    render: function (data, type, full, meta) {
                        let epocas = "";
                        full.application_seasons.map(
                            (x) => (epocas += `${x.name} <br>`)
                        );

                        return epocas;
                    },
                },
            ],
            language: Consts.DATA_TABLE_TRANSLATION,
            drawCallback: function (settings) {
                $table.find("td.note-class").each(function () {
                    if ($(this) && $(this).find("span").first()) {
                        var classe = $(this).find("span").first().attr("class");

                        $(this).addClass(classe);
                    }
                });

                $("#selected-chemicals_filter input")
                    .first()
                    .addClass("form-control col-md-6")
                    .attr("maxlength", 50);
            },
        });
    }

    select(chemicalId) {
        let planId = $("#planId").val();
        SelectedChemicalsService.select(planId, chemicalId).then((x) =>
            console.log(x)
        );
    }

    unselect(chemicalId) {
        let planId = $("#planId").val();
        SelectedChemicalsService.unselect(planId, chemicalId).then((x) =>
            console.log(x)
        );
    }
}

export default SelectedChemicalsIndex;

new SelectedChemicalsIndex();
