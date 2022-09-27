$(function(){
    $(".submit").click(function(){
        const $fileUpload = $("input[type='file']");
        if (parseInt($fileUpload.get(0).files.length) !== 5){
            alert("Es müssen genau 5 Dateien hoch geladen werden!");
        }
    });
});