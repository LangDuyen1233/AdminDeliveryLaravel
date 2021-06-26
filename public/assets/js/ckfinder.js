function openPopup() {
    CKFinder.popup({
        chooseFiles: true,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                document.getElementById('url').value = file.getUrl();
            });
            finder.on('file:choose:resizedImage', function (evt) {
                document.getElementById('url').value = evt.data.resizedUrl;
            });
        }
    });
}
