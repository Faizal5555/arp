<script>
var table1;
    function getLGA(state_id){
        var url = '{{ route('get_lga', [':id']) }}';
        url = url.replace(':id', state_id);
        var lga = $('#lga_id');

        $.ajax({
            dataType: 'json',
            url: url,
            success: function (resp) {
                //console.log(resp);
                lga.empty();
                $.each(resp, function (i, data) {
                    lga.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });

            }
        })
    }

    function getClassSections(class_id, destination){
        var url = '{{ route('get_class_sections', [':id']) }}';
        url = url.replace(':id', class_id);
        var section = destination ? $(destination) : $('#section_id');

        $.ajax({
            dataType: 'json',
            url: url,
            success: function (resp) {
                //console.log(resp);
                section.empty();
                $.each(resp, function (i, data) {
                    section.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });

            }
        })
    }

    function getClassSubjects(class_id){
        var url = '{{ route('get_class_subjects', [':id']) }}';
        url = url.replace(':id', class_id);
        var section = $('#section_id');
        var subject = $('#subject_id');

        $.ajax({
            dataType: 'json',
            url: url,
            success: function (resp) {
                console.log(resp);
                section.empty();
                subject.empty();
                $.each(resp.sections, function (i, data) {
                    section.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });
                $.each(resp.subjects, function (i, data) {
                    subject.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });

            }
        })
    }


    {{--Notifications--}}

    @if (session('pop_error'))
    pop({msg : '{{ session('pop_error') }}', type : 'error'});
    @endif

    @if (session('pop_warning'))
    pop({msg : '{{ session('pop_warning') }}', type : 'warning'});
    @endif

 @if (session('pop_success'))
    pop({msg : '{{ session('pop_success') }}', type : 'success', title: 'GREAT!!'});
    @endif

    @if (session('flash_info'))
      flash({msg : '{{ session('flash_info') }}', type : 'info'});
    @endif

    @if (session('flash_success'))
      notifySuccess({msg : '{{ session('flash_success') }}'});
    @endif

    @if (session('flash_warning'))
      notifyWarning({msg : '{{ session('flash_warning') }}'});
    @endif

     @if (session('flash_error') || session('flash_danger'))
      flash({msg : '{{ session('flash_error') ?: session('flash_danger') }}', type : 'danger'});
    @endif

    {{--End Notifications--}}

    function pop(data){
        swal({
            title: data.title ? data.title : 'Oops...',
            text: data.msg,
            icon: data.type
        });
    }

    function flash(data){
        new PNotify({
            text: data.msg,
            type: data.type,
            hide : data.type !== "danger"
        });
    }

    function confirmDelete(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this item!",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(function(willDelete){
            if (willDelete) {
             $('form#item-delete-'+id).submit();
            }
        });
    }

    function confirmReset(id) {
        swal({
            title: "Are you sure?",
            text: "This will reset this item to default state",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(function(willDelete){
            if (willDelete) {
             $('form#item-reset-'+id).submit();
            }
        });
    }
    function deleteConfirm(id,name) {
        swal({
            title: "Are you sure you want to delete this " + name +"?",
            text: "You can’t get it back once you confirm",
            icon: "error",
            buttons: {
             confirm: {
                text: "Confirm",
                value: true,
                visible: true,
                className: "primary",
                closeModal: true
            },
             cancel: {
                text: "Cancel",
                value: false,
                visible: true,
                className: "",
                closeModal: true,
             }
            },
            showCloseButton: true,
            dangerMode: true,
            imageUrl: "../../../../images/error.png",
            //instead of imageSize use imageWidth and imageHeight
            imageWidth: 600,
            imageHeight: 600,
        }).then(function(willDelete){
            if (willDelete) {
            
            $.ajax({
                           type: "DELETE",
                           url: delete_url,
                           data: {data: id},
                           dataType: "json",
                           success: function(data) {
                                
                                if(data.success == 1){
                                    notifySuccess(data.message);
                                    table1.draw();
                                    // flash({msg : data.message, type : 'success'});
                                    // setTimeout(function(){
                                    //     location.reload();
                                    // },1500);
                                }
                                else
                                {
                                    notifyWarning(data.message);
                                    // flash({msg : data.message, type : 'info'});
                                }
                           }
                        });
            }
        });
    }

    $('form#ajax-reg').on('submit', function(ev){
        ev.preventDefault();
        submitForm($(this), 'store');
        $('#ajax-reg-t-0').get(0).click();
    });

    $('form.ajax-pay').on('submit', function(ev){
        ev.preventDefault();
        submitForm($(this), 'store');

//        Retrieve IDS
        var form_id = $(this).attr('id');
        var td_amt = $('td#amt-'+form_id);
        var td_amt_paid = $('td#amt_paid-'+form_id);
        var td_bal = $('td#bal-'+form_id);
        var input = $('#val-'+form_id);

        // Get Values
        var amt = parseInt(td_amt.data('amount'));
        var amt_paid = parseInt(td_amt_paid.data('amount'));
        var amt_input = parseInt(input.val());

//        Update Values
        amt_paid = amt_paid + amt_input;
        var bal = amt - amt_paid;

        td_bal.text(''+bal);
        td_amt_paid.text(''+amt_paid).data('amount', ''+amt_paid);
        input.attr('max', bal);
        bal < 1 ? $('#'+form_id).fadeOut('slow').remove() : '';
    });

    $('form.ajax-store').on('submit', function(ev){
        ev.preventDefault();
        submitForm($(this), 'store');
        var div = $(this).data('reload');
        div ? reloadDiv(div) : '';
    });

    $('form.ajax-update').on('submit', function(ev){
        ev.preventDefault();
        submitForm($(this));
        var div = $(this).data('reload');
        div ? reloadDiv(div) : '';
    });

    $('.download-receipt').on('click', function(ev){
        ev.preventDefault();
        $.get($(this).attr('href'));
        flash({msg : '{{ 'Download in Progress' }}', type : 'info'});
    });

    function reloadDiv(div){
        var url = window.location.href;
        url = url + ' '+ div;
        $(div).load( url );
    }

    function submitForm(form, formType){
        var btn = form.find('button[type=submit]');
        disableBtn(btn);
        var ajaxOptions = {
            url:form.attr('action'),
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:new FormData(form[0])
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            resp.ok && resp.msg
               ? flash({msg:resp.msg, type:'success'})
               : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            enableBtn(btn);
            formType == 'store' ? clearForm(form) : '';
            scrollTo('body');
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){
                var errors = e.responseJSON.errors;
                displayAjaxErr(errors);
            }
           if(e.status == 500){
               displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])
           }
            if(e.status == 404){
               displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])
           }
            enableBtn(btn);
            return e.status;
        });
    }

    function disableBtn(btn){
        var btnText = btn.data('text') ? btn.data('text') : 'Submitting';
        btn.prop('disabled', true).html('<i class="icon-spinner mr-2 spinner"></i>' + btnText);
    }

    function enableBtn(btn){
        var btnText = btn.data('text') ? btn.data('text') : 'Submit Form';
        btn.prop('disabled', false).html(btnText + '<i class="icon-paperplane ml-2"></i>');
    }

    function displayAjaxErr(errors){
        $('#ajax-alert').show().html(' <div class="alert alert-danger border-0 alert-dismissible" id="ajax-msg"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button></div>');
        $.each(errors, function(k, v){
            $('#ajax-msg').append('<span><i class="icon-arrow-right5"></i> '+ v +'</span><br/>');
        });
        scrollTo('body');
    }

    function scrollTo(el){
        $('html, body').animate({
            scrollTop:$(el).offset().top
        }, 2000);
    }

    function hideAjaxAlert(){
        $('#ajax-alert').hide();
    }

    function clearForm(form){
        form.find('.select, .select-search').val([]).select2({ placeholder: 'Select...'});
        form[0].reset();
    }


    $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $( document ).ajaxError(function( event, request, settings ) {
                // notifyWarning("Something went wrong");
                // flash(msg:"Something went wrong");
            
            });
        });


        
