<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
Booking request,<br>
from<br>
<b>{{$fromName}}</b> {{$phone}} {{$fromEmail}}<br>
for<br> <a href="{{url('/posts/'.$post->id)}}">{{$post->name}}</a><br>
at<br>
{{$date}} {{$hours}}:{{$minutes}}

{{$mail}}

</body>
</html>