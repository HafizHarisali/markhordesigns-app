function previewImages() {

  var $preview = $('#preview').empty();
  if (this.files) $.each(this.files, readAndPreview);

  function readAndPreview(i, file) {
    
    if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
      return alert(file.name +" is not an image");
    } // else...
    
    var reader = new FileReader();

    $(reader).on("load", function() {
      $preview.append($("<img/>", {src:this.result, height:80, width:80}));
    });

    reader.readAsDataURL(file);
    
  }

}

$('#file-input').on("change", previewImages);

$(document).ready(function(){
	

	//initialize ck_editor
    var ckeditor_url = '/assets/ckeditor';

	//Select2 Inputs Start
		$('.select_2').select2();

// $("#package_title").on("input",function(){
//         setTimeout(function(){
//             $.ajax({
//               url:'http://localhost:82/markhordesigns/admin/packages/check-name',
//               type:'GET',
//               success:function(response){
//                 json_data = JSON.parse(response);
//                 $(".error_message").html(json_data.DATA);
//               },
//             });
//         },300);
// });
  }); 

$(document).ready(function() {
var max_fields = 8; //maximum input boxes allowed
var wrapper = $("#items"); //Fields wrapper
var add_button = $(".add_field_button"); //Add button ID
 
var x = 0; //initlal text box count
$(add_button).click(function(e){ //on add input button click
e.preventDefault();
if(x < max_fields){ //max input box allowed
x++; //text box increment
$(wrapper).append('<div class="form-group mt-2"><label for="offer">Package Offer:</label>' +
'<input class="form-control col-md-12" id="package_offer" type="text" placeholder=""name="package_offer[]"/>' +
'<a href="#" class="remove_field"><i class="fa fa-times"></a></div>'); //add input box
}
else{
	$(wrapper).append('<p class="text-warning">maximun limit reached</p>');
	$(add_button).attr('disabled','disabled');
}
});
 
$(wrapper).on("click",".remove_field", function(e){ //user click on remove field
e.preventDefault(); $(this).parent('div').remove(); x--;
})
});

//Toastr close button
toastr.options = {
    "closeButton": true,
    "timeOut": "0",
    "extendedTimeOut": "0"
};

//Showing data in modal for delete of package categories
$('#delete_category').click(function(){
	var url = $(this).attr('href');
	var form = $('#form').attr('action',url);
});
$('#delete_package').click(function(){
  var url = $(this).attr('href');
  var form = $('#packages_delete_form').attr('action',url);
});
//Showing data in modal for delete of portfolio item
$('#delete_portfolio').click(function(){
  var url = $(this).attr('href');
  var form = $('#portfolio_delete_form').attr('action',url);
});

//Update Status for Package Categories
$(function(){
  $("#switchery01").change(function(){
  var item=$(this);    
  if(item.is(":checked"))
  {	
      window.location.href= item.data("target") ;
      $("#formcheck").submit(); 
  }
  else
  {
     window.location.href= item.data("target");
     $("#formcheck").submit();     
  }        
 });

//Update Package Status
  $(".package_status").change(function(){
  var item=$(this);    
  if(item.is(":checked"))
  { 
      window.location.href= item.data("target") ;
      $("#package_form_status").submit(); 
  }
  else
  {
     window.location.href= item.data("target");
     $("#package_form_status").submit();     
  }        
 });
})