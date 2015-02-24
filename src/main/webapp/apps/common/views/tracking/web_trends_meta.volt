<!-- BEGIN WT -->
{% if not empty(wtMetaData) %}
    {% for name, content in wtMetaData %}
        <meta name="{{ name }}" content="{{ content }}"/>
    {% endfor %}
{% endif %}
<!-- END WT -->