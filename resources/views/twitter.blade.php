<!DOCTYPE html>
<html lang="en">
<head>
  <title>Twitter</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="_token" content="{{csrf_token()}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Page 1</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="admin/logout"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
    </ul>
  </div>
</nav>
<div class="container">
	<div class="form-group">
		<label for="exampleTextarea"></label>
		<textarea class="form-control" id="exampleTextarea" rows="3" name="twitt"></textarea>
	</div>

  <button class="btn btn-default" type="submit" onclick="loadAjax()">Twitt</button>
	
  <div class="container">
      <div class="row" id="div-twitters">
        
      </div>
  </div>

    <!--<button id="button" class="btn btn-default" type="submit" onclick="loadMore()">Load More</button>-->
  <script>
    var count = 2;
    function loadAjax() {
      // send new twiter to server using AJAX
      $.ajax({
        url : "/twitter/post",
        type: "post",
        data: {
          'content': document.getElementById('exampleTextarea').value
        },
        beforeSend: function (xhr) {
          var token = $('meta[name="_token"]').attr('content');
          if (token) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
          }
        },
        success: function (data){
          loadTwitters(count);

        },
        error: function (err){
          console.log('load_ajax error\n')
          console.log(err);
        }
      });
      
    }

    function loadTwitters(count) {

      // Load data from server + render.
      $.ajax({
        url : "/twitter/post/load",
        type: "post",
        data: {
          'count': count
        },
        beforeSend: function (xhr) {
          var token = $('meta[name="_token"]').attr('content');
          if (token) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
          }
        },
        success: function (data){
          document.getElementById('exampleTextarea').value = '';
          var twitters = JSON.parse(data);
          
          document.getElementById('div-twitters').innerHTML = '';
          if (twitters.length >= count) {
            
            for(var i = 0; i < twitters.length; i++) {
              var div = document.createElement('div');
              div.innerHTML = twitters[i].content;
              div.setAttribute('class', 'col-sm-6 col-sm-offset-3');
              document.getElementById('div-twitters').appendChild(div);
              // var button = document.createElement('button');
              // button.setAttribute('class', 'btn btn-default');
            }
            var button = document.createElement('button');
            button.setAttribute('class', 'btn btn-default');
            button.setAttribute('id', 'button');
            button.setAttribute('type', 'submit');
            button.setAttribute('onclick', 'loadAjax()');

            document.getElementById('div-twitters').appendChild(button);
            document.getElementById('button').innerHTML = 'Load More';
            
          } else {
              for(var i = 0; i < twitters.length; i++) {
                var div = document.createElement('div');
                div.innerHTML = twitters[i].content;
                div.setAttribute('class', 'col-sm-6 col-sm-offset-3');
                document.getElementById('div-twitters').appendChild(div);
              }
            }
          },
            
            // var div = document.createElement('div');
            // div.innerHTML = twitters[i].content;
            //li.id = 'trang-ngo' + i;
            
            //li.setAttribute('value', '2');
            //document.getElementById('div-twitters').appendChild(div);
        error: function (err){
          console.log('loadTwitters error\n')
          console.log(err);
        }
      });

    }

    function loadMore() {
      count += 3;
      loadTwitters(count);
    }
    
  </script>
</div>
</body>
</html>