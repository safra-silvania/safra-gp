import PlanningTemplates from "./templates";
import PlansService from "../../services/plans-service";

class Planning {
    constructor() {
        this.planId = $("#planId");

        this.load();
        this.listeners();
    }

    load() {
        PlansService.getPlanningData(this.planId.val()).then(
            (planFieldDetails) => {
                PlanningTemplates.showTable(planFieldDetails);
                this.updateSeedsCombo();
            }
        );
    }

    updateSeedsCombo() {
        let selectedSeeds = $(".hdd-selected-seed").map((index, sel) => {
            return {
                id: $(sel).val(),
                label: $(sel).attr("data-label"),
                class: $(sel).attr("data-class"),
            };
        });

        $(".select-seed").each((index, input) => {
            let selectedSeedId = $(input).attr("data-selected-seed-id");

            $(input).html("<option value=''></option>");
            $(selectedSeeds).each(function () {
                let newOption = new Option(
                    `${this.label}`,
                    this.id,
                    selectedSeedId == this.id,
                    selectedSeedId == this.id
                );
                $(input).append(newOption);
            });
        });
    }

    listeners() {
        let self = this;

        $(document).on("click", ".btn-up", function () {
            let id = $(this).attr("data-id");
            let index = $(this).attr("data-index");

            $(this).trigger("blur");

            PlansService.reorder(id, index, "up").then(() => self.load());
        });

        $(document).on("click", ".btn-down", function () {
            let id = $(this).attr("data-id");
            let index = $(this).attr("data-index");

            $(this).trigger("blur");

            PlansService.reorder(id, index, "down").then(() => self.load());
        });

        $(document).on("change", ".select-seed", function () {
            let planId = self.planId.val();
            let detailId = $(this).attr("data-detail-id");
            let selectedSeedId = $(this).val();

            PlansService.bindDetailToSelectedSeed(
                planId,
                detailId,
                selectedSeedId
            ).then(() => self.load());
        });

        $(document).on("change", ".input-population", function () {
            let planId = self.planId.val();
            let detailId = $(this).attr("data-detail-id");
            let population = $(this).val();

            PlansService.updateDetailPopulation(
                planId,
                detailId,
                population
            ).then();
        });
    }
}

export default Planning;

new Planning();
