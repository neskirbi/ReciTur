<img src="{{asset('images/GOBMF.png')}}" alt="Imagen principal" style="margin-top:50px; width: 100%; display: block;">
@include('firebaseanalytics')



<script>
    // Mostrar/ocultar menú en móvil
    document.getElementById('navbar-toggler').addEventListener('click', function () {
        var navbarCollapse = document.getElementById('navbarSupportedContent');
        navbarCollapse.classList.toggle('active');
    });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarCollapse');
    const contentWrapper = document.querySelector('.content-wrapper');

    toggleBtn.addEventListener('click', function () {
      // Para desktop
      if(window.innerWidth > 768){
        sidebar.classList.toggle('collapsed');
        contentWrapper.classList.toggle('expanded');
      } else {
        // Para móviles, togglear clase 'show'
        sidebar.classList.toggle('show');
      }
    });

    // Opcional: cerrar sidebar al hacer click fuera en móvil
    window.addEventListener('click', function(e){
      if(window.innerWidth <= 768){
        if(!sidebar.contains(e.target) && !toggleBtn.contains(e.target)){
          sidebar.classList.remove('show');
        }
      }
    });
  });
</script>
