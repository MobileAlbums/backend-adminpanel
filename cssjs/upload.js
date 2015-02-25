
    function onFileSelected(event,id) {
        var selectedFile = event.target.files[0];
        var reader = new FileReader();
        var imgtag = document.getElementById("img_"+id);

        reader.onload = function(event) {
            imgtag.src = event.target.result;
        };
        var file = selectedFile;
        name = file.name;
        size = file.size;
        type = file.type;

        if(file.name.length < 1) {
            alert("File is none");
        }
        else if(file.size > 10000000) {
            alert("File is to big");
            return;
        }
        else if((file.type != 'image/jpeg') && (file.type != 'image/png') ) {
            alert("File doesnt match png, jpg or gif");
            return;
        }
        reader.readAsDataURL(selectedFile);
    }
