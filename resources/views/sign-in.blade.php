@include('base')

<body>
{% block body %}
    <form action="{{ path('login') }}" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="_username" value="{{ last_username }}" />

        <label for="password">Password:</label>
        <input type="password" id="password" name="_password" />

        <button type="submit">login</button>
    </form>

{% endblock %}
</body>
