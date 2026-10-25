@include('firebaseanalytics')


<script>
    // Mostrar/ocultar menú en móvil
    document.getElementById('navbar-toggler').addEventListener('click', function () {
        var navbarCollapse = document.getElementById('navbarSupportedContent');
        navbarCollapse.classList.toggle('active');
    });
</script>