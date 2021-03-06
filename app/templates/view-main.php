<?php

include_once 'GCM/db_functions.php';

$db = new DB_Functions();
$users = $db->getAllUsers();

if ($users != false)
    $no_of_users = $users->rowCount();
else
    $no_of_users = 0;

?>
<div id="main-form">

   <div id="header" class="jumbotron">
    <h2 style="color:#FFF;">Offers & Promotions<button id="view-offers-button" class="glyphicon glyphicon-menu-hamburger" ng-click="showOffers()"></button></h2>
    <h5 style="color:#ccc;">Bhagwati Holidays push notification service (<?php echo $no_of_users; ?>)</h5>



    <?php
    if ($no_of_users > 0) {
        ?>

    </div>
    <div id="main-form-container" class="jumbotron">



        <form id="msg" name="" class="form"  method="post" onsubmit="return sendPushNotification()">   

            <label class="label" >Title</label>    
            <input class="component" type="text" name="title" placeholder="Enter title here" required="required"></input>    

            <label class="label" >Description</label>           
            <textarea class="component" style="resize:vertical;" rows="3" name="message" class="txt_message" placeholder="Enter description here" required="required"></textarea>


            <label class="label" >Image URL</label>    
            <input class="component" type="text" id="image_url" name="image_url" placeholder="eg: http://www.example.com/image.jpg" required="required"></input>   


            <label class="label" >Applicable on</label> 

            <div id="type">

                <label class="radio-inline" style="position:static; pointer-events:auto; padding-left:0;">
                    <input type="checkbox" id="airticket" name="airticket" value="Airticket"/> Airticket
                </label>

                <label class="radio-inline" style="position:static; pointer-events:auto;">
                    <input type="checkbox" id="visa" name="visa" value="Visa"/> Visa
                </label>

                <label class="radio-inline" style="position:static; pointer-events:auto;">
                    <input type="checkbox" id="holiday" name="holiday" value="Holiday"/> Holiday
                </label>

            </div>

            <label class="label" >Validity</label>    
            <input class="component" type="text" name="validity" placeholder="eg: Limited" required="required"></input>   
            <input id="send-button" type="submit" class="my-button btn btn-primary" value="Send Push Notification" tabindex="-1" onclick=""/>

        </form>


    </div>
    <?php
} else { ?> 

No Users Registered Yet!

<?php } ?>

</div>

<script type="text/javascript">

function isFormValid(){
    if(isOfferImageValid() && isOfferTypeValid()){
        return true;
    }
    return false;
}

function isOfferTypeValid(){
    if($('#holiday').is(':checked') || $('#airticket').is(':checked') || $('#visa').is(':checked')){
        return true;
    }
    alert("Offer type not selected, Please select one or more.");
    return false;
}

function isOfferImageValid(){
    var value=$("#image_url").val();
    if(value.indexOf('.jpg') > -1 || value.indexOf('.JPG') > -1 || value.indexOf('.PNG') > -1 || value.indexOf('.png') > -1){
        return true;
    }
    alert("Invalid offer image.");
    return false;
}

function clearForm(){
    $('form').find("input[type=text], textarea").val("");
}

function sendPushNotification(){
    if(isFormValid())
    {
        var data = $('form#msg').serialize();
        //alert(data);
        $('form#msg').unbind('submit');                
        $.ajax({
            url: "app/templates/GCM/send_push_message.php",
            type: 'GET',
            data: data,
            beforeSend: function() {

            },
            success: function(data, textStatus, xhr) {
              alert("Push Notification Sent Successfully!");
              clearForm();
          },
          error: function(xhr, textStatus, errorThrown) {

          }
      });
        return false;
    }
}
</script>