function loadButton(element){
    var element = $(""+element+"");
    var loadStatus = element.data("loading");
    if(loadStatus == "loading"){
        element.data("loading", "normal");
        element.html(element.data("text"));
        element.prop('disabled', false);
    }else{
        element.prop('disabled', true);
        element.data("text", element.html());
        element.data("loading", "loading");
        element.html('Please Wait...');
    }
}

function add_shortcuts()
{
   var link = window.location.href;
   var name  = $('#add_shortcuts').attr('data-id');
   
  

   if(name != "")
   {

   $.ajax({
        type: "POST",
        url: "{{route('shortcut.store')}}",
        data: {
            link:link,
            name:name
        },
       
        dataType: "json",
        success: function (data) {
           
           if(data.success == 1)
           {
               location.reload();
           }else{
            flash({msg : data.message, type : 'info'});
           }
                       
        }

});
   }
  
}


/******** Common Function for input *********/
$(".decimal-only").on("keypress",function(evt)
{
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode != 46 && charCode > 31  && (charCode < 48 || charCode > 57))
     return false;

 // '.' decimal point
  if (charCode === 46) {

    // Allow only 1 decimal point
    if (($(this).val()) && ($(this).val().indexOf('.') >= 0))
      return false;
    else
      return true;
  }
  return true;
});

$(".digit-only").on("keypress",function(evt)
{
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31  && (charCode < 48 || charCode > 57))
     return false;
    if (charCode === 46) {
        return false;
    }

  return true;
});

$(".alpha-space").on('change keypress paste', function(event){

   if( event.type == 'paste'){
        var copied_text =  event.originalEvent.clipboardData.getData('text');
        var remove_special_char = copied_text.replace(/^[a-zA-Z .]+/g, "");
        $(this).val($(this).val()+remove_special_char  );
        event.preventDefault();

  }else{
        var inputValue = event.which;
        if(event.key === '.'){
            return true;
        }

        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0) ) {
              event.preventDefault();
        }
   }


});

</script>