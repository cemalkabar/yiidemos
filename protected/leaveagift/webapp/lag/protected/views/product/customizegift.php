<?php
$session=new CHttpSession;
$session->open();

/*
if(isset($upload_error))
{
if($upload_error)
 {
echo '<script>
 $(document).ready(function() {
 $("#imageUploadDialog").dialog("open"); 
  });
      </script>';
 }     
      
}
*/

?>  
  
  <!-- TinyMCE -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tiny_mce/tiny_mce.js"></script>

<!-- /TinyMCE -->




  <!-- header starts -->

      <div id="secondary-header">
                                      
                                        <div id="selected-friend" class="fb-friend-pic"><img src='https://graph.facebook.com/<?php echo Yii::app()->session['selected-userid']; ?>/picture?width=75&height=75&return_ssl_results=1' width="75" height="75" alt="FB Friend" /></div>
      <div class="title"><h1>Pick <?php echo Yii::app()->session['selected-username']?>'s Gift</h1>
</div>
                                        <div class="gift-steps">
                                          <table width="100%" border="0" cellspacing="4" cellpadding="0">
                                            <tr>
                                              <td align="right" valign="top"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/1-dot-ora.gif" width="12" height="21" alt="" /></td>
                                              <td align="left" valign="top" >1. Pick a friend</td>
                                              <td align="right" valign="top"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/2-dot-purple.gif" width="24" height="21" alt="" /></td>
                                              <td align="left" valign="top" class="gift-step-selected">2. Choose a gift</td>
                                              <td align="right" valign="top"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/2-dot-ora-A.gif" width="24" height="21" alt="" /></td>
                                              <td align="left" valign="top" >3. Spread Joy</td>
                                              <td align="left" valign="top"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/smile-ora.gif" width="32" height="21" alt="" /></td>
                                            </tr>
                                          </table>
                                        </div>
    </div>



  </div>

  <!-- header ends --> 

  
  
  <!-- content starts -->
  <div id="content">
  
  <!-- gift card starts -->
  <div id="custom-gift-card">
  <div id="card-edit-title">
   <a href='javascript:return;' onclick='loadEditTitleForm();'>Edit</a>
   </div>
  

  <div id="card-edit-name">
    <a href='javascript:return;' onclick='loadEditNameForm();'>Edit</a>
  </div>

 

  <div id="card-terms"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/terms-arrow.jpg" alt="" width="146" height="21" border="0" onclick="MM_showHideLayers('apDiv2','','show')" /></a></div>
  
  
  
  <div id="apDiv4">
    <?php
      if(isset($order))
       {
          echo "<a href='".Yii::app()->createAbsoluteUrl('product/sendgift',array('pid'=>$product->id_product,'order_id'=>$order->id_user_gift))."' >";
       }
       else
       {
          echo "<a href='".Yii::app()->createAbsoluteUrl('product/sendgift',array('pid'=>$product->id_product))."' >";
       }
     
     ?> 
      <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/btn-send-gift.jpg" alt="" width="242" height="53" border="0" />
    </a>
    

 </div>
<div id="apDiv3">
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td>
       <strong>Tips:</strong>
      <?php
        if(isset($product->tips))
        {
         echo $product->tips;
        }
      ?> 

     </td>
  </tr>
</table>

</div>

<div id="apDiv2">
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td align="right"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/close.gif" alt="" width="12" height="12" border="0" onclick="MM_showHideLayers('apDiv2','','hide')" /></a></td>
      </tr>
	  <tr>
        <td><strong>Full terms and conditions:</strong></td>
      </tr>
       <tr>
        <td><?php 
            if(isset($product->terms))
            {
                echo $product->terms;
            }
            ?>
         </td>
      </tr>
     
      </table>
</div>
<div id="custom-card-front">
  <?php 

/*	$title = null;
    if(isset($order->title))
      {
        $title=$order->title;
      }	          
    else if(isset($category->category_lang->name))
      {
	$title=$category->category_lang->name;
      }
      */
  ?>
  
  <div class="msg"><div id="title" ><?php echo $session['title']; ?></div></div>
  <div class="msg">

<?php
 

//print_r($session);
//exit;
 
 
  if(isset($session['img_url']))
  {
   $profile_pic_url=Yii::app()->params['uploaded'].$session['img_url'];
    //$sizes=getimagesize($profile_pic_url);
    $sizes=$session['img_dimension'];
  }
  else if(isset($order->img_url))
 {
   $profile_pic_url=Yii::app()->params['uploaded'].$order->img_url;
   $sizes=getimagesize($profile_pic_url);
 }
 else
  {  
    $profile_pic_url='https://graph.facebook.com/'.Yii::app()->session["selected-userid"].'/picture?width=160&height=160&return_ssl_results=1';
   
    $sizes=array(160,160);
  }
   
    $width=$sizes[0];
   $height=$sizes[1];
 // echo $profile_pic_url;
