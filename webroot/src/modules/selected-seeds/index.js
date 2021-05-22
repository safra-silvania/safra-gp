import SelectedSeedsService from "../../services/selected-seeds-service.js";
import * as Consts from "../../consts.js";

class SelectedSeedsIndex {
    constructor() {
        this.listeners();
    }

    listeners() {
        let self = this;
        $(document).on("click", ".checked-seed", function () {
            let seedId = $(this).val();
            if (this.checked) {
                self.select(seedId);
            } else {
                self.unselect(seedId);
            }
        });

        var $table = $("#selected-seeds");
        $table.dataTable({
            bProcessing: true,
            sAjaxSource: $table.attr("data-url"),
            columns: [
                { data: "checkbox" },
                { data: "id" },
                { data: "note" },
                { data: "culture.name" },
                { data: "variety.name" },
                { data: "technology.name" },
                { data: "maturation_group" },
                { data: "cycle_days" },
                { data: "fertility" },
                { data: "resistency" },
                { data: "population" },
                { data: "city.name" },
                { data: "zoning_region.name" },
                { data: "supplier" },
            ],
            columnDefs: [
                {
                    targets: 0,
                    className: "text-middle text-center",
                    title: "&nbsp;",
                    orderable: false,
                    render: function (data, type, full, meta) {
                        let isChecked =
                            full.selected_seeds != null &&
                            full.selected_seeds.length > 0;

                        let checked = isChecked ? 'checked="checked"' : "";

                        return `<input type="checkbox" ${checked} class="checked-seed" name="seeds[]" value="${full.id}" />`;
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
                        return `<span class="${full.seed_note.class}">${full.seed_note.name}</span>`;
                    },
                },
                {
                    targets: 7,
                    title: "Ciclo (dias)",
                    orderable: true,
                    render: function (data, type, full, meta) {
                        return `${full.cycle_days} ${full.cycle.name}`;
                    },
                },
                {
                    targets: 8,
                    title: "Fertilidade(s)",
                    orderable: true,
                    render: function (data, type, full, meta) {
                        let fertilidades = "";
                        full.fertilities.map(
                            (f) => (fertilidades += `${f.name}, `)
                        );
                        return fertilidades.substr(0, fertilidades.length - 2);
                    },
                },
                {
                    targets: 13,
                    title: "Fornecedor",
                    orderable: true,
                    render: function (data, type, full, meta) {
                        if (full.supplier && full.supplier.name)
                            return `${full.supplier.name}`;
                        else return ``;
                    },
                },
                {
                    targets: 14,
                    title: "Observações",
                    orderable: true,
                    render: function (data, type, full, meta) {
                        return `<blockquote>${full.observations}</blockquote>`;
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

                $("#selected-seeds_filter input")
                    .first()
                    .addClass("form-control col-md-6")
                    .attr("maxlength", 50);
            },
        });
    }

    select(seedId) {
        let planId = $("#planId").val();
        SelectedSeedsService.select(planId, seedId).then((x) => console.log(x));
    }

    unselect(seedId) {
        let planId = $("#planId").val();
        SelectedSeedsService.unselect(planId, seedId).then((x) =>
            console.log(x)
        );
    }
}

export default SelectedSeedsIndex;

new SelectedSeedsIndex();
