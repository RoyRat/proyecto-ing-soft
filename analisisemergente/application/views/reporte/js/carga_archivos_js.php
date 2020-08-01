<script src="js/kendo/js/kendo.core.min.js"></script>
<script src="js/kendo/js/kendo.upload.min.js"></script>
<style type="text/css">
  #userfile,div.k-dropzone,.k-success{
    display:none;
  }
</style>
<script>
  $(document).ready(function() {
  $("#userfile").kendoUpload({
    async: {
        saveUrl: "envio/subirArchivo/<?php echo $NUMERO; ?>"
      }, 
        success: onSuccess,
        complete: onComplete, 
        error: onError,
        multiple: false, 
        showFileList: true
      });
  
    function onSuccess(e) {
      var files = e.files;
      var response = e.response;
      if(e.operation == "upload") {
        $("#itemEnv").trigger('reloadGrid');
      }
      e.preventDefault();
    }
    
    function onError(e){
      var files = e.files;
      
      if (e.operation == "upload") {
         $("#itemEnv").trigger('reloadGrid');
      }
      e.preventDefault();
    }
    
    function onComplete(e){
      var files = e.files;
      var response = e.response;
      
      if(e.operation == "upload") {
        alert("Su archivo fue subido satisfactoriamente onComplete");
      }
      e.preventDefault();
    }    
  });  
  $("#userfile").trigger("click");
</script>