?>  


  <div class="recipient-pic"><img src='<?php echo $profile_pic_url; ?>' width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="" /></div>
  
    <div class="recipient-pic-edit"><?php echo CHtml::ajaxLink("Edit",array('gift/UploadProfilePic','pid'=>$product->id_product),array('success'=>'js:function(data){
                 $("#imageUploadDialog").dialog("open");
                 document.getElementById("upload_image").innerHTML=data;
 
                 $("#ProfilePicForm_image").bind("change", function() {
              
                   var type=this.files[0].type;
                   
                    if(type!="image/jpeg"&&type!="image/png"&&type!="image/gif"&&type!="image/bmp")
                    {
                      //alert("Sorry.Only Files having extension jpeg,png,bmp or gif are allowed.");
                        centerPopup();
                        loadPopup("Sorry.Only Files having extension jpeg,png,bmp or gif are allowed.");
                       $("#ProfilePicForm_image").val("");
                    }
                   var size=(this.files[0].size/1000000);
            
                    if(size > 10) 
                    {
                      centerPopup();
                      loadPopup("Please upload a file having size less than 10MB.");
                    // alert("Please upload a file having size less than 10MB.");
                      $("#ProfilePicForm_image").val("");
                    }
                   
                  });
                 
         }'), array('id' => 'send-link-'.uniqid())); ?> </div>

   
  </div>

  <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'imageUploadDialog',
                'options'=>array(
                    'title'=>Yii::t('job','Upload image'),
                    'autoOpen'=>false,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
      echo "<div id='upload_image'></div>";
     $this->endWidget('zii.widgets.jui.CJuiDialog');  
     
  ?>
  
  <div class="msg"><div id="name" >
                  <?php 
                    echo Yii::app()->session["selected-username"];
                  /* if(isset($order->greeting))
	             {
	              echo $order->greeting;
	             }
	             else
	             {
                      echo $session['selected-username'];
                     }*/
                  ?>
   </div></div>
</div><!-- front ends -->
  
  
  <div id="custom-card-inside">
  
 <!-- <div class="rotateDivhappy">   -->
  
  <div id="custom-card-inside-left">
  <div class="gift-corners"></div>
   <?php $this->widget("ShowProduct",array("model"=>$product)); ?>
  </div><!-- inside left ends -->
  
  
  <div id="custom-card-inside-right">
    <div class="msgEdit">
    <a href='javascript:return;' onclick='loadEditMessageForm();'>Edit</a>
   |<a href="#" onmouseover="MM_showHideLayers('apDiv3','','show')" onmouseout="MM_showHideLayers('apDiv3','','hide')">Tips</a></div>
	<?php	 
	 /*
		 $message = null;
		 
	if(isset($order->message_card))
	{
	 $message=$order->message_card;
	}
        else if(isset($category->category_lang->description))
        {
	  $message=$category->category_lang->description;
        }
        */
	?>

    <div class="msg"><div id="message" style="width:260px;height:400px;" >
    
      <?php
         if(isset($session['message']))
         {
          echo $session['message'];
         }
         else if(isset($order->message_card))
         {
           
          echo $order->message_card;
           
         }
         else
         {
                echo "Dear ".$session["selected-username"]."<br />";
                echo $category->category_lang->description;
	     
	       /* echo " <br />
	              Love,<br />";*/
 
                echo $session['me']['first_name']; 
     
         
         }
      
      ?>
       
      </div>
    </div>



  <script type="text/javascript">
/*
    function setfocus(editor_id)
                  {
                  // alert(editor_id);
                  // $('#'+editor_id).focus();
                  
                   $("#MessageForm_message").focus();
                   $("#MessageForm_message").focusout(function() {
                     editMessage();
                    });
                   
                  }  
*/
  
   function myCustomInitInstance(inst) {
      // printObject(inst);
       // alert(inst.getBody());
         var b=inst.getBody();
         //printObject(b);

          $(b).focus();

         // printObject(b);
      //  var c=inst.getBody();
         /*
         $(b).blur(function(inst) {
                           inst.preventDefault();
                           //printObject(inst);
                                     
                           //alert(inst.isDefaultPrevented);
                       // alert("ok");
                          document.getElementById("message").innerHTML='test';
                       //alert(b.outerText);
                       //editMessage();
                    }); 
           */ 
          
         /* $("#MessageForm_message").focusout(function() {
                    
                      alert("ok");
                      // editMessage();
                    });*/ 
 
        //alert("Editor: " + inst.editorId + " is now initialized.");
                  /* $("#MessageForm_message").focus();
                   $("#MessageForm_message").focusout(function() {
                     editMessage();
                    });*/
}
 
  function printObject(o) {
  var out = '';
  for (var p in o) {
    out += p + ': ' + o[p] + '\n';
  }
  alert(out);
}

  </script>
<script type="text/javascript">
var new_message;
var old_message;
$(document).ready(function() {
 old_message=document.getElementById("message").innerHTML;
 old_message=replaceNbsps(old_message);
 
// alert(old_message);
 //return;
 
  $('#message').bind('click',function(){

 loadEditMessageForm();

});



});
function replaceNbsps(str) {
  var re = new RegExp(String.fromCharCode(160), "g");
  return str.replace(re, " ");
}

function myHandleEvent(e) {
        //window.status = "event:" + e.type;
      if(e.type=='blur')
       {
        alert(e.type);
       }

        return true; // Continue handling
}

function loadEditMessageForm()
 {
  
  var data="old_message="+old_message;
     //alert(old_message);
   //return;
  $.ajax({
   type: 'GET',
    url: '<?php echo Yii::app()->createAbsoluteUrl("gift/editMessage"); ?>',
    data:data,
success:function(data){
                     
                   // alert("ok");
                     //return;
                   $('#message').unbind('click');

                   document.getElementById("message").innerHTML=data;
                   /*$("#MessageForm_message").focus();
                   /*$("#MessageForm_message").focusout(function() {
                    
                      //alert("ok");
                       editMessage();
                    });*/
                  
                   
                    tinyMCE.init({
                mode : "exact",
               elements : "MessageForm_message",
               //oninit :  "myCustomInitInstance",
             //  setupcontent_callback : "myCustomInitInstance", 
               init_instance_callback : "myCustomInitInstance",
              handle_event_callback : "myHandleEvent",
              
		theme : "simple",
              //   blur:"editMessage",
                  /*theme_advanced_disable : "bold,italic",*/
                 onchange_callback : "messageUpdated",
                 //onchange_callback : "mceTagWrap",
                 //  onkeydown_callback: "messagekeydown",
                 //onblur_callback : "editMessage", 
                /*theme_advanced_layout_manager:"SimpleLayout",
                theme_advanced_buttons1_add_before : "separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor",
                theme_advanced_resizing : true,
                theme_advanced_source_editor_width : 100,
                theme_advanced_resizing_max_width : 320,
                theme_advanced_resizing_max_height :400,
 
                theme_advanced_containers_default_align : "left",
                    

                 width : "240",
                 height : "280" 
                  */

	         });                       
                    
               // setCursorPosition("MessageForm_messaget","23");

               // alert("success:"+data); 
              },
   error: function(data) { // if error occured
         //alert("Error occured.please try again");
         //alert(data); 
        // printObject(data);
         document.getElementById("message").innerHTML=old_name;
    },

  dataType:'html'
  });

}

function mceTagWrap(element_id, html, body) {
 html = trim(html);
 /*check that text starts and ends with tags if not wrap it in <p>s.  
   This only happens for single line text messages*/
  if(html.charAt(0) != "<" || (html.charAt(html.length - 1) != ">" || html.charAt(html.length -2) == "/")) {
	html = "<p>"+html+"</p>";	
  }
 return html;
}
function trim(sInString) {
  sInString = sInString.replace( /^\s+/g, "" );// strip leading
  return sInString.replace( /\s+$/g, "" );// strip trailing
}

function strip(html)
{
   var tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent||tmp.innerText;
}

function editMessage()
 {
  //return;
  
   var data=$("#message-form-edit_message-form").serialize();
    new_message=document.getElementById("MessageForm_message").value;
   if(new_message==""||new_message=="<p><br data-mce-bogus=\"1\"></p>")
    {
     alert("message cannot be blank.");
     return;
    }
   
    var x = new_message;
    var xArray = [];
    x = x.replace(/\n/g,"<br>");
    x = x.replace(/\r/g,"<br>");
    var xArray = x.split("<br>");
   
   var len = xArray.length-1;
   
  //alert(new_message);
    var m=strip(new_message);
   
   var l=m.length;
    l+=len;
  // alert(m);
   
    //alert("no.of newlines:"+len+"\n no.of chars:"+l);
   // alert("no.of chars:"+new_message.length);
   // return;
    if(len>5)
    {
    // alert("Sorry.Max. 5 lines are allowed.");
       centerPopup();
       loadPopup("Sorry.You have exceeded the input limit");
     return;
    }

    if(len==5)
    {
     if(l>150)
      {
        centerPopup();
       loadPopup("Sorry.You have exceeded the input limit");
        //alert("Sorry.You have exceeded the input limit");
        return;
      }
    }
    
    if(len==4)
    {
     if(l>150)
      {
        centerPopup();
       loadPopup("Sorry.You have exceeded the input limit");
       // alert("Sorry.You have exceeded the input limit");
        return;
      }
    }

   if(len==3)
    {
     if(l>175)
      {
         centerPopup();
         loadPopup("Sorry.You have exceeded the input limit");
        //alert("Sorry.You have exceeded the input limit");
        return;
      }
    } 
    if(len==2)
    {
     if(l>200)
      {
         centerPopup();
         loadPopup("Sorry.You have exceeded the input limit");
        //alert("Sorry.You have exceeded the input limit");
        return;
      }
    } 
    if(len==1)
    {
     if(l>225)
      {
        centerPopup();
        loadPopup("Sorry.You have exceeded the input limit");
        //alert("Sorry.You have exceeded the input limit");
        return;
      }
    } 
   if(len==0)
    {
     if(l>250)
      {
        centerPopup();
        loadPopup("Sorry.You have exceeded the input limit");
        //alert("Sorry.You have exceeded the input limit");
        return;
      }
    } 
    
    
    
   /*
  var lines = new_message.split(/\r|\r\n|\n/);
  alert("l:"+lines.length);
     */
     //alert(new_message);
     //return;
     
       document.getElementById("message").innerHTML=new_message;
      //return;
 
   
     //return;
   //$("#message").html(new_message);
  
   //
     //return;

  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("gift/editMessage"); ?>',
   data:data,
success:function(data){

                old_message=document.getElementById("message").innerHTML;
                 // alert(data);
                 $('#message').bind('click',function(){        
                  loadEditMessageForm(); 
                  });
                //alert("success:"+data); 
              },
   error: function(data) { // if error occured
    
          centerPopup();
          loadPopup("Error occured.please try again");
        // alert("Error occured.please try again");
         document.getElementById("message").innerHTML=old_message;
    },

  dataType:'html'
  });

}

