$(document).ready(function(){
    var clients=$('#clients')
    clients.on('change',function(){
        //get client form filed IDs
        var client_company_name=$('#client_company_name'),
            client_email=$('#client_email'),
            client_email_hidden=$('#client_email_hidden'),
            client_full_name=$('#client_full_name'),
            client_phone=$('#client_phone'),
            client_id=$('#client_id'),
            client_link=$('#client-link'),
            client_div=$('#client-div');
            submit=$('#submit');


        if(!clients.val()){//if click on select
            client_div.hide();
            client_full_name.text('');
            client_email.text('');
            client_email_hidden.val('');
            client_phone.text('');
            client_company_name.text('');
            client_id.val('');

            client_link.removeAttr('href');
            client_link.attr('title','Select Client before clicking here');
            submit.attr('disabled','disabled');
        }else{
            //set client form data when if select a valid client
            submit.removeAttr('disabled');
            var clients_array=clients.val().split('_');
            client_id.val(clients_array[0]);
            client_full_name.text(clients_array[1]);
            client_email.text(clients_array[2]);
            client_email_hidden.val(clients_array[2]);
            client_phone.text(clients_array[3]);
            client_company_name.text(clients_array[4]);
            client_link.attr({'href':'/client/show/'+clients_array[0],'title':'Click to view this client full details'});
            //client_link.attr('title','Click to view this client full details');
            client_div.show();

        }
    });

});
function showConfirm(){
    return confirm('Are you sure you want to delete this invoice?')
}