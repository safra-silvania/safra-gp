class SeedsForm {
    constructor() {
        this.cycleDays = $("#cycle_days");
        this.slider = document.getElementById("periodo");

        this.output = $(".output2 b");
        this.ranges = [];
        this.listeners();
    }

    listeners() {
        $("input[name='hd-cycles']").each((index, el) => {
            this.ranges.push({
                id: $(el).attr("value"),
                name: $(el).attr("data-name"),
                start: $(el).attr("start"),
                end: $(el).attr("end"),
            });
        });

        noUiSlider.create(this.slider, {
            start: [this.cycleDays.val()],
            connect: true,
            tooltips: true,
            step: 1,
            pips: {
                mode: "range",
                density: 5,
            },
            range: {
                min: 0,
                max: 365,
            },
            format: wNumb({
                decimals: 0,
            }),
        });

        this.slider.noUiSlider.on("update", (values) => {
            var start = values[0];

            $(".panel-body input[name='cycle_days']").val(start);

            this.loadSelectedCycle();
        });
    }

    loadSelectedCycle() {
        let days = parseInt(this.cycleDays.val());

        let cycle = this.ranges.filter(
            (r) => parseInt(r.start) <= days && parseInt(r.end) >= days
        );

        if (cycle.length > 0) {
            let selectedCycle = cycle[0];
            $(".noUi-tooltip")
                .first()
                .html(`${this.cycleDays.val()} - ${selectedCycle.name}`);

            $("#cycle_id").val(selectedCycle.id);
        }
    }
}

export default SeedsForm;

new SeedsForm();
