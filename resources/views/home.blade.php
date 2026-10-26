<!DOCTYPE html>
<html lang="es-MX" itemscope itemtype="https://schema.org/WebApplication">
<head>
    @include('header')
    
    <!-- Meta Tags Esenciales -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{GetSiglas(2)}} | Sistema de Gestión de Residuos - Gobierno de la Ciudad de México</title>
    
    <!-- Meta Description -->
    <meta name="description" content="{{GetSiglas(2)}} - Plataforma oficial del Gobierno de la Ciudad de México para la gestión, seguimiento y recolección de residuos. Sistema especializado para negocios, hoteles y restaurantes en la CDMX.">
    
    <!-- Keywords -->
    <meta name="keywords" content="{{GetSiglas(2)}}, gestión residuos, recolección basura, gobierno CDMX, medio ambiente, reciclaje, residuos comerciales, sustentabilidad, recolección Ciudad de México, reci-trash">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://reci-trash.com/">
    <meta property="og:title" content="{{GetSiglas(2)}} | Sistema de Gestión de Residuos - Gobierno de la Ciudad de México">
    <meta property="og:description" content="Plataforma oficial del Gobierno de la Ciudad de México para la gestión y seguimiento de residuos comerciales e industriales en la CDMX.">
    <meta property="og:image" content="https://reci-trash.com/images/{{GetLogoPrortal()}}">
    <meta property="og:site_name" content="{{GetSiglas(2)}}">
    <meta property="og:locale" content="es_MX">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://reci-trash.com/">
    <meta property="twitter:title" content="{{GetSiglas(2)}} | Sistema de Gestión de Residuos">
    <meta property="twitter:description" content="Plataforma oficial del Gobierno de la Ciudad de México para la gestión de residuos comerciales en la CDMX.">
    <meta property="twitter:image" content="https://reci-trash.com/images/{{GetLogoPrortal()}}">
    <meta property="twitter:site" content="@{{GetSiglas(2)}}">
    
    <!-- Schema.org markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebApplication",
        "name": "{{GetSiglas(2)}} - Sistema de Gestión de Residuos",
        "alternateName": "Reci-Trash",
        "description": "Plataforma oficial del Gobierno de la Ciudad de México para la gestión y seguimiento de residuos comerciales e industriales en la CDMX",
        "url": "https://reci-trash.com",
        "applicationCategory": "BusinessApplication",
        "operatingSystem": "Web Browser",
        "permissions": "geolocation",
        "author": {
            "@type": "GovernmentOrganization",
            "name": "Gobierno de la Ciudad de México",
            "url": "https://reci-trash.com"
        },
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "MXN"
        },
        "areaServed": {
            "@type": "City",
            "name": "Ciudad de México",
            "address": {
                "@type": "PostalAddress",
                "addressRegion": "Ciudad de México",
                "addressCountry": "MX"
            }
        }
    }
    </script>
    
    <!-- Gobierno Organization Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "GovernmentOrganization",
        "name": "{{GetSiglas(2)}} - Gobierno de la Ciudad de México",
        "alternateName": "Reci-Trash",
        "description": "Sistema de gestión de residuos del Gobierno de la Ciudad de México",
        "url": "https://reci-trash.com",
        "logo": "https://reci-trash.com/images/{{GetLogoPrortal()}}",
        "sameAs": [
            "https://facebook.com/recitrash",
            "https://twitter.com/recitrash"
        ],
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Ciudad de México",
            "addressRegion": "Ciudad de México",
            "addressCountry": "MX"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service",
            "telephone": "+52-55-XXX-XXXX",
            "email": "contacto@reci-trash.com",
            "areaServed": "MX",
            "availableLanguage": "es"
        }
    }
    </script>
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://reci-trash.com/">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    
    <!-- Robots.txt directives -->
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    
    <!-- Geolocation para búsquedas locales -->
    <meta name="geo.region" content="MX-CMX">
    <meta name="geo.placename" content="Ciudad de México">
    <meta name="geo.position" content="19.4326;-99.1332">
    <meta name="ICBM" content="19.4326, -99.1332">
    
    <!-- Verificación de propiedad del sitio -->
    <meta name="google-site-verification" content="tu_codigo_de_verificacion">
    
    <style>
        .footer {
            /* Estilos generales para la imagen */
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        @media (orientation: portrait) {
            .footer {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                z-index: -1;
            }
            
            .contenedor-imagen {
                position: relative;
                min-height: 100vh;
            }
        }
        
        /* Mejoras de accesibilidad */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
        
        /* Mejora de rendimiento para imagen principal */
        .hero-image {
            width: 100%;
            height: auto;
            display: block;
            loading: eager;
        }
    </style>
</head>
<body itemscope itemtype="https://schema.org/WebPage">
    @include('toast.toasts')
    
    <!-- Header con navegación semántica -->
    <header role="banner">
        @include('navbar')
    </header>

    <!-- Contenido principal -->
    <main role="main">
        <!-- Texto oculto para SEO pero visible para screen readers -->
        <h1 class="sr-only">{{GetSiglas(2)}} - Sistema de Gestión de Residuos del Gobierno de la Ciudad de México</h1>
        <p class="sr-only">Plataforma oficial Reci-Trash para el registro, seguimiento y gestión de residuos comerciales e industriales en la Ciudad de México. Sistema especializado para hoteles, restaurantes y negocios del sector turístico.</p>
        
        <!-- IMAGEN CENTRAL con metadatos optimizados -->
        <div class="contenedor-imagen" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
            <img src="{{asset('images/'.GetLogoPrortal())}}" 
                 alt="{{GetSiglas(2)}} - Sistema de Gestión de Residuos del Gobierno de la Ciudad de México" 
                 title="{{GetSiglas(2)}} - Plataforma de Gestión de Residuos Comerciales"
                 itemprop="contentUrl"
                 class="hero-image"
                 width="1200" 
                 height="630">
            <meta itemprop="description" content="Plataforma {{GetSiglas(2)}} del Gobierno de la Ciudad de México para gestión de residuos comerciales y turísticos">
            <meta itemprop="name" content="{{GetSiglas(2)}} Gobierno de la Ciudad de México">
            <meta itemprop="url" content="https://reci-trash.com/images/{{GetLogoPrortal()}}">
        </div>
        
        <!-- Contenido semántico adicional para SEO -->
        <div style="display: none;" aria-hidden="true">
            <h2>Gestión de Residuos Ciudad de México</h2>
            <p>{{GetSiglas(2)}} es el sistema oficial del Gobierno de la Ciudad de México para la gestión integral de residuos sólidos urbanos. Plataforma especializada en el sector turístico y comercial.</p>
            <h3>Servicios de Reci-Trash</h3>
            <ul>
                <li>Registro de generadores de residuos</li>
                <li>Seguimiento de recolecciones</li>
                <li>Reportes ambientales</li>
                <li>Cumplimiento normativo</li>
                <li>Gestión para hoteles y restaurantes</li>
            </ul>
        </div>
    </main>

    <!-- Footer semántico -->
    <footer role="contentinfo">
        @include('footer')
    </footer>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "Inicio",
            "item": "https://reci-trash.com"
        }]
    }
    </script>

    <script>
        // Mostrar/ocultar menú en móvil
        document.getElementById('navbar-toggler').addEventListener('click', function () {
            var navbarCollapse = document.getElementById('navbarSupportedContent');
            navbarCollapse.classList.toggle('active');
        });
        
        // Mejora de accesibilidad para navegación
        document.addEventListener('DOMContentLoaded', function() {
            const navItems = document.querySelectorAll('nav a, nav button');
            navItems.forEach((item, index) => {
                item.addEventListener('keydown', function(e) {
                    if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                        e.preventDefault();
                        const nextItem = navItems[index + 1] || navItems[0];
                        nextItem.focus();
                    }
                    if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                        e.preventDefault();
                        const prevItem = navItems[index - 1] || navItems[navItems.length - 1];
                        prevItem.focus();
                    }
                });
            });
        });
        
        // Mejora de rendimiento - precargar recursos críticos
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                const img = document.querySelector('.hero-image');
                if (img && !img.complete) {
                    img.loading = 'eager';
                }
            });
        }
    </script>
</body>
</html>