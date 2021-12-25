$(document).ready(function () {

    jQuery('.ls-modal').on('click', function (e) {
        e.preventDefault();
        jQuery('#myModal').modal('show').find('.modal-body').load(jQuery(this).attr('href'));
    });

    $('.datepicker').datepicker(
        {
            format: 'dd-M-yyyy',
            autoclose: true
        }
    );

    $('#myTable').DataTable();

    $('.js-example-basic-multiple').select2();

    //$('#htmltextarea').summernote();


    $('.btn-day7').on('click', function(e) {
        $("#fromdate").datepicker().datepicker("setDate", new Date());
        var currDate = new Date($('#fromdate').datepicker('getDate'));
        currDate.setDate(currDate.getDate() + 7);
        $('#uptodate').datepicker('setDate', currDate);
    });

    $('.btn-day30').on('click', function(e) {
        $("#fromdate").datepicker().datepicker("setDate", new Date());
        var currDate = new Date($('#fromdate').datepicker('getDate'));
        currDate.setDate(currDate.getDate() + 30);
        $('#uptodate').datepicker('setDate', currDate);
    });

    $('.btn-day90').on('click', function(e) {
        $("#fromdate").datepicker().datepicker("setDate", new Date());
        var currDate = new Date($('#fromdate').datepicker('getDate'));
        currDate.setDate(currDate.getDate() + 90);
        $('#uptodate').datepicker('setDate', currDate);
    });


    //$("#e1").select2();
    $("#c1").click(function(){
        if($("#c1").is(':checked') ){
            $("#a1 > option").prop("selected","selected");
            $("#a1").trigger("change");
        }else{
            $("#a1 > option").removeAttr("selected");
            $("#a1").trigger("change");
        }
    });

    $("#c2").click(function(){
        if($("#c2").is(':checked') ){
            $("#a2 > option").prop("selected","selected");
            $("#a2").trigger("change");
        }else{
            $("#a2 > option").removeAttr("selected");
            $("#a2").trigger("change");
        }
    });

    $("#c3").click(function(){
        if($("#c3").is(':checked') ){
            $("#a3 > option").prop("selected","selected");
            $("#a3").trigger("change");
        }else{
            $("#a3 > option").removeAttr("selected");
            $("#a3").trigger("change");
        }
    });

    $('#htmltextarea1').wysihtml5();
    $('#htmltextarea2').wysihtml5();
    $('#htmltextarea3').wysihtml5();
    $('#htmltextarea4').wysihtml5();
    $('#htmltextarea5').wysihtml5();




});