function cancelEditMessage()
{
 document.getElementById("message").innerHTML=old_message;
}

function setCursorPosition(element, pos)
  {
                //IE support
                if (element.setSelectionRange) {
                   
                    element.focus();
                    element.setSelectionRange(pos, pos);
                   
                } else if (element.createTextRange) {
                   
                    var range = element.createTextRange();
                    range.collapse(true);
                    range.moveEnd('character', pos);
                    range.moveStart('character', pos);
                    range.select();
                   
                }
                
  }              

function messageUpdated(inst) {
  
  //if(window.event.keyCode==13)
   {
   //alert("ok");
   }
    //if(inst.getBody().innerHTML=="")
     //return;
document.getElementById("MessageForm_message").value=inst.getBody().innerHTML;
//alert(document.getElementById("MessageForm_message").value);
  
}



 /*
     var keynum, lines = 1;

      function limitLines(obj, e) {
        // IE
        if(window.event) {
          keynum = e.keyCode;
        // Netscape/Firefox/Opera
        } else if(e.which) {
          keynum = e.which;
        }

        if(keynum == 13) {
          if(lines == obj.rows) {
            alert();
            return false;
          }else{
            lines++;
          }
        }
      }

   */   
</script>

    <div class="terms"></div>
  </div> <!-- inside right ends -->
  
  
  
  
  </div> <!-- inside ends -->
  
  
  
  
  
  </div>   <!-- gift card ends -->
  
  
  
  
  
