import * as FilePond from 'filepond';
import FilePondPluginFilePoster from 'filepond-plugin-file-poster';
import FilePondPluginImageEditor from '@pqina/filepond-plugin-image-editor';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginPdfPreview from 'filepond-plugin-pdf-preview';
import {
    openEditor,
    createDefaultImageReader,
    createDefaultImageWriter,
    processImage,
    getEditorDefaults,
} from '@pqina/pintura';
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css";

// Register the plugins with FilePond
FilePond.registerPlugin(
    FilePondPluginImageEditor,
    FilePondPluginFilePoster,
    FilePondPluginImagePreview,
    FilePondPluginPdfPreview
);

const inputElement = document.querySelector('input[type="file"]');

const pond = FilePond.create(inputElement, {
    allowReorder: true,
    filePosterMaxHeight: 256,

    imageEditor: {
        createEditor: openEditor,
        imageReader: [createDefaultImageReader],
        imageWriter: [
            createDefaultImageWriter,
            {
                targetSize: {
                    width: 384,
                },
            },
        ],
        imageProcessor: processImage,
        editorOptions: {
            ...getEditorDefaults(),
            imageCropAspectRatio: 1,
        },
    },

    server: {
        url: "/api/filepond",
        process: "/process",
        revert: "/revert",
        restore: "/restore",
        load: "/load",
    },
});

pond.on("processfile", (error, file) => {
    if (error) {
        console.error("File processing failed:", error);
        return;
    }
    const response = JSON.parse(file.serverId);
    $(".js-corp-file").val(response.id);
});
