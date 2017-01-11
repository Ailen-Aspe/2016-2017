function rowtask(description, done, id, title)
{
   return '<div class="col-lg-12">' +
          '<h4>' + id + "&nbsp;&nbsp;" + title + '</h4>' +
          '<p>'+description+' </br> Status: '+done+'</p> </div>';
}

function loadtasks(){
$("#insert").empty();
$.ajax({
    		url: 'http://127.0.0.1:5000/tasks',
    		type:"GET",
    		dataType: "json",
    		success: function(resp) {
				$("#tasks").html("");
				if (resp.status  == 'ok') {
				   for (i = 0; i < resp.count; i++)
                        {
                              description = resp.entries[i].description;
                              done = resp.entries[i].done;
                              id = resp.entries[i].id;
                              title = resp.entries[i].title;
                              $("#tasks").append(rowtask(description, done, id, title));

	                    }
				}else{
                    $("#tasks").html("");
					alert(resp.message);
				}
    		},
    		error: function (e) {
        		alert("pastilaaan error!");
   			},
            beforeSend: function (xhrObj){
            xhrObj.setRequestHeader("Authorization",
                "Basic " + btoa("ako:akolagini"));
   			}
		});
}
var ins;
function inputtask(){

    ins =  '<div class="container">'+
                  '<h3>Insert Task</h3>'+
                  '<form class="form-horizontal" role = "form" method = "post">'+
                    '<div class="form-group">'+
                       '<label class="col-sm-2 control-label">ID:</label>'+
                      '<div class="col-sm-2">'+
                        '<input class="form-control" id="id" name="id"type="text">'+
                      '</div>'+
                    '</div>'+
                 '<div class="form-group">'+
                     '<label class="col-sm-2 control-label">Title:</label>'+
                      '<div class="col-sm-10">'+
                        '<input class="form-control" id="title" name = "title" type="text">'+
                      '</div>'+
                    '</div>'+
                    '<div class="form-group">'+
                      '<label class="col-sm-2 control-label">Description:</label>'+
                      '<div class="col-sm-10">'+
                        '<input class = "form-control" id = "description" name = "description" type = "text">'+
                      '</div>'+
                    '</div>'+
                    '<div class="form-group">'+
                      '<label class="col-sm-2 control-label">Status:</label>'+
                      '<div class="col-sm-2">'+
                        '<input class = "form-control" id = "done" name = "done" type = "text">'+
                      '</div>'+
                    '</div>'+
                   /*'<div class="form-group">'+
                      '<label class="col-sm-2 control-label">Done:</label>'+
                      '<div class= "custom-forms">'+
                        '<label class="custom-control custom-radio">'+
                          '<input id="true" name="radio" type="radio" class="custom-control-input">'+
                          '<span class="custom-control-indicator"></span>'+
                          '<span class="custom-control-description">True</span>'+
                        '</label>'+
                        '<label class="custom-control custom-radio">'+
                          '<input id="false" name="radio" type="radio" class="custom-control-input">'+
                          '<span class="custom-control-indicator"></span>'+
                          '<span class="custom-control-description">False</span>'+
                        '</label>'+
                      '</div>'+
                    '</div>'+*/
                   '<button type="button" class="btn btn-primary btn-block" onclick = "addtask()">Submit</button>'+
                   '<button type="button" class="btn btn-primary btn-block" onclick = "updatetask()">Update</button>'+
                  '</form>'+
                '</div>';

    $("#tasks").empty();
    document.getElementById('insert').innerHTML = ins;

}

function updatetask{
    $.ajax({
               data: //$('form').serialize(),
               {
                    id : $('#id').val(),
                    title : $('#title').val(),
                    description : $('#description').val(),
                    done : $('#done').val()
               },
               url: 'http://127.0.0.1:5000/updatetasks',
               //url: 'http://127.0.0.1:5000/tasks/'+id+'/'+title+'/'+description+'/'+done
               type:'POST',
               dataType: 'json',
               success: function(resp) {
                     $("#insert").html("");
                     if (resp.status  == 'ok') {
                         alert("Task Updated!");
                         inputtask();
                     }else{
                           //$("#insert").html("");
                           alert(resp.message);
                     }
               },
               error: function (e) {
                    alert("tarungaaa");
               },
               beforeSend: function (xhrObj){
                xhrObj.setRequestHeader("Authorization",
                "Basic " + btoa("ako:akolagini"));
   			    }
         });
}
function addtask()
{
    /*
    var stat = 'false';
    if ((document.getElementById('tf').checked) == true){
        stat = 'true';
    }*/
    //$('button').click(function(){
    //$('form').on('submit'), function(event){
         //var id = $('#id').val();
         //var title = $('#title').val();
         //var description = $('#description').val();
         //var done = $('#done').val();
         $.ajax({
               data: //$('form').serialize(),
               {
                    id : $('#id').val(),
                    title : $('#title').val(),
                    description : $('#description').val(),
                    done : $('#done').val()
               },
               url: 'http://127.0.0.1:5000/addtasks',
               //url: 'http://127.0.0.1:5000/tasks/'+id+'/'+title+'/'+description+'/'+done
               type:'POST',
               dataType: 'json',
               success: function(resp) {
                     $("#insert").html("");
                     if (resp.status  == 'ok') {
                         alert("Task Added!");
                         inputtask();
                     }else{
                           //$("#insert").html("");
                           alert(resp.message);
                     }
               },
               error: function (e) {
                    alert("tarungaaa");
               },
               beforeSend: function (xhrObj){
                xhrObj.setRequestHeader("Authorization",
                "Basic " + btoa("ako:akolagini"));
   			    }
         });
    //};



}
