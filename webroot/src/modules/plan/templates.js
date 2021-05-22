class PlanningTemplates {
    constructor() {}

    static showTable(planFieldDetails) {
        let rows = "";
        $(planFieldDetails).each((index, detail) => {
            let isFirst = index === 0;
            let isLast = index + 1 === planFieldDetails.length;

            let fieldDetail = detail.field_detail;
            let field = detail.field_detail.field;
            let culture = detail.field_detail.culture;

            let selectedSeed = detail.selected_seed || null; //optional relation
            let inputPopulation = selectedSeed
                ? (inputPopulation = `<input type="text" class="form-control input-population" maxlength="45" data-detail-id="${
                      detail.id
                  }" value="${detail.population || ""}" />`)
                : "";
            let seed = selectedSeed ? selectedSeed.seed : null;

            let up = `<button type="button" class="mr-xs mb-xs btn btn-xs btn-primary btn-up" data-index="${index}" data-id="${detail.id}"><i class="fa fa-arrow-up"></i></button>`;
            let down = `<button type="button" class="mr-xs mb-xs btn btn-xs btn-info btn-down" data-index="${index}" data-id="${detail.id}"><i class="fa fa-arrow-down"></i></button>`;

            if (isFirst) up = ``;
            if (isLast) down = ``;

            rows += `
            <tr>
              <td class="text-middle text-center" style="width: 40px; padding: 8px 4px;">
                ${up}
              </td>
              <td class="text-middle text-center" style="width: 40px; padding: 8px 4px;">
                ${down}
              </td>
              <td class="text-middle text-center">${index + 1}</td>
              <td class="text-middle text-left">${field.name}</td>
              <td class="text-middle text-center">${field.total_area} ${
                field.measure_unit.initial
            }</td>
              <td class="text-middle text-center">${culture.name}</td>
              <td class="text-middle text-center">${fieldDetail.area} ${
                fieldDetail.measure_unit.initial
            }</td>
              <td class="text-middle text-center">${
                  fieldDetail.fertility.name
              }</td>

              <!-- Select Seed -->
              <td class="text-middle text-center">
                <select class="select-seed" data-detail-id="${
                    detail.id
                }" data-selected-seed-id="${
                selectedSeed ? selectedSeed.id : null
            }">
            </select>
              </td>

              <!-- Selected Seed Data -->
              <td class="text-middle text-left">${
                  seed && seed.variety ? seed.variety.name : ""
              }</td>
              <td class="text-middle text-left">${
                  seed && seed.technology ? seed.technology.name : ""
              }</td>
              <td class="text-middle text-center">${
                  seed && seed.cycle
                      ? seed.cycle_days + "<br>" + seed.cycle.name
                      : ""
              }</td>
              <td class="text-middle text-left">
                ${inputPopulation}
              </td>
            </tr>`;
        });

        $("#planning-table").html(`
          <table class="table mb-none">
            <thead>
                <tr>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">Ordem</th>
                    <th class="text-left">Talhão</th>
                    <th class="text-center">Área Total</th>
                    <th class="text-center">Cultura</th>
                    <th class="text-center">Área</th>
                    <th class="text-center">Fertilidade</th>
                    <th class="text-center">Semente</th>
                    <th class="text-left">Variedade</th>
                    <th class="text-left">Tecnologia</th>
                    <th class="text-center">Ciclo (dias)</th>
                    <th class="text-left">População</th>
                </tr>
            </thead>
            <tbody>
              ${rows}
            </tbody>
          </table>`);
    }
}

export default PlanningTemplates;

new PlanningTemplates();
