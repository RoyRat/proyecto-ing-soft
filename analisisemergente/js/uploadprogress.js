$(function(){
    $("input#uploadedFile").bind('change', null, function(){check_file_type()});
});

function getProgress(uploadKey){
    $.post(url+"match/json_get_uploadprogress",{"upload_id":uploadKey},
    function(data)
    {
        if(!data) return;
        var result = data.result;
        var percentage = 0;
        percentage = data.percentage;
        if (percentage > 0) {
            $("#progressBar").html("<h3>Upload progress...</h3><div class='progressGrey'>"+result+"<div class='progressRed' style='width:"+percentage+"%'>"+result+"</div></div>");
        } else {
            $("#progressBar").html("<h3>Upload progress...</h3><div class='progressGrey'>"+result+"</div>");
        }
        if (percentage < 100) {
            var timeoutID = window.setTimeout("getProgress(theUploadKey)", 1000); //Se consulta cada 1 segundo
        }
        if(percentage >= 100)
        {
            $("iframe#uploadIframe").css('display','block');
            var body = $("iframe#uploadIframe").contents().find("body");
            //Remaquetamos el body del iframe por culpa de IE
            body.css('border','0px none');
            body.css('background-color',$("body").css('background-color'));
            body.css('text-align','center');
        }
    }, "json");
}

function startProgress(uploadKey) {
    theUploadKey = uploadKey;
    $("#progressBar").css('display','block');
    $("#progressBar").html("<h3>Upload progress...</h3><div class='progressGrey'> </div>");
    $("form#uploadForm").css('display','none');
    getProgress(uploadKey);
    return null;
}