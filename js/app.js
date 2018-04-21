// make console.log safe to use
window.console||(console={log:function(){}});

$(document).ready(function() {
			   $("#kirimpenolakan").bind("click", function(event) {
      var keterangan = $("#keterangan").val();
     var id = $("#id_kasbon").val();
    $.post("page/pg_ajukankasbon/crud.php?op=tolakkasbon", {
            id: id,
			keterangan: keterangan
        },
        function (data, status) {
            // hide modal popup
            $("#tolakkasbon").modal("hide");
			$("#reloaded").load("cabang.php");
            // reload Users by using readRecords();
     
        }
		
		
	 
    );
});
   $("#proses_kasbon").bind("click", function(event) {
	      var id = $("#id_kasbonan").val();
      var jenis_bank = $("#jenis_bank").val();
    var atas_nama = $("#atas_nama").val();
	var no_rek = $("#no_rek").val();
	var jml_transfer = $("#jml_transfer").val().replace(".", "").replace(".", "");;
		var tgl_transfer = $("#tgl_transfer").val();
		var keterangan = $("#ket").val();
	 if(jenis_bank==''){
		 alert("Bank Tujuan Belum Diisi");
		 $("#jenis_bank").focus();
	 } else if (atas_nama==''){
		 alert("Atas Nama Masih Kosong");
		 $("#atas_nama").focus();
	 } else if (no_rek==''){
		 alert("Nomor Rekening Masih Kosong");
		 $("#no_rek").focus();
	 }else if (jml_transfer==''){
		 alert("Jumlah Transfer Masih Kosong");
		 $("#jml_transfer").focus();
	 }else if (tgl_transfer==''){
		 alert("Tanggal Transfer Masih Kosong");
		 $("#tgl_transfer").focus();
	 }else {
    $.post("page/pg_ajukankasbon/crud.php?op=proses_kasbon", {
            id: id,
			jenis_bank : jenis_bank,
			atas_nama : atas_nama,
			no_rek : no_rek,
			jml_transfer : jml_transfer,
			tgl_transfer : tgl_transfer,
			keterangan: keterangan
        },
        function (data, status) {
            // hide modal popup
            $("#proseskasbon").modal("hide");
			$("#reloaded").load("cabang.php");
            // reload Users by using readRecords();
     
        }
		
		
	 
    );
	 }
});
		

    conditionizr({
        ie8: { 
            customScript: "js/excanvas.min.js" 
        }         
    });

    //Init the genyxAdmin plugin
    $.genyxAdmin({
        fixedWidth: false,// make true if you want to use fixed widht instead of fluid version.
        customScroll: false,// Custom scroll for page. true or false 
        responsiveTablesCustomScroll: false,// custom scroll for responsive tables. true or false
        backToTop: true,//show back to top , true or false
        navigation: {
            useNavMore: true, //use arrow for hint. ture or false
            navMoreIconDown: 'i-arrow-down-2', //icon for down state.
            navMoreIconUp: 'i-arrow-up-2',//icon for up state
            rotateIcon: true//rotate icon on hover , true or false
        },
        setCurrent: {
            absoluteUrl: false, //put true if use absolute path links. example http://www.host.com/dashboard instead of /dashboard
            subDir: '' //if you put template in sub dir you need to fill here. example '/html'
        },
        collapseNavIcon: 'i-arrow-left-7', //icon for collapse navigation button
        collapseNavRestoreIcon: 'i-arrow-right-8', //icon for restore navigation button
        rememberNavState: true, //remember if menu is collapsed 
        remeberExpandedSub: true, //remeber expanded sub menu by user
        hoverDropDown: true, //set false if not want to show dropdown on hover ( click instead)
        accordionIconShow: 'i-arrow-down-2',//icon for accordion expand
        accordionIconHide: 'i-arrow-up-2'//icon for accordion hide
    });

    //Disable certain links
    $('a[href^=#]').click(function (e) {
        e.preventDefault()
    })

    //------------- Prettify code  -------------//
    window.prettyPrint && prettyPrint();

    //------------- Bootstrap tooltips -------------//
    $("[data-toggle=tooltip]").tooltip ({});
    $(".tip").tooltip ({placement: 'top'});
    $(".tipR").tooltip ({placement: 'right'});
    $(".tipB").tooltip ({placement: 'bottom'});
    $(".tipL").tooltip ({placement: 'left'});
    //--------------- Popovers ------------------//
    //using data-placement trigger
    $("a[data-toggle=popover]")
      .popover()
      .click(function(e) {
        e.preventDefault()
    });

    $('#fixedwidth').click(function() {
        $.genyxAdmin({fixedWidth: true});
    });

    //init this last don`t change
    //------------- Uniform  -------------//
    //add class .nostyle if not want uniform to style field
    //$("input, textarea, select").not('.nostyle').uniform();
    $("[type='checkbox'], [type='radio'], [type='file'], select").not('.toggle, .select2, .multiselect').uniform();
});

