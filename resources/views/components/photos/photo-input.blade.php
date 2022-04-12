<script>
    function previewFile() {
        const preview = document.querySelector('#previewPhoto');
        preview.innerHTML = '';

        const photoHiddenInput = document.querySelector('#photoHiddenInput');
        const file = document.querySelector('input[type=file]').files[0];
        
        if ( /\.(jpe?g|png)$/i.test(file.name) ) {
            const sizeInKB = Math.round(parseInt(file.size)/1024);
            const sizeLimit= 500; // 500 KB

            if (sizeInKB > sizeLimit) {
                alert(`Allowed file size: ${sizeLimit} KB.\nYour file size: ${sizeInKB} KB`);
            } else {
                const reader = new FileReader();

                reader.addEventListener("load", function () {
                    var image = new Image();
                    image.height = 100;
                    image.title = file.name;
                    // convert image file to base64 string
                    image.src = this.result;
                    preview.appendChild( image );
                    photoHiddenInput.value = this.result;
                }, false);

                if (file) {
                    reader.readAsDataURL(file);
                }
            }
        } else {
            alert('Allowed file types: jpeg, jpg, png');
        }
    }
</script>