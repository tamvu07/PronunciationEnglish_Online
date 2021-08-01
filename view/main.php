<?php 
  require_once("../controller/controller_get.php"); 
$t = new controller_get();

if (isset($_POST['Save_new_vocabulary']))
{
  if($_POST['Vocabulary'] != null && $_POST['Type'] != null && $_POST['Phonetic'] != null && $_POST['Translate'] != null && $_POST['Image'] != null && $_POST['Pronunciation'] != null)
  {
    $t->insert_vocabulary($_POST['Vocabulary'],$_POST['Type'],$_POST['Phonetic'],$_POST['Translate'],$_POST['Pronunciation'],$_POST['Image']);

  }else{
          echo '
          <script >
            alert("Please! The sentece form you should fill out full.");
          </script>
      ';
  }
}

// if (isset($_POST['Save_new_vocabulary']))
// {
//   if($_POST['Vocabulary'] != null && $_POST['Type'] != null && $_POST['Phonetic'] != null && $_POST['Translate'] != null && $_POST['get_text_ajack_file_mp3'] != null && $_POST['get_text_ajack_file_image'] != null && in_array(pathinfo($_POST['get_text_ajack_file_mp3'], PATHINFO_EXTENSION), array("mp3")) )
//   {
//     $t->insert_vocabulary($_POST['Vocabulary'],$_POST['Type'],$_POST['Phonetic'],$_POST['Translate'],$_POST['get_text_ajack_file_mp3'], $_POST['get_text_ajack_file_image'] );

//   }else{
//           echo '
//           <script >
//             alert("Please! The sentece form you should fill out full.");
//           </script>
//       ';
//   }
// }

if (isset($_POST['Save_repair_one_vocabulary']))
{
  if($_POST['Vocabulary_repair'] != null && $_POST['Type_repair'] != null && $_POST['Phonetic_repair'] != null && $_POST['Translate_repair'] != null && $_POST['Pronunciation_repair'] != null  && $_POST['Image_repair'] != null )
  {
    $t->update_one_vocabulary($_SESSION["VO_ID"],$_POST['Vocabulary_repair'],$_POST['Type_repair'],$_POST['Phonetic_repair'],$_POST['Translate_repair'], $_POST['Pronunciation_repair'],$_POST['Image_repair']);
  }else{
          echo '
          <script type="text/javascript">
            alert("Please! The sentece form you should fill out full.");
          </script>
      ';
  }
}

if (isset($_POST['Remove_one_vocabulary']))
{
  $t->remove_one_vocabulary($_SESSION["VO_ID"]);
}



?>



<nav class="main">
  <div class="menu_main">
    <div class="row">
      <div class="col c1">
          <h2 >Wellcome</h2> 
          <div id = "xemthem" > Show : <?php echo $t->countVocabulary() / 50 ; ?> <input type="text" id="countVocabularyUp" value=""> </div>
          <div id = "xemtatca" > Show All </div>
          <p>The manage vocabulary better for you !</p>  
      </div>
      <div class="col c2" >
           <nav>
            <form  method="post" name="form" id="form" enctype="mutipart/form-data" >
               <div id="sereach_content">
                 <input type="text" onmouseleave="" id="input_text_search" name="input_text_search"  value="<?php 
                 if(isset($_SESSION["text_current_search"]))
                 {
                    if(isset($_POST['input_text_search']))
                    {
                      if($_SESSION["text_current_search"] == $_POST['input_text_search'])
                        {
                            echo $_POST['input_text_search'];
                        }
                          else
                          {
                            echo $_POST['input_text_search'];
                          }
                    }else
                    {
                        echo $_SESSION["text_current_search"];
                    }
                 }else
                 if(empty($_POST['input_text_search']))
                 {
                    echo null;
                 }else
                 {
                    echo $_POST['input_text_search'] ;
                 }
                 ?>"placeholder="Search">
                 <button id="button_search_text" name="button_search_text"> 
                    <i class="fa fa-search" ></i>
                 </button>
                 
               </div>
             </form>
           </nav>
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> add new vocabulary </button>
      </div>

    </div>
  </div>
    <nav class="content_main_vocabulary">

