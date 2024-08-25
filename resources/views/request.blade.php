@include('base')

<body>
<div class="container form-control">
    <form action="/request" method="post">

        <label for="request">request:</label>
        <input type="email" id="email" name="email" />

        <button type="submit" class="btn btn-dark">Request</button>
    </form>
</div>
</body>
