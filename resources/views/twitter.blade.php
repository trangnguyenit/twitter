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
  <hr>
	
  <div class="container-fluid col-sm-6 col-sm-offset-3" id="twitters">
      
  </div>

    <!--<button id="button" class="btn btn-default" type="submit" onclick="loadMore()">Load More</button>-->
  <script>
    var count = 3;
    loadTwitters(count);
    function loadAjax() {
      // send new twiter to server using AJAX
      // Reset
      count = 3;
      document.getElementById('twitters').innerHTML = '';
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
      document.getElementById('twitters').innerHTML = '';
      
      $.ajax({
        url : "/twitter/post/load",
        type: "post",
        data: {
          'count': count + 1
        },
        beforeSend: function (xhr) {
          var token = $('meta[name="_token"]').attr('content');
          if (token) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
          }
        },
        success: function (data) {
          document.getElementById('exampleTextarea').value = '';
          var twitters = JSON.parse(data);
          console.log(twitters);

          var count_ = Math.min(count, twitters.length);
          


          for(var i = 0; i < count_; i++) {

              var pname = document.createElement('p');
              pname.innerHTML = twitters[i].userName;
              pname.setAttribute('class', 'col-sm-8');
              pname.setAttribute('style', 'color: #007fff;')
              //name
              document.getElementById('twitters').appendChild(pname);


              //time
              var ptime = document.createElement('p');
              ptime.innerHTML = twitters[i].created_at;
              ptime.setAttribute('class','small col-sm-4');
              document.getElementById('twitters').appendChild(ptime);

              //content
              var divcontent = document.createElement('div');
              divcontent.innerHTML = twitters[i].content;
              divcontent.setAttribute('class', 'col-sm-12');
              document.getElementById('twitters').appendChild(divcontent);


              var hr = document.createElement('hr');
              hr.setAttribute('style', 'margin-top: 80px; border-width: 1px 0');
              document.getElementById('twitters').appendChild(hr);

            }
          if (count < twitters.length) {
            
            var button = document.createElement('button');
            button.setAttribute('class', 'btn btn-default');
            button.setAttribute('id', 'button');
            button.setAttribute('type', 'submit');
            button.setAttribute('onclick', 'loadMore()');

            document.getElementById('twitters').appendChild(button);
            document.getElementById('button').innerHTML = 'Load More';  
          } 
        },
        error: function (err){
          console.log('loadTwitters error\n')
          console.log(err);
          document.write(err.responseText);
        }
      });

    }

    function loadMore() {
      count += 3;
      loadTwitters(count);
    }
    
  </script>
</div>
<hr>
<div id="footer" class="container">
    <div class="row text-center">
      <div class="col-sm-6 col-sm-offset-3">
        <p>Copyright &copy 2016, by trangnguyenit</p>
      </div>
    </div>
  </div>
</body>
</html>