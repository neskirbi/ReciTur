<img src="{{asset('images/GOBMF.png')}}" alt="Imagen principal" style="margin-top:50px; width: 100%; display: block;">
@include('firebaseanalytics')


<script>
    // Mostrar/ocultar menú en móvil
    document.getElementById('navbar-toggler').addEventListener('click', function () {
        var navbarCollapse = document.getElementById('navbarSupportedContent');
        navbarCollapse.classList.toggle('active');
    });
</script>