<!--  ...............-->
<div class="container">
<!--   <h2>Wellcome</h2>
  <p>the manage vocabulary better for you !</p>   -->          
  <table class="table table-dark table-hover">
    <thead>
      <tr id="main_table_lable_tr">
        <th>Order</th>
        <th>Vocabulary</th>
        <th>Type</th>
        <th>Phonetic</th>
        <th>translate</th>
        <th>Pronunciation</th>
        <th>Example</th>
        <th>Setting</th>
        <th>Image</th>
      </tr>
    </thead>
    <tbody id="bodyTable">

<?php


/*start button search*/
if (isset($_POST['button_search_text']) && $_POST['input_text_search'] != null)
{
        $_SESSION["text_current_search"] = $_POST['input_text_search'];
        $result = $t->get_text_search($_POST['input_text_search']);
        /*$t->get_rows_table_vocabulary($result,10);*/
      
}

if (isset($_POST['button_search_text']) && empty($_POST['input_text_search']) )
{
    /*$_SESSION["text_current_search"] = $_POST['input_text_search'];*/
    session_destroy();
    echo '<meta http-equiv="refresh" content="0" />';
    // $t->get_id();
}
/*end button search*/
if(empty($_POST['input_text_search']))
{

  if(empty($_SESSION["text_current_search"]))
  {
    // $t->get_id();
  }else{
    $result = $t->get_text_search($_SESSION["text_current_search"]);
  }
  /*$t->help_base64_decode_encode();*/
}





?>
    </tbody>
  </table>
</div>
<!-- .............................. -->
          <?php
          /*start get one vocabulary to repair*/
          if( isset($_SESSION["VO_ID"])) /*chu y loi chua fix*/
          {
            $t->get_one_vocabulary($_SESSION["VO_ID"]);
          }
          /*end get one vocabulary to repair*/
          ?>
    </nav>
</nav>

<!-- The Modal add new vocbulary-->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

     <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">New Vocabulary</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    <!-- Modal body new vocabulary-->
    <div class="modal-body">

        <form  method="post" name="form" id="form_new_vocabulary" enctype="mutipart/form-data" >
          <div class="form-group">
            <label >Vocabulary:</label>
            <input type="text" class="form-control" id="Vocabulary" name="Vocabulary">
          </div>
          <div class="form-group">
            <label >Type:</label>
            <textarea class="form-control" rows="1" id="Type" name="Type"></textarea>
            <!-- <input type="text" class="form-control" id="Type" name="Type"> -->
          </div>
          <div class="form-group">
            <label >Phonetic:</label>
            <textarea class="form-control" rows="1" id="Phonetic" name="Phonetic"></textarea>
            <!-- <input type="text" class="form-control" id="Phonetic" name="Phonetic"> -->
          </div>
          <div class="form-group">
            <label >Translate:</label>
             <textarea class="form-control" rows="1" id="Translate" name="Translate"></textarea>
           <!--  <input type="text" class="form-control" id="Translate" name="Translate"> -->
          </div>
          <div class="form-group">
            <label >Pronunciation:</label>
            <input type="text" class="form-control" id="Pronunciation" name="Pronunciation">
          </div> 
<!--           <div class="form-group">
            <label >Pronunciation:</label>
            <input type="hidden" name="get_text_ajack_file_mp3" id="get_text_ajack_file_mp3" value="" />
            <input type='file' name='file' id='file' class='form-control' style="padding-top: 3px;padding-left: 3px;" ><br>
            <div id='preview' style="background-color: black; font-size: 18px; color: white;    border-radius: 39px; text-align: center;width: 50%;"></div>
          </div> -->
          <div class="form-group">
            <label >Image:</label>
            <input type="text" class="form-control" id="Image" name="Image">
          </div>        
<!--           <div class="form-group">
            <label >Image:</label>
            <input type="hidden" name="get_text_ajack_file_image" id="get_text_ajack_file_image" value="" />
            <input type='file' name='file_image' id='file_image' class='form-control' style="padding-top: 3px;padding-left: 3px;" ><br>
            <div id='preview_image' style="background-color: black; font-size: 18px; color: white;    border-radius: 39px; text-align: center;width: 50%;"></div>
          </div> -->
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="Save_new_vocabulary" name="Save_new_vocabulary" >Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </form>

    </div>
  </div>
