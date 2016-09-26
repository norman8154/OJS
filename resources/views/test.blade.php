<html>
<body>
<form action="/test" method="post">
    {!! csrf_field() !!}
    <input type="text" name="topicID" placeholder="topicID">
    <button type="submit">submit</button>
</form>

</body>
</html>