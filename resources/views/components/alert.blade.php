<div class="alert alert-{{ $type }}" id="myAlert" role="alert">
    {{ $slot }}
</div>

<script>
    setTimeout(() => {

        document.getElementById("myAlert").style.display = "none";

    }, 5000);
</script>