</div> 
<!-- end Modal add new vocbulary-->

<!-- The Modal repair-->
<div class="modal" id="myModal2">
  <div class="modal-dialog">
    <div class="modal-content">

     <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Repair</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    <!-- Modal body -->
    <div class="modal-body">

        <form method="post" name="form" id="form" enctype="mutipart/form-data" >
          <div class="form-group">
            <label >Vocabulary:</label>
            <input type="text" class="form-control" id="Vocabulary_repair" name="Vocabulary_repair" value="<?php echo $_SESSION["1_vocabulary"] ?>">
          </div>
          <div class="form-group">
            <label >Type:</label>
             <textarea class="form-control" rows="1" id="Type_repair" name="Type_repair" value=""><?php echo $_SESSION["1_type"]  ?></textarea>
            <!-- <input type="text" class="form-control" id="Type_repair" name="Type_repair" value="<?php echo $_SESSION["1_type"] ?>"> -->
          </div>
          <div class="form-group">
            <label >Phonetic:</label>
            <textarea class="form-control" rows="1" id="Phonetic_repair" name="Phonetic_repair" value=""><?php echo $_SESSION["1_phonetic"]  ?></textarea>
            <!-- <input type="text" class="form-control" id="Phonetic_repair" name="Phonetic_repair" value="<?php echo $_SESSION["1_phonetic"] ?>"> -->
          </div>
          <div class="form-group">
            <label >Translate:</label>
            <textarea class="form-control" rows="1" id="Translate_repair" name="Translate_repair" value=""><?php echo $_SESSION["1_translate"]  ?></textarea>
            <!-- <input type="text" class="form-control" id="Translate_repair" name="Translate_repair" value="<?php echo $_SESSION["1_translate"] ?>" -->
          </div>
          <div class="form-group">
            <label >Pronunciation:</label>
 <!--            <input type="hidden" name="get_text_ajack_file_mp3_repair" id="get_text_ajack_file_mp3_repair" value="process" />
            <input type='file' name='file_repair' id='file_repair' class='form-control' ><br>
            <div id='preview_repair' style="background-color: black; font-size: 18px; color: white;    border-radius: 39px; text-align: center;width: 50%;"></div> -->

            <input type="text" class="form-control" id="Pronunciation_repair" name="Pronunciation_repair" value="<?php echo $_SESSION["1_pronunciation"] ?>">
          </div>
          <div class="form-group">
            <label >Image:</label>
            <input type="text" class="form-control" id="Image_repair" name="Image_repair" value="<?php echo $_SESSION["1_image"] ?>">
          </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="Save_repair_one_vocabulary" name="Save_repair_one_vocabulary">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </form>

    </div>
  </div>
</div>
<!-- end Modal repair-->

<!-- The Modal remove-->
<div class="modal" id="myModal3">
  <div class="modal-dialog">
    <div class="modal-content">

     <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Remove</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    <!-- Modal body -->
    <div class="modal-body">

        <form method="post" name="form" id="form" enctype="mutipart/form-data" >
          <div class="form-group">
            <label >Do you want to Remove right now !</label>
            <div><?php echo $_SESSION["text_remove_vocabulary"] ?></div> 
          </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="Remove_one_vocabulary" name="Remove_one_vocabulary">Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
      </div>

    </form>

    </div>
  </div>
</div>





<!-- end Modal remove-->
<!-- <script type="text/javascript">
  $('#file').on('change',function(){
               alert ("ok change");
            })
</script> -->


<script type="text/javascript">


