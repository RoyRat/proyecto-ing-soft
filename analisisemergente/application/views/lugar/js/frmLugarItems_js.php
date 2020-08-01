<script type="text/javascript">
$(function () {
    $("table.formDialog tr td.field,table.formDialog caption").addClass("ui-widget ui-widget-header");
    $("table.formDialog tr td").addClass("ui-widget ui-widget-content");
    $("table.formDialog tr td.noClass").removeClass("ui-widget ui-widget-content");
    $('input[readonly="readonly"]').addClass("readonly");
    $('input[readonly!="readonly"]').removeClass("readonly");
    $('label').each(function() {
        $(this).addClass('title');
    });
    $('.radio label').each(function() {
        $(this).removeClass('title');
    });
    $(".radio").buttonset();

    $("#jq_lugarItemsExtend").jqGrid({
            treeGrid: true,
            treeGridModel: 'adjacency',
            ExpandColumn : 'LOC_DESCRIPCION',
            url:"lugar/getLugarItems/"+<?php echo !empty($_POST['LOC_SECUENCIAL'])?$_POST['LOC_SECUENCIAL']:0; ?>,
            datatype: "json",
            colNames:["Secuencial","Descripción","Predecesor"],
            colModel:[
                {name:'LOC_SECUENCIAL',index:'LOC_SECUENCIAL',hidden:true,key: true, width:1250},
                {name:'LOC_DESCRIPCION',index:'LOC_DESCRIPCION', width:250, align:"center"},
                {name:'LOC_PREDECESOR',index:'LOC_PREDECESOR', align:"left", width:150,hidden:true}
            ],
            rowNum:10,
            rowList:[5,10,25,50,100,200,400,800,1600],
            sortname:'LOC_SECUENCIAL',
            viewrecords: true,
			height: 100,
            sortorder:'ASC',
            mtype:'POST',
            caption:'SELECCIONE EL PREDECESOR',
            altRows: true,
            pager:'#jq_p_lugarItemsExtend',
            toolbar:[true,"top"],
            autowidth: true,
            onSelectRow: function(ids){
                var fila = $("#jq_lugarItemsExtend").getRowData(ids);
                $("#LOC_PREDECESOR").val(fila.LOC_SECUENCIAL);
            }
	});
	
	$("#jq_lugarItemsExtend").jqGrid('navGrid','#jq_p_lugarItemsExtend',{del:false,add:false,edit:false,refresh:true, search: false},{},{},{},{multipleSearch:true,sopt:['cn','eq']});

});
</script>