<!--    <div id="apDiv1">
    
   			<a href="send-gift.html">
            <div class="gift-card-frame">
						<div class="free"><img src="images/gift-free.png" border="0" width="50" height="22" alt="" /></div>
                        <div class="picture"><img src="images/gift-01.png" alt="" width="199" height="138" border="0" /></div>
                        <div class="price"><span class="WebRupee">Rs.</span> 25.00</div>
                        <div class="description"><strong>online gift - E-Cash</strong>Barclay's Bin...Ready, Set, Sip. Wine delivery direct to your door.</div>
                        <div class="brand"><img src="images/brand-01.gif" alt="" width="100" height="22" border="0" /></div>
                        <div class="button">Send it now for free</div>
    
   				 </div>
                 </a>   
     
                 
  
  
    </div> -->
  <!-- ap div ends -->
  
  
  </div>
  <!-- content ends --> 

<script type="text/javascript">
var old_title;
$(document).ready(function() {
 old_title=document.getElementById("title").innerHTML;

 $('#title').bind('click',function(){

 loadEditTitleForm();

});

});

function editTitle()
 {
   var data=$("#title-form-edit_title-form").serialize();
   var new_title=document.getElementById("TitleForm_title").value;
   if(new_title=="")
    {
    // alert("Title cannot be blank.");
     //return;
     
               centerPopup();
		//load popup
		loadPopup("Title cannot be blank.");
		return;
     
    }
    if(new_title.length>35)
    {
    // alert("Sorry.Max. character limit for title is 35.");
                centerPopup();
		 loadPopup("Sorry.Max. character limit for title is 35.");
     return;
    }
    
   document.getElementById("title").innerHTML=new_title;

  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("gift/editTitle"); ?>',
   data:data,
success:function(data){
                 $('#title').bind('click',function(){
                   loadEditTitleForm();
                  });
                //alert("success:"+data); 
              },
   error: function(data) { // if error occured
                centerPopup();
		 loadPopup("Error occured.please try again");
        // alert("Error occured.please try again");
         document.getElementById("title").innerHTML=old_title;
    },

  dataType:'html'
  });


}
function loadEditTitleForm()
 {
  
  var data="old_title="+old_title;

  $.ajax({
   type: 'GET',
    url: '<?php echo Yii::app()->createAbsoluteUrl("gift/editTitle"); ?>',
    data:data,
success:function(data){

                   $('#title').unbind('click');
                   document.getElementById("title").innerHTML=data;
                  
                   $("#TitleForm_title").focus();
                   $("#TitleForm_title").focusout(function() {
                     editTitle();
                    });

               // alert("success:"+data); 
              },
   error: function(data) { // if error occured
         //alert("Error occured.please try again");
         //alert(data); 
        // printObject(data);
         document.getElementById("title").innerHTML=old_title;
    },

  dataType:'html'
  });

}
function cancelEditTitle()
{
 document.getElementById("title").innerHTML=old_title;
}