$(document).ready(function () {

      var toancuc = 0 ;
// start show all
      $("#xemtatca").click(function(){

      $.ajax({
        url: 'view/showAllVocabulary.php',
        type: 'POST',
        data: {
                
              }
      })
      .done( (data) => {
        // $("#bodyTable").remove();

        $("#bodyTable").append(data);
        
        
      })
      .fail( (data) => {
        alert("error" + data);
      })
      });
// end show all

      $("#xemthem").click(function(){

//........
      toancuc = toancuc + 1;
      $.ajax({
        url: 'view/pagination.php',
        type: 'POST',
        data: {
                'page': toancuc
              }
      })
      .done( (data) => {
         // $("#countVocabularyUp").value = "ccc";
        document.getElementById("countVocabularyUp").value = toancuc;
        $("#bodyTable").append(data);
        // $("#bodyTable").remove();
      })
      .fail( (data) => {
        alert("error" + data);
      })
///,,,,,,,,,,,,,
      });


      $('#file').on('change',function(){
      var fd = new FormData();
      var files = $('#file')[0].files[0];
      fd.append('file',files);
      // AJAX request
      $.ajax({
        url: 'view/upload.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
          if(response != 0){
            if(response == 1)
            {
            // Show image preview
            $('#preview').append(
                "The file must be .mp3"
              );
            setTimeout(function(){$('#preview').html("");},2000);
            }else
            if(response == 2)
            {
            // Show image preview
            $('#preview').append(
                "The size of file is not allow ! "
              );
            setTimeout(function(){$('#preview').html("");},2000);
            }else
            if(response == 3)
            {
            // Show image preview
            $('#preview').append(
                "Erro file ! "
              );
            setTimeout(function(){$('#preview').html("");},2000);
            }else
            if(response == 4)
            {
            // Show image preview
            $('#preview').append(
                "File already exists !"
              );
            setTimeout(function(){$('#preview').html("");},2000);
            }else{
              $('#preview').append(
                  "Stored success ! "
                );
              document.getElementById('get_text_ajack_file_mp3').value= response;
                /*$('#get_text_ajack_file_mp3').html(response);*/
            }
            
          }else{
            alert('file not uploaded');
          }
        }
      });

      });
    
      $('#file_image').on('change',function(){
      var fd = new FormData();
      var file_image = $('#file_image')[0].files[0];
      fd.append('file_image',file_image);
      // AJAX request
      $.ajax({
        url: 'view/upload_file_image.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
          if(response != 0){
            if(response == 1)
            {
            // Show image preview
            $('#preview_image').append(
                "The file must be JPG or PNG or GIF or JPEG!"
              );
            setTimeout(function(){$('#preview_image').html("");},2000);
            }else
            if(response == 2)
            {
            // Show image preview
            $('#preview_image').append(
                "The size of file is not allow ! "
              );
            setTimeout(function(){$('#preview_image').html("");},2000);
            }else
            if(response == 3)
            {
            // Show image preview
            $('#preview_image').append(
                "Erro file ! "
              );
            setTimeout(function(){$('#preview_image').html("");},2000);
            }else
            if(response == 4)
            {
            // Show image preview
            $('#preview_image').append(
                "File already exists !"
              );
            setTimeout(function(){$('#preview_image').html("");},2000);
            }else{
              $('#preview_image').append(
                  "Stored success ! "
                );
              document.getElementById('get_text_ajack_file_image').value= response;
                /*$('#get_text_ajack_file_mp3').html(response);*/
            }
            
          }else{
            alert('file not uploaded');
          }
        }
      });

      });
  
});

        function mouseleave_search()
        {
            $.get(
                'controller/controller_search.php',
                "text_search=" + $('#input_text_search').val(),
                function (d) {
                  console.log(d);
                  /*console.table(d);*/
                  if(d != 0)
                  {
                    
                    document.getElementById('result_search').value= d;
                    /*alert("co du lieu" + d);*/
                    /*window.location.replace("http://localhost/Pronunciation_English/view/main.html");*/
                  }else {alert("000");}

                });
        }

   function  add_file_mp3(){


    var fd = new FormData();
    var files = $('#file')[0].files[0];
    fd.append('file',files);
    // AJAX request
    $.ajax({
      url: 'view/upload.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
        if(response != 0){
          // Show image preview
          $('#preview').append(
            "<img src='Pronunciation_English/"+response+"' width='100' height='100' style='display: inline-block;'>"
            );
        }else{
          alert('file not uploaded');
        }
      }
    });

}     
    </script>