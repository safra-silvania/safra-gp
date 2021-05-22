import FilesService from "../../services/files-service";

class SketchesIndex {
    constructor() {
        this.api = $("#api-base-url").val();
        this.fieldId = $("#field_id").val();

        this.setupUpload();
    }

    async setupUpload() {
        let files = await FilesService.getFilesByField(this.fieldId);
        let thumbs = [];
        let urls = [];

        $(files).each((index, file) => {
            let url = `${file.path}/${file.hash}.${file.extension}`;
            console.log(url);

            urls.push(url);

            thumbs.push({
                caption: file.name,
                url: `${this.api}/sketches/delete_file/${file.id}`,
                downloadUrl: url,
                width: "120px",
                key: file.id,
            });
        });

        $("#file-upload")
            .fileinput({
                language: "pt-BR",
                uploadUrl: `${this.api}/sketches/upload/${this.fieldId}`,
                showRemove: false,
                // uploadAsync: false,
                showUpload: true,
                showCaption: false,
                allowedFileTypes: ["image", "pdf"],
                previewFileType: "image",
                fileActionSettings: {
                    showUpload: false,
                    showDownload: true,
                    showRemove: true,
                    showDrag: false,
                },

                //load images, on edit mode
                initialPreviewAsData: true,
                overwriteInitial: false,
                initialPreview: urls,
                initialPreviewConfig: thumbs,
            })
            .on("filebatchuploadcomplete", function (
                event,
                preview,
                config,
                tags,
                extraData
            ) {
                document.location.reload();
            });
    }
}

export default SketchesIndex;

new SketchesIndex();