</script>

<script type="text/javascript">
var old_name;
$(document).ready(function() {
 old_name=document.getElementById("name").innerHTML;

 $('#name').bind('click',function(){

 loadEditNameForm();

});

});

function editName()
 {
   
   var data=$("#name-form-edit_name-form").serialize();
   var new_name=document.getElementById("NameForm_name").value;
    if(new_name=="")
    {
     //alert("Name cannot be blank");
      centerPopup();
      loadPopup("Name cannot be blank");
     return;
    }
    
    if(new_name.length>15)
    {
     //alert("Sorry.Max. character limit for name is 15.");
      centerPopup();
      loadPopup("Sorry.Max. character limit for name is 15.");
     return;
    }
   
 
   
   document.getElementById("name").innerHTML=new_name;

  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("gift/editName"); ?>',
   data:data,
success:function(data){
                  $('#name').bind('click',function(){
                   loadEditNameForm();
                  });
               // alert("success:"+data); 
              },
   error: function(data) { // if error occured
         alert("Error occured.please try again");
         document.getElementById("name").innerHTML=old_name;
    },

  dataType:'html'
  });

}



function loadEditNameForm()
 {
  
  var data="old_name="+old_name;

  $.ajax({
   type: 'GET',
    url: '<?php echo Yii::app()->createAbsoluteUrl("gift/editName"); ?>',
    data:data,
success:function(data){
                     
                   $('#name').unbind('click');

                   document.getElementById("name").innerHTML=data;
                  
                   $("#NameForm_name").focus();
                  /* $("#NameForm_name").focusout(function() {
                     editName();
                    });*/

               // alert("success:"+data); 
              },
   error: function(data) { // if error occured
         //alert("Error occured.please try again");
         //alert(data); 
        // printObject(data);
         document.getElementById("name").innerHTML=old_name;
    },

  dataType:'html'
  });

}
function cancelEditName()
{
 document.getElementById("name").innerHTML=old_name;
}

</script>

<script>
/*
$('#ProfilePicForm_image').bind('change', function() {

 alert("ok");
  //this.files[0].size gets the size of your file.
 // alert(this.files[0].size);

});
*/
</script>
  


