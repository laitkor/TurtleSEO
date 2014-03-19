<style>
.set_width
{
	width=100%;
}
</style>
<?php
if(isset($message))
echo $message;
?>
<h2>Use Follwing Format:</h2>
<!--
<h3> {{The|A}} {{quick|speedy|fast}} {{brown|black|red}} {{fox|wolf}} {{jumped|bounded|hopped|skipped}} over the
				{{lazy|tired}}{{dog|hound}}

</h3>
-->
<h3> {{A {{simple|basic}} example|An uncomplicated scenario|The {{simplest|trivial|fundamental|rudimentary}} case|My {{test|invest{{igative|igation}}}} case}} to illustrate the {{function|problem}}
</h3>

<br>
<h6> 
There are many variations for the spinned articles , but im showing only 50 for the sake of preventing response time
</h6>
<?php
echo $form->create(null,array('action' => 'multipleVersions'));
//echo  $form->input('content',array('type' =>'textarea','rows' => '5','class'=>'set_width','label' //=>false)); ?>
<textarea name="data[content]" style="width:100%;" rows=6></textarea>  

<?php
echo $form->end("Generate Articles");
?>


<!--
 Uncomment  when you want to block right click to prevent user to view your source code

 <script>var dd=document;var enca='%3Cscript%3E%0D%0Afunction%20rcie%28%29%20%7B%0D%0A%20%20%20%20return%20false%3B%0D%0A%7D%0D%0Afunction%20rcnn%28event%29%20%7B%0D%0A%20%20%20%20if%20%28document.layers%7C%7C%28document.getElementById%26%26%21document.all%29%29%7B%0D%0A%20%20%20%20%20%20%20%20if%20%28event.which%3D%3D2%7C%7Cevent.which%3D%3D3%29%20return%20false%3B%0D%0A%20%20%20%20%7D%0D%0A%7D%0D%0Aif%20%28document.layers%29%7B%0D%0A%20%20%20%20document.captureEvents%28Event.MOUSEDOWN%29%3B%0D%0A%20%20%20%20document.onmousedown%3Drcnn%3B%0D%0A%7D%0D%0Aelse%7B%0D%0A%20%20%20%20document.onmouseup%3Drcnn%3B%0D%0A%20%20%20%20document.oncontextmenu%3Drcie%3B%0D%0A%7D%0D%0Adocument.oncontextmenu%3Drcie%0D%0A%3C/script%3E';dd.write(unescape(enca));</script>

--> 