<!DOCTYPE html>
<html lang="en">
<head>
  <title>Send Msg</title>
  <meta charset="UCS-2">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
body{
  background-color: #f2f2f2;
}
.smsbox{
  margin: 200px auto;
  border: 2px solid #cbc7c7;
  border-radius: 30px;
}
  textarea#msg{
    width: 327px;
    height: 186px;
    resize: none;
}
</style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container smsbox" >
  <div align="center"><h2>Kapsystem SMS api demo with PHP</h2></div>
  <form class="form-horizontal" name="smsForm" method="post" action="send-sms.php" enctype="multipart/form-data" >
    <div class="form-group">
      <label class="control-label col-xs-6" for="email">Upload Mobile Number File:</label>
      <div class="col-xs-6">
                <input type="file" name="csvfile" id="csvfile" class="btn btn-default btn-file" required > CSV File To Upload<br />
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-xs-6" for="msg">Your SMS Msessage Text:</label>
      <div class="col-xs-6">          
         <textarea class="form-control" rows="5" id="msg" name="msg"  required></textarea>
      </div>
    </div>
     
    <div class="form-group">        
      <div class="col-xs-offset-6 col-xs-6">
        <button type="submit" class="btn btn-success" >Send SMS</button>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript" src="https://www.google.com/jsapi">
</script>
<script type="text/javascript">
    google.load("elements", "1", {
        packages: "transliteration"
    });

    function onLoad() {
        var options = {
            sourceLanguage:
                    google.elements.transliteration.LanguageCode.ENGLISH,
            destinationLanguage:
                    [google.elements.transliteration.LanguageCode.HINDI],
            shortcutKey: 'ctrl+g',
            transliterationEnabled: true
        };

        var control = new google.elements.transliteration.TransliterationControl(options);
        control.makeTransliteratable(['msg']);
    }
    google.setOnLoadCallback(onLoad);
</script>
</body>